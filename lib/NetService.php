<?php
use Symfony\Component\Process\Process;

class NetService
{
    private $host;
    private $credentials;
    private $service;
    private $timeout;

    const START         = 'start';
    const STOP          = 'stop';
    const STATUS        = 'status';
    const LIST_SERVICES = 'list';

    const DEFAULT_TIMEOUT = 3600;

    public function __construct($host, $service, $credentials)
    {
        $this->host        = $host;
        $this->service     = $service;
        $this->credentials = $credentials;
        $this->timeout     = self::DEFAULT_TIMEOUT;
    }

    public function start()
    {
        return $this->runProcess($this->getCommandLineForAction(self::START));
    }

    public function stop()
    {
        return $this->runProcess($this->getCommandLineForAction(self::STOP));
    }

    public function status()
    {
        return $this->runProcess($this->getCommandLineForAction(self::STATUS));
    }

    public function listServices()
    {
        return $this->runProcess($this->getCommandLineForAction(self::LIST_SERVICES, FALSE));
    }

    public function isRunning()
    {
        $status = explode("\n", $this->status());
        if (isset($status[0]) && strpos(strtolower($status[0]), "running") !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function getCommandLineForAction($action, $includeService = TRUE)
    {
        if ($includeService) {
            return "net rpc service {$action} {$this->service} -S {$this->host} -U {$this->credentials}";
        } else {
            return "net rpc service {$action} -S {$this->host} -U {$this->credentials}";
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