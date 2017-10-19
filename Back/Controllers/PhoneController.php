<?php
set_include_path('.;');

require_once "IController.php";
require_once "ManufacturerController.php";
//require_once '../Common/App.php';

class PhoneController extends IController
{
    private $phoneObj; 
      
    public function __construct( $dbHandler=null, $phoneObj=null )
    {
        $dbCon = $dbHandler;
        if(!$dbCon)
        {
            $myApp = new App();
            $dbCon = new Connection( $myApp->getDbName() );
        }
       
        parent::__construct( $dbCon, "phones", "PhoneModel" );
        $this->phoneObj = $phoneObj;
    }

    public function Create( $params )
    {
        if( $params['img'] != "none")
        {
            loadImage($params['img']);
            $params['img_name'] = $params['img']['name'];
        }
       
        unset($params['img']);
        
        //Check if manufacturer id exist
        $manCtrl = new ManufacturerController($this->getDbHandler());
        if( $manCtrl->getById($params['manufacturer_id']))
        {
            //insert
            return parent::Create( $params );
        }
        else //Can not insert Pohne where manufacturer id doesnt exist
        {
            echo "Can not insert Pohne where manufacturer id doesnt exist: " .$modelObj['id'] ;
            return false;
        }
    }

    public function getAllWithManuName()
    {
        /*
        runQuery( $sqlQuery, $arrParams=null )
        
        $statement = $dbh->prepare( $sqlQuery );
         $statement->execute($arrParams)

        */
        
        $query = "SELECT phones.id as phone_id, phones.name as phone_name, phones.img_name as img_name, manufacturers.name as manu_name FROM phones inner join manufacturers on phones.manufacturer_id = manufacturers.id";
        return $this->getDbHandler()->runQuery( $query );
        

        
    }
}

function loadImage($img)
{

    $sourcePath = $img['tmp_name'];       // Storing source path of the file in a variable
    $targetPath = '../../Front/images/'.$img['name']; // Target path where file is to be stored
    //$targetPath = $img['name']; // Target path where file is to be stored
    move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file
}

?>