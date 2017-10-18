<?php
require_once '../Common/App.php';

$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = $myApp->getImgPath().$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file

    // if ( 0 < $_FILES['file']['error'] ) {
    //     echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    // }
    // else {
    //     $myApp = new App();
        

    //     move_uploaded_file($_FILES['file']['tmp_name'], $myApp->getImgPath() . $_FILES['file']['name']);
    // }


?>