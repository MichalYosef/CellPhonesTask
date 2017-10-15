<?php

require_once '..\\Back\Common\Connection.php';
require_once '..\\Back\Common\App.php';
require_once '..\\Back\Common\createTbl.php';
require_once '..\\Back\Controllers\ManufacturerController.php';
require_once '..\\Back\Controllers\PhoneController.php';
require_once '..\\Back\Models\ManufacturerModel.php';
require_once '..\\Back\Models\PhoneModel.php';


$myApp = new App();
$dbHanler = new Connection( $myApp->getDbName() );

/* TEST 1 
-----------------------------------------
*/
// $manuCtrl = new ManufacturerController( $dbHanler );

// $allManu = $manuCtrl->getAll();
// echo "</br>TEST 1: ";
// var_dump( $allManu );

// $phonesCtrl = new PhoneController( $dbHanler );

// $allPhones = $phonesCtrl->getAll();
// echo "</br>TEST 2: ";
// var_dump( $allPhones );

//present in tbl
// $manuCtrl = new ManufacturerController( $dbHanler );
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;

// $phonesCtrl = new PhoneController( $dbHanler );
// $allPhonesSt = $phonesCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allPhonesSt ) ;

// $manModel = new ManufacturerModel(  "Xiaomi");
// $manuCtrl = new ManufacturerController( $dbHanler );
// $allManuSt = $manuCtrl->Create($manModel->getDataModel());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;

//TODO: להוסיף בדיקה אם שם יצרן/טלפון קיים כבר אז לא להוסיף

// $manModel = new PhoneModel(   "Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif");
// $manuCtrl = new PhoneController( $dbHanler );
// $allManuSt = $manuCtrl->Create($manModel->getDataModel());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;

// $manModel = new ManufacturerModel(  "XiaomiNew",3);
// $manuCtrl = new ManufacturerController( $dbHanler );
// $allManuSt = $manuCtrl->Update($manModel->getDataModel());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;


// $manModel = new PhoneModel(   "New Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif",9);
// $manuCtrl = new PhoneController( $dbHanler );
// $allManuSt = $manuCtrl->Update($manModel->getDataModel());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;


// $manModel = new PhoneModel(   "New Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif",9);
// $manuCtrl = new PhoneController( $dbHanler );
// $allManuSt = $manuCtrl->Delete($manModel->getId());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;


// $manModel = new ManufacturerModel(  "XiaomiNew",3);
// $manuCtrl = new ManufacturerController( $dbHanler );
// $allManuSt = $manuCtrl->Delete($manModel->getId());
// $allManuSt = $manuCtrl->getAll("statement");
// createHtmlTblByPdoResult( $allManuSt ) ;
//////עד כאן עובד

?>