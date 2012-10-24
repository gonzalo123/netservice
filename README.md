net rpc service wrapper for PHP

```
net rpc service help

Usage:
net rpc service list            View configured Win32 services
net rpc service start           Start a service
net rpc service stop            Stop a service
net rpc service pause           Pause a service
net rpc service resume          Resume a paused service
net rpc service status          View current status of a service
net rpc service delete          Delete a service
net rpc service create          Create a service
```

Usage

```php
include __DIR__ . '/../vendor/autoload.php';

$host        = 'windowshost.com';
$serviceName = 'ServiceName';
$credentials = '{domain}/{user}%{password}';

$netService = new NetService($host, $serviceName, $credentials);
echo $netService->listServices();
```

```php
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
```