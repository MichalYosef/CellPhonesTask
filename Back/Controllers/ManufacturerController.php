<?php

require_once "IController.php";



class ManufacturerController extends IController
{
    private $manufacturerObj; 
      
    public function __construct( $dbHandler, $manufacturerObj=null )
    {
      
        parent::__construct( $dbHandler, "manufacturers", "ManufacturerModel" );
        $this->manufacturerObj = $manufacturerObj;
    }
}


?>