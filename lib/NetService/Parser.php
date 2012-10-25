<?php

namespace NetService;

class Parser
{
    private $host;
    private $credentials;
    private $service;
    private $action;


    public function __construct($host, $credentials)
    {
        $this->host        = $host;
        $this->credentials = $credentials;
    }

    public function getCommandLineForAction($action, $service = NULL)
    {
        if (!is_null($service)) $service = " {$service}";
        return "net rpc service {$action}{$service} -S {$this->host} -U {$this->credentials}";
    }
}