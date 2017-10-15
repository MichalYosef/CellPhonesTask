<?php
    require_once 'abstractApi.php';
    require_once '../Controllers/DirectorController.php';
    require_once '../Common/createTbl.php';

    class DirectorApi extends Api
    {
        function Create( $params ) 
        {
            $dirCtrl = new DirectorController();
            return $dirCtrl->Create( $params );
        }

        function Read( $params ) 
        {
            $dirCtrl = new DirectorController();

            // if (array_key_exists("id", $params)) 
            // {
                /*return createHtmlTblByPdoResult(*/ $dirCtrl->Read( $params );
                 //return json_encode($dirCtrl->Read( $params ), JSON_PRETTY_PRINT);
            // }
            // else 
            // {
            //   //  return $c->getAllCustomers();
            // }
        }

         function Update($params) 
         {
            $dirCtrl = new DirectorController();
         }

         function Delete($params) 
         {
            $dirCtrl = new DirectorController();
         }
    }
?>