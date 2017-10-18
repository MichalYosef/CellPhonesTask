<?php
    require_once 'abstractApi.php';
    require_once '../Controllers/ManufacturerController.php';
    require_once '../Common/createTbl.php';

    class ManufecturerApi extends Api
    {
        private $dbCon;

        public function __construct( $dbCon)
        {
            $this->dbCon = $dbCon;
        }

        function Create( $params ) 
        {
            $dirCtrl = new ManufacturerController($this->dbCon);
            return $dirCtrl->Create( $params );
        }

        function Read( $params ) 
        {
            $ctrl = new ManufacturerController($this->dbCon);

            $data = $ctrl->Read( $params );
            $tmp = json_encode($data);
            echo json_encode($data);
            
        }

         function Update($params) 
         {
            $dirCtrl = new ManufacturerController($this->dbCon);
         }

         function Delete($params) 
         {
            $dirCtrl = new ManufacturerController($this->dbCon);
         }
    }
?>