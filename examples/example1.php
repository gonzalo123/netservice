<?php

include __DIR__ . '/../vendor/autoload.php';

$host        = 'windowshost.com';
$serviceName = 'ServiceName';
$credentials = '{domain}/{user}%{password}';

$netService = new NetService($host, $serviceName, $credentials);

if ($netService->isRunning()) {
    echo "Service is running. Let's stop";
    $netService->stop();

} else {
    echo "Service isn't running. Let's start";
    $netService->start();
}

//dumps status output
echo $netService->status();