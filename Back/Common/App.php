<?php

class App
{
    private $dbName;

    public function __construct($dbName = 'cell_phones_task')
    {
        $this->dbName = $dbName;

    }

    public function getDbName()
    {
        return  $this->dbName;
    }
}

?>