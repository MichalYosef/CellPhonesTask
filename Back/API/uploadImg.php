<?php
require_once '../Common/App.php';

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        $myApp = new App();
        

        move_uploaded_file($_FILES['file']['tmp_name'], $myApp->getImgPath() . $_FILES['file']['name']);
    }

?>