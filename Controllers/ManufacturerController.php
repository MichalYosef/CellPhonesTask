<?php

require_once "IController.php";



class ManufacturerController extends IController
{
    private $movieObj; 
      
    public function __construct( $dbHandler, $movieObj=null )
    {
        if($dbHandler==null){
            $dbHandler = new Connection( App::getDbName() );
        }
        parent::__construct( $dbHandler, "Manufacturers", "ManufacturerModel" );
        $this->movieObj = $movieObj;
    }
}


?>