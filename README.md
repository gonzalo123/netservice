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

use NetService\Service,
    NetService\Parser;

$host        = 'windowshost.com';
$credentials = '{domain}/{user}%{password}';

$service = new Service(new Parser($host, $credentials));
echo $service->listServices();
```

```php
include __DIR__ . '/../vendor/autoload.php';

use NetService\Service,
    NetService\Parser;

$host        = 'windowshost.com';
$serviceName = 'ServiceName';
$credentials = '{domain}/{user}%{password}';

$service = new Service(new Parser($host, $credentials));

if ($service->isRunning($serviceName)) {
    echo "Service is running. Let's stop";
    $service->stop($serviceName);

} else {
    echo "Service isn't running. Let's start";
    $service->start($serviceName);
}

//dumps status output
echo $service->status($serviceName);
```