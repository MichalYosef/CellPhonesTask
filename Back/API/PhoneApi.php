<?php
    require_once 'abstractApi.php';
    require_once '../Controllers/PhoneController.php';
    

    class PhoneApi extends Api
    {
        private $dbCon;

        public function __construct( $dbCon)
        {
            $this->dbCon = $dbCon;
        }

        function Create( $params ) 
        {
            
            $ctrl = new PhoneController($this->dbCon);
            return $ctrl->Create( $params );
        }

        function Read( $params ) 
        {
            $ctrl = new PhoneController($this->dbCon);

            $data = $ctrl->Read( $params );
            $tmp = json_encode($data);
            echo json_encode($data);
            
        }

         function Update($params) 
         {
            $ctrl = new PhoneController($this->dbCon);
         }

         function Delete($params) 
         {
            $ctrl = new ManufacturerController($this->dbCon);
         }
    }
?>