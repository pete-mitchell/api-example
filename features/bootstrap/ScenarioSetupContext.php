<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Doctrine\DBAL\Connection;

class ScenarioSetupContext implements Context
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @AfterScenario
     */
    public function cleanDb(AfterScenarioScope $event)
    {
        $this->connection->executeUpdate('DELETE FROM todo');
    }
}
