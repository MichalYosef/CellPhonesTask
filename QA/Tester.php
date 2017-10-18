<?php

require_once '..\\Back\Common\Connection.php';
require_once '..\\Back\Common\App.php';
require_once '..\\Back\Common\createTbl.php';
require_once '..\\Back\Controllers\ManufacturerController.php';
require_once '..\\Back\Controllers\PhoneController.php';
require_once '..\\Back\Models\ManufacturerModel.php';
require_once '..\\Back\Models\PhoneModel.php';

//TODO: להוסיף בדיקה אם שם יצרן/טלפון קיים כבר אז לא להוסיף

$myApp = new App();
$dbHanler = new Connection( $myApp->getDbName() );

/* TEST 1 - getAll manufacturers as an array*/
$manuCtrl = new ManufacturerController( $dbHanler );
$allManu = $manuCtrl->getAll("array");
echo "</br>TEST 1 - getAll manufacturers as an array: </br> ";
var_dump( $allManu );

//alert("Test 1 succeed! (getAll manufacturers as an array)");

/* TEST 2 - getAll phones as an array*/
$phonesCtrl = new PhoneController( $dbHanler );
$allPhones = $phonesCtrl->getAll("array");
echo "</br>TEST 2 - getAll phones as an array: </br>";
var_dump( $allPhones );

//alert("Test 2 succeed! (getAll phones as an array)");


/* TEST 3 - present getAll manufacturers in tbl */
echo "</br>TEST 3 - present getAll manufacturers in tbl: </br>";
$manuCtrl = new ManufacturerController( $dbHanler );
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 3 succeed! (present getAll manufacturers in tbl)");

/* TEST 4 - present getAll phones in tbl */
echo "</br>TEST 4 - present getAll phones in tbl: </br>";
$phonesCtrl = new PhoneController( $dbHanler );
$allPhonesSt = $phonesCtrl->getAll("statement");
createHtmlTblByPdoResult( $allPhonesSt ) ;

//alert("Test 4 succeed! (present getAll phones in tbl)");

/* TEST 5 - Create manufacturer */
echo "</br>TEST 5 - Create manufacturer: </br>";
$manModel = new ManufacturerModel(  "Xiaomi");
$manuCtrl = new ManufacturerController( $dbHanler );
$allManuSt = $manuCtrl->Create($manModel->getDataModel());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 5 succeed! (Create manufacturer)");

/* TEST 6 - Create phone */
echo "</br>TEST 6 - Create phone: </br>";
$manModel = new PhoneModel(   "Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif");
$manuCtrl = new PhoneController( $dbHanler );
$allManuSt = $manuCtrl->Create($manModel->getDataModel());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 6 succeed! (Create phone)");

/* TEST 7 - Update manufacturer */
echo "</br>TEST 7 - Update manufacturer: </br>";
$manModel = new ManufacturerModel(  "XiaomiNew",3);
$manuCtrl = new ManufacturerController( $dbHanler );
$allManuSt = $manuCtrl->Update($manModel->getDataModel());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 7 succeed! (Update manufacturer)");

/* TEST 8 - Update phone */
echo "</br>TEST 8 - Update phone: </br>";
$manModel = new PhoneModel(   "New Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif",9);
$manuCtrl = new PhoneController( $dbHanler );
$allManuSt = $manuCtrl->Update($manModel->getDataModel());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 8 succeed! (Update phone)");

/* TEST 9 - Delete manufacturer */
echo "</br>TEST 9 - Delete phone: </br>";
$manModel = new PhoneModel(   "New Xiaomi Redmi Note 4X 64GB 4GB MediaTech", 3, "43912106b.gif",9);
$manuCtrl = new PhoneController( $dbHanler );
$allManuSt = $manuCtrl->Delete($manModel->getId());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 9 succeed! (Delete phone)");

/* TEST 10 - Delete manufacturer */
echo "</br>TEST 10 - Delete manufacturer: </br>";
$manModel = new ManufacturerModel(  "XiaomiNew",3);
$manuCtrl = new ManufacturerController( $dbHanler );
$allManuSt = $manuCtrl->Delete($manModel->getId());
$allManuSt = $manuCtrl->getAll("statement");
createHtmlTblByPdoResult( $allManuSt ) ;

//alert("Test 10 succeed! (Delete manufacturer)");


/* TEST 11 - Read manufacturer by id*/
echo "</br>TEST 11 - Read manufacturer by id: </br> ";

$manuCtrl = new ManufacturerController( $dbHanler );
$manu = $manuCtrl->getById(1) ;

var_dump( $manu );

//////עד כאן עובד

/* TEST 12 - Read phone by id*/
echo "</br>TEST 12 - Read phone by id: </br> ";

$phoneCtrl = new PhoneController( $dbHanler );
$phone = $phoneCtrl->getById(3) ;

var_dump( $phone );




// /* TEST 12 - getAll phones as an array*/
// $phonesCtrl = new PhoneController( $dbHanler );
// $allPhones = $phonesCtrl->getAll("array");
// echo "</br>TEST 2 - getAll phones as an array: </br>";
// var_dump( $allPhones );



function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>