<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

include __DIR__ . "/../../vendor/autoload.php";

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $host, $credentials, $service, $action;
    public function __construct(array $parameters)
    {
    }

    /**
     * @Given /^windows server host called "([^"]*)"$/
     */
    public function windowsServerHostCalled($host)
    {
        $this->host = $host;
    }

    /**
     * @Given /^credentials are "([^"]*)"$/
     */
    public function credentialsAre($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @Then /^command line is "([^"]*)"$/
     */
    public function commandLineIs($expectedCommandLine)
    {
        $parser = new NetService\Parser($this->host, $this->credentials);
        assertEquals($expectedCommandLine, $parser->getCommandLineForAction($this->action, $this->service));
    }

    /**
     * @Given /^service name called "([^"]*)"$/
     */
    public function serviceNameCalled($service)
    {
        $this->service = $service;
    }

    /**
     * @Given /^action is "([^"]*)"$/
     */
    public function actionIs($action)
    {
        $this->action = $action;
    }


}
