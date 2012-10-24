<?php

include __DIR__ . '/../vendor/autoload.php';

$host        = 'windowshost.com';
$serviceName = 'ServiceName';
$credentials = '{domain}/{user}%{password}';

$netService = new NetService($host, $serviceName, $credentials);
echo $netService->listServices();
