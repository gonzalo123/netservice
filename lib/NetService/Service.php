<?php
namespace NetService;

use Symfony\Component\Process\Process,
    NetService\Parser;

class Service
{
    private $parser;
    private $timeout;

    const START = 'start';
    const STOP = 'stop';
    const STATUS = 'status';
    const LIST_SERVICES = 'list';
    const PAUSE = 'pause';
    const RESUME = 'resume';

    const DEFAULT_TIMEOUT = 3600;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
        $this->timeout = self::DEFAULT_TIMEOUT;
    }

    public function start($service)
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::START, $service));
    }

    public function stop($service)
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::STOP, $service));
    }

    public function pause($service)
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::PAUSE, $service));
    }

    public function resume($service)
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::RESUME, $service));
    }

    public function status($service)
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::STATUS, $service));
    }

    public function listServices()
    {
        return $this->runProcess($this->parser->getCommandLineForAction(self::LIST_SERVICES));
    }

    public function isRunning($service)
    {
        $status = explode("\n", $this->status($service));
        if (isset($status[0]) && strpos(strtolower($status[0]), "running") !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    private function runProcess($commandLine)
    {
        $process = new Process($commandLine);
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

    private function parseStatus($status)
    {
        return explode("\n", $status);
    }
}