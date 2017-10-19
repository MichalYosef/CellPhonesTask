<?php

require_once 'ManufecturerApi.php';
require_once 'PhoneApi.php';
require_once '../Common/App.php';
require_once '../Common/Connection.php';
require_once 'Params.php';


$requestMethod = $_SERVER['REQUEST_METHOD']; 
$apiObj;
$params = array();

if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') 
{
    parse_str( file_get_contents("php://input"), $post_vars );
    
    $params = $post_vars['params']; 
}
else
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $post = $_POST;
        var_dump($_POST);

        
    }

    if( isset($_REQUEST['params']))
    {
        $params = $_REQUEST['params'];
        
       
    }
    else
    {
        if( isset( $_FILES['img']))
        {
            $img = $_FILES['img'];
        }
        else
        {
            $img = "none";
        }
        
        $params = [ 'name' => $_POST['phone_name'],
                    'manufacturer_id' => $_POST['manufacturer_id'],
                    'img' => $_FILES['img']];
      
    

    }
    
    
}

if( isset($_REQUEST['objectType']))
{
    $objType = $_REQUEST['objectType'];
}

$myApp = new App();
$dbCon = new Connection( $myApp->getDbName() );

switch ($objType) {
    
        case 'manufacturer':
            $apiObj = new ManufecturerApi($dbCon);
            break;

        case 'phone':
            $apiObj = new PhoneApi($dbCon);
           
            
            break;
            
}


$result  = $apiObj->handleClientRequests( $requestMethod, $params );
//echo json_encode( $result);


?>