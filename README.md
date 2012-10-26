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

Usage:

examples/example2.php

```php
include __DIR__ . '/../vendor/autoload.php';

use NetService\Service,
    NetService\Parser;

$host        = 'windowshost.com';
$credentials = '{domain}/{user}%{password}';

$service = new Service(new Parser($host, $credentials));
echo $service->listServices();
```

examples/example1.php

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

Parser's BDD feature file:
```
Feature: command line parser

  Scenario: net service list
    Given windows server host called "windowshost.com"
    And credentials are "myDomanin/user%password"
    And action is "list"
    Then command line is "net rpc service list -S windowshost.com -U myDomanin/user%password"

  Scenario: net service start
    Given windows server host called "windowshost.com"
    And service name called "ServiceName"
    And credentials are "myDomanin/user%password"
    And action is "start"
    Then command line is "net rpc service start ServiceName -S windowshost.com -U myDomanin/user%password"

  Scenario: net service stop
    Given windows server host called "windowshost.com"
    And service name called "ServiceName"
    And credentials are "myDomanin/user%password"
    And action is "stop"
    Then command line is "net rpc service stop ServiceName -S windowshost.com -U myDomanin/user%password"

  Scenario: net service pause
    Given windows server host called "windowshost.com"
    And service name called "ServiceName"
    And credentials are "myDomanin/user%password"
    And action is "pause"
    Then command line is "net rpc service pause ServiceName -S windowshost.com -U myDomanin/user%password"

  Scenario: net service resume
    Given windows server host called "windowshost.com"
    And service name called "ServiceName"
    And credentials are "myDomanin/user%password"
    And action is "resume"
    Then command line is "net rpc service resume ServiceName -S windowshost.com -U myDomanin/user%password"

  Scenario: net service status
    Given windows server host called "windowshost.com"
    And service name called "ServiceName"
    And credentials are "myDomanin/user%password"
    And action is "status"
    Then command line is "net rpc service status ServiceName -S windowshost.com -U myDomanin/user%password"
```