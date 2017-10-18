<?php

require_once 'ManufecturerApi.php';
require_once 'PhoneApi.php';
require_once '../Common/App.php';
require_once '../Common/Connection.php';
require_once 'Params.php';


$requestMethod = $_SERVER['REQUEST_METHOD']; 
$apiObj;

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
    
    $params = $_REQUEST['params'];
}

if($params=="")
{
    $params = array();
}
//print_r($params);

//$requestParams = new Params();

$objType = $_REQUEST['objectType'];

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