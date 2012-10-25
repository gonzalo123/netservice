<?php
include __DIR__ . '/../vendor/autoload.php';

use NetService\Service,
    NetService\Parser;

$host        = 'windowshost.com';
$credentials = '{domain}/{user}%{password}';

$service = new Service(new Parser($host, $credentials));
echo $service->listServices();
