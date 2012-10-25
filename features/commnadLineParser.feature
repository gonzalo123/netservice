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