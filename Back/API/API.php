<?php
set_include_path('.;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project');
require_once 'directorApi.php';
require_once 'movieApi.php';
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

switch ($objType) {
    
        case 'director':
            $apiObj = new DirectorApi();
            break;

        case 'movie':
            $apiObj = new MoviesApi();
            break;
}

// $dbHandler = new Connection( "movies_project" ); /* sending dbHandle from outside 
//                                                    acording to DI rules*/
$result  = $apiObj->handleClientRequests( $requestMethod, $params );
//echo json_encode($result);


?>