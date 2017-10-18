<?php

class App
{
    private $dbName;
    private $imgPath;

    public function __construct($dbName = 'cell_phones_task', $imgPath='images/')
    {
        $this->dbName = $dbName;
        $this->imgPath = $imgPath;

    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getImgPath()
    {
        return $this->imgPath;
    }
}

?>