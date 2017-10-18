<?php

require_once "IController.php";



class ManufacturerController extends IController
{
    private $manufacturerObj; 
      
    public function __construct( $dbHandler, $manufacturerObj=null )
    {
        $dbCon = $dbHandler ;
        if(!$dbCon)
        {
            $myApp = new App();
            $dbCon = new Connection( $myApp->getDbName() );
        }   
      
        parent::__construct( $dbCon, "manufacturers", "ManufacturerModel" );
        $this->manufacturerObj = $manufacturerObj;
    }
}


?>