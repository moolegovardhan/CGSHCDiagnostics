<?php 
session_start();


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true');
//header('Access-Control-Max-Age: 86400');    // cache for 1 day
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && (   
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'POST' || 
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'DELETE' || 
       $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'PUT' )) {
             header('Access-Control-Allow-Origin: *');
             header("Access-Control-Allow-Credentials: true"); 
             header('Access-Control-Allow-Headers: X-Requested-With');
             header('Access-Control-Allow-Headers: Content-Type');
             header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); 
             header('Access-Control-Max-Age: 86400'); 
      }
  exit;
}

require 'Slim/Slim/Slim.php';

require 'Database/HSMDatabase.php';
require 'Common/HSMMessages.php';
require 'Business/HSMRegistrationLogin.php';
require 'Common/ResponseMessage.php';
require 'Business/EncryptDecryptData.php';
require 'Business/MasterData.php';
require 'Business/Category.php';
require 'Business/Laboratory.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
//print_r($app);
$app->get('/','welcomeMessage');
$app->get('/authenticate/:username/:password', 'authenticateUser');

$app->get('/fetchCategoryDetails/:officeid/:insttype', 'fetchCategoryDetails');
$app->post('/createCategoryDetails', 'createCategoryDetails');
$app->post('/updateCategoryDetails','updateCategoryDetails');
$app->put('/deleteCategoryDetails/:categoryid', 'deleteCategoryDetails');
$app->get('/fetchSubCategoryDetails/:officeid/:insttype', 'fetchSubCategoryDetails');
$app->post('/createSubCategoryDetails', 'createSubCategoryDetails');
$app->post('/updateSubCategoryDetails', 'updateSubCategoryDetails');
$app->put('/deleteSubCategoryDetails/:subcategoryid', 'deleteSubCategoryDetails');
$app->get('/fetchItemDetails/:officeid/:insttype', 'fetchItemDetails');
$app->post('/createItemDetails', 'createItemDetails');
$app->post('/updateItemDetails','updateItemDetails');
$app->put('/deleteItemDetails/:Itemid', 'deleteItemDetails');
$app->get('/fetchSubItemDetails/:officeid/:insttype', 'fetchSubItemDetails');
$app->post('/createSubItemDetails', 'createSubItemDetails');
$app->post('/updateSubItemDetails','updateSubItemDetails');
$app->put('/deleteSubItemDetails/:sumItemid', 'deleteSubItemDetails');

$app->get('/fetchSupplier/:officeid/:insttype', 'fetchSupplier');
$app->post('/createSupplierDetails', 'createSupplierDetails');

//$app->get('/fetchTaxInfo/:officeid','fetchTaxInfo');
//$app->post('/insertNewTaxSettings','insertNewTaxSettings');
//$app->put('/deleteNewTaxSettings/:taxid', 'deleteNewTaxSettings');
//$app->post('/updateExistingTaxInfo','updateExistingTaxInfo');
//$app->get('/fetchChargesInfo/:officeid','fetchChargesInfo');
//$app->post('/insertNewChargesSettings','insertNewChargesSettings');
//$app->put('/deleteNewChargesSettings/:chargesid', 'deleteNewChargesSettings');
//$app->post('/updateExistingChargesInfo','updateExistingChargesInfo');
//$app->get('/fetchWardInfo/:officeid','fetchWardInfo');
//$app->post('/insertNewWardSettings','insertNewWardSettings');
//$app->put('/deleteNewWardSettings/:chargesid', 'deleteNewWardSettings');
//$app->post('/updateExistingWardInfo','updateExistingWardInfo');
//$app->get('/fetchRoomInfo/:officeid','fetchRoomInfo');
//$app->get('/fetchRoomDetailsSettings','fetchRoomDetailsSettings');
//$app->get('/fetchWardDetailsSettings','fetchWardDetailsSettings');
//$app->post('/insertNewRoomSettings','insertNewRoomSettings');
//$app->put('/deleteNewRoomSettings/:roomid', 'deleteNewRoomSettings');
//$app->post('/updateExistingRoomInfo','updateExistingRoomInfo');
//$app->get('/fetchRoomTypeInfo','fetchRoomTypeInfo');
//$app->post('/insertNewRoomTypeSettings','insertNewRoomTypeSettings');
//$app->put('/deleteNewRoomTypeSettings/:roomid', 'deleteNewRoomTypeSettings');
//$app->post('/updateExistingRoomTypeInfo','updateExistingRoomTypeInfo');
//$app->get('/fetchServicesInfo/:officeid','fetchServicesInfo');
//$app->post('/insertNewServicesSettings','insertNewServicesSettings');
//$app->put('/deleteNewServicesSettings/:servicesid', 'deleteNewServicesSettings');
//$app->post('/updateExistingServicesInfo','updateExistingServicesInfo');
//$app->get('/fetchServicesTypeInfo','fetchServicesTypeInfo');
//$app->post('/insertNewServicesTypeSettings','insertNewServicesTypeSettings');
//$app->put('/deleteNewServicesTypeSettings/:servicestypeid', 'deleteNewServicesTypeSettings');
//$app->post('/updateExistingServicesTypeInfo','updateExistingServicesTypeInfo');
//$app->get('/fetchOperationsInfo/:officeid','fetchOperationsInfo');
//$app->post('/insertNewOperationsSettings','insertNewOperationsSettings');
//$app->put('/deleteNewOperationsSettings/:operationid', 'deleteNewOperationsSettings');
//$app->post('/updateExistingOperationsInfo','updateExistingOperationsInfo');

$app->get('/fetchCompanyInfo/:officeid','fetchCompanyInfo');
$app->post('/insertNewCompanySettings','insertNewCompanySettings');
$app->post('/updateExistingCompanyInfo','updateExistingCompanyInfo');
$app->put('/deleteNewCompanySettings/:companyid','deleteNewCompanySettings');
$app->get('/fetchSupplierInfo/:officeid','fetchSupplierInfo');
$app->post('/insertNewSupplierSettings','insertNewSupplierSettings');
$app->post('/updateExistingSupplierInfo','updateExistingSupplierInfo');
$app->put('/deleteNewSupplierSettings/:supplierid','deleteNewSupplierSettings');
$app->get('/fetchExpencesInfo/:spentdatefrom/:spentdateto/:officeid','fetchExpencesInfo');
$app->post('/insertNewExpencesSettings','insertNewExpencesSettings');
$app->post('/updateExistingExpencesInfo','updateExistingExpencesInfo');
$app->put('/deleteNewExpencesSettings/:expenceid','deleteNewExpencesSettings');
$app->get('/fetchSpecialoffersInfo/:currentdate/:officeid','fetchSpecialoffersInfo');
$app->post('/insertNewSpecialoffersSettings','insertNewSpecialoffersSettings');
$app->post('/updateExistingSpecialoffersInfo','updateExistingSpecialoffersInfo');
$app->put('/deleteNewSpecialoffersSettings/:specialofferid','deleteNewSpecialoffersSettings');
$app->get('/fetchSpecialofferdetailsInfo/:currentdate/:officeid','fetchSpecialofferdetailsInfo');
$app->post('/insertNewSpecialofferdetailsSettings','insertNewSpecialofferdetailsSettings');
$app->post('/updateExistingSpecialofferdetailsInfo','updateExistingSpecialofferdetailsInfo');
$app->put('/deleteNewSpecialofferdetailsSettings/:specialofferdetailsid','deleteNewSpecialofferdetailsSettings');
$app->get('/fetchReferalsInfo/:officeid','fetchReferalsInfo');
$app->post('/insertNewReferalsSettings','insertNewReferalsSettings');
$app->post('/updateExistingReferalsInfo','updateExistingReferalsInfo');
$app->put('/deleteNewReferalsSettings/:referalrateid','deleteNewReferalsSettings');
$app->get('/fetchReferalRatesInfo/:officeid','fetchReferalRatesInfo');
$app->post('/insertNewReferalRatesSettings','insertNewReferalRatesSettings');
$app->post('/updateExistingReferalRatesInfo','updateExistingReferalRatesInfo');
$app->put('/deleteNewReferalRatesSettings/:referalid','deleteNewReferalRatesSettings');

/* ========= Added for Lab module ========= */
$app->post('/createLabTest', 'createLabTest');
$app->get('/getLabTestData/:testId', 'getLabTestData');
$app->put('/editLabTestData', 'editLabTestData');
$app->get('/getLastLabtestsdetailsId', 'getLastLabtestsdetailsId');

$app->get('/fetchThresholdInfo/:officeid','fetchThresholdInfo');

/*-----------testCreation&LabBilling module------------------------*/
$app->get('/fetchDepartments','fetchDepartments');
$app->get('/fetchmeasureunits','fetchmeasureunits');
$app->post('/insertTestCreationDetails','insertTestCreationDetails');
$app->put('/UpdateTestCreation','UpdateTestCreation');

/*-----------------lab billing-----------------------------*/
$app->get('/fetchPaidNonPrescriptionPatients/:patientname/:patientid/:appid/:mobile','fetchPaidNonPrescriptionPatients');
$app->get('/fetchPatientTestDetails/:appointmentid', 'fetchPatientTestDetails');
$app->post('/insertLabBillingDetails','insertLabBillingDetails');
/*non-prescription billing*/
$app->get('/diagnosticsTestDataByNameandId/:diagnosticsId/:testname', 'diagnosticsTestDataByNameandId');
/*-------tests------*/
$app->get('/fetchNonPaidPrescription/:patientname/:patientid/:appid/:mobile', 'fetchNonPaidPrescription');
$app->get('/fetchPaidPrescription/:patientname/:patientid/:appid/:mobile', 'fetchPaidPrescription');

/*---------test price module---------------*/
$app->get('/getTestPrices/:testName', 'getTestPrices');
$app->get('/getPatientTestDetails/:appointmentid', 'getPatientTestDetails');
$app->post('/insertHallBooking', 'insertHallBooking');
$app->run();

function welcomeMessage(){  
    
    echo json_encode("Welcome to world of CGH Health Care System !");
}


function authenticateUser($userId,$password){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
  //  $insertToken = new UserRolePermissionValidation();
    $token = "";
     try{
       $result =  $hsmRegistration->authenticateUser($userId, $password);
       //print_r($result);
       if(count($result) > 0){
           if($result[0]->status == "N"){
               $responseMessage->setMessage(HSMMessages::$authenticateUserActivationMessage);
               $responseMessage->setStatus("Fail");
           }else{
            $responseMessage->setMessage(HSMMessages::$authenticateSuccessMessage);
            $dt = $result[0];
            
         //    $token = $insertToken->insertToken($dt->ID);
		//print_r($dt);echo "</br>";	 
            $_SESSION['forllabofficeid'] = $dt->officeid;
            $_SESSION['userid'] = $dt->ID;
            $_SESSION['logeduser'] = $dt->name;
            $_SESSION['officeid'] = $dt->officeid;
             $_SESSION['role'] = $dt->userrole;
             $_SESSION['city'] = $dt->city;
            $_SESSION['userobj'] = $dt;
             $_SESSION['profession'] = $dt->profession;
               $_SESSION['insttype'] = $dt->insttype;
                 $_SESSION['department'] = $dt->department;
            $responseMessage->setStatus("Success");
            
            if($dt->profession == "Doctor"){
                $_SESSION['doctorid'] = $dt->ID;
                $dd = new DoctorData();
                $hospitalList = $dd->fetchHospitalsforDoctor($dt->ID);
                if(count($hospitalList) == 0){
                    $_SESSION['hospitalcount'] = 0;
                }
            }
            
            
           }     
       }else {
           
           $responseMessage->setMessage(HSMMessages::$authenticateFailMessage);
            $responseMessage->setStatus("Fail");
           
       }
       
       $responseMessage->setComments("authenticated");
       
     //  echo '{"responseMessageDetails": ' . $responseMessage->buildJsonObject($responseMessage,$result) . '}';
       $responseMessage->buildMessageBlock($responseMessage->getMessage(),  $responseMessage->getStatus(),$responseMessage->getComments(),$result);
    } catch (PDOException $pdoex) {
             $responseMessage->setMessage($pdoex->getMessage());
               $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
                    $responseMessage->buildMessageBlock($responseMessage->getMessage(),  $responseMessage->getStatus(),$responseMessage->getComments(),$result);
            //  echo '{"responseMessageDetails": ' . $responseMessage->buildJsonObject($responseMessage,"Registration Fail:".$pdoex->getMessage()) . '}';
            //echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

        } catch (Exception $ex) {
             $responseMessage->setMessage($ex->getMessage());
                $responseMessage->setComments("Exception");
                 $responseMessage->setStatus("Fail");
                    $responseMessage->buildMessageBlock($responseMessage->getMessage(),  $responseMessage->getStatus(),$responseMessage->getComments(),$result);
            //  echo '{"responseMessageDetails": ' . $responseMessage->buildJsonObject($responseMessage,"Registration Fail:".$ex->getMessage()) . '}';
           // echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
        }
    
}
function buildMessageBlock($message,$status,$comments,$result){
    //print_r($result);
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    
     $responseMessage->setMessage($message);
     $responseMessage->setStatus($status);
     $responseMessage->setComments($comments);
    
    //print_r(buildJsonObject($responseMessage,$result));
    $responseReturn =  '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    return $responseReturn;
    
}
function buildErrorObject($e){
    $responseData = json_encode(array(
            'message' => $e->getMessage(),
            'status' => "Fail",
            'filename' => $e->getFile(),
            'code' => $e->getCode(),  
            'errorstringDetail'=>$e->getTraceAsString()
        ));
    return $responseData;
}
function buildJsonObject($responseMessage,$result){
    $responseData = json_encode(array(
            'message' => $responseMessage->getMessage(),
            'status' => $responseMessage->getStatus(),
            'data' => $result,
            'comments' => $responseMessage->getComments()                 
        ));
    return $responseData;
}
function fetchCategoryDetails($officeid,$insttype){
    $c = new Category();
    $result = $c->fetchCategoryDetails($officeid,$insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
    echo $responseReturn;
}
function createCategoryDetails(){
    $responseMessage = new ResponseMessage();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $Data = json_decode($request->getBody());
        $result =  $c->createCategoryDetails($Data);
        $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function updateCategoryDetails(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateCategoryDetails($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteCategoryDetails($categoryid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewCategoryDetails($categoryid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}



function fetchSubCategoryDetails($officeid,$insttype){
    $c = new Category();
    $result = $c->fetchSubCategoryDetails($officeid,$insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
    echo $responseReturn;
}

function createSubCategoryDetails(){
    $responseMessage = new ResponseMessage();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $Data = json_decode($request->getBody());
        $result =  $c->createSubCategoryDetails($Data);
        $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}


function updateSubCategoryDetails(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateSubCategoryDetails($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteSubCategoryDetails($subcategoryid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteSubCategoryDetails($subcategoryid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function fetchItemDetails($officeid,$insttype){
    $c = new Category();
    $result = $c->fetchItemDetails($officeid,$insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
    echo $responseReturn;
}

function createItemDetails(){
    $responseMessage = new ResponseMessage();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $Data = json_decode($request->getBody());
        $result =  $c->createItemDetails($Data);
        $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function updateItemDetails(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateItemDetails($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteItemDetails($itemid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewItemDetails($itemid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function fetchSubItemDetails($officeid,$insttype){
    $c = new Category();
    $result = $c->fetchSubItemDetails($officeid,$insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
    echo $responseReturn;
}


function createSubItemDetails(){
    $responseMessage = new ResponseMessage();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $Data = json_decode($request->getBody());
        $result =  $c->createSubItemDetails($Data);
        $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function updateSubItemDetails(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateSubItemDetails($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteSubItemDetails($subitemid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteSubItemDetails($subitemid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function fetchSupplier($officeid,$insttype){
    $c = new Category();
    $result = $c->fetchSupplier($officeid,$insttype);
    $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
    echo $responseReturn;
}

function createSupplierDetails(){
    $responseMessage = new ResponseMessage();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $Data = json_decode($request->getBody());
        $result =  $c->createSupplierDetails($Data);
        $responseMessage->setStatus("Success");
       echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
}

function fetchTaxInfo($officeid){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();;
    
    $result = $c->fetchTaxSettings($officeid);
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
      
         echo $responseReturn;
}


function insertNewTaxSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
        
     $_SESSION["id"]=1035;
     $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    print_r($requestData);
    $result = $c->insertNewTaxSettings($requestData,$officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function deleteNewTaxSettings($taxid){
    try{
   
   $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewTaxSettings($taxid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function updateExistingTaxInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingTaxInfo($requestData);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function fetchChargesInfo($officeid){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchChargesSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchWardInfo($officeid){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchWardSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchRoomInfo($officeid){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchRoomSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchOperationsInfo($officeid){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchOperationSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchRoomTypeInfo(){
    $officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchRoomTypeSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchServicesInfo($officeid){
    //$officeid = $_SESSION['officeid'];
    $c = new Category();
    try{
    $result = $c->fetchServicesSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function fetchServicesTypeInfo(){
    $officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchServicesTypeSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}


function fetchCompanyInfo(){
    $officeid = $_SESSION['officeid'];
    $c = new Category();
    try{
    $result = $c->fetchCompanySettings($officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result),"Done", $result); 
      
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewChargesSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
   $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewChargeSettings($requestData,$officeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function insertNewWardSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
   
     $_SESSION["id"]=1035;
     $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewWardSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewOperationsSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
   $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewOperationsSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewRoomSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewRoomSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function insertNewRoomTypeSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewRoomTypeSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function insertNewServicesSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewServicesSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function insertNewServicesTypeSettings(){
    try{
    $officeid = $_SESSION['officeid'];
   
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    $result = $c->insertNewServicesTypeSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function insertNewCompanySettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewCompanySettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}



function fetchSupplierInfo(){
    $officeid = $_SESSION['officeid'];
    $c = new Category();
    try{
    $result = $c->fetchSupplierSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewSupplierSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewSupplierSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function fetchExpencesInfo($spentdatefrom,$spentdateto,$officeid){
    //$officeid = $_SESSION['officeid'];
    $c = new Category();
    try{
    $result = $c->fetchExpencesSettings($spentdatefrom,$spentdateto,$officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewExpencesSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewExpencesSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}



function fetchSpecialoffersInfo($currentdate,$officeid){
    $c = new Category();
    try{
    $result = $c->fetchSpecialoffersSettings($currentdate,$officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewSpecialoffersSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewSpecialoffersSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function fetchSpecialofferdetailsInfo($splofferid,$officeid){
    $c = new Category();
    try{
    $result = $c->fetchSpecialofferdetailsSettings($splofferid,$officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewSpecialofferdetailsSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewSpecialofferdetailsSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function fetchReferalsInfo($officeid){
    $c = new Category();
    try{
    $result = $c->fetchRerralsSettings($referalrateid,$officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewReferalsSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewReferalsSettings($requestData,$officeid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function fetchReferalRatesInfo($officeid){
    $c = new Category();
    try{
    $result = $c->fetchReferalRatesSettings($officeid);
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertNewReferalRatesSettings(){
    try{
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $testid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $requestData = json_decode($request->getBody());
    //print_r($requestData);
    $result = $c->insertNewReferalRatesSettings($requestData,$testid);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function updateExistingChargesInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingChargesInfo($requestData);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingWardInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingWardInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingRoomInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingRoomInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingRoomTypeInfo(){
    
    try{
        $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingRoomTypeInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingServicesInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingServicesInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingServicesTypeInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingServicesTypeInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingOperationsInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingOperationsInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}



function updateExistingCompanyInfo(){
    
    try{
         $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingCompanyInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}



function updateExistingSupplierInfo(){
    
    try{
      $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingSupplierInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingExpencesInfo(){
    
    try{
        $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingExpencesInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}


function updateExistingSpecialoffersInfo(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingSpecialoffersInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingReferalsInfo(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingReferalsInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateExistingReferalRatesInfo(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingReferalRatesInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}



function updateExistingSpecialofferdetailsInfo(){
    
    try{
          $c = new Category();
  
            $request = \Slim\Slim::getInstance()->request();
           $requestData = json_decode($request->getBody());
           $result = $c->updateExistingSpecialofferdetailsInfo($requestData);
        if($result > 0)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
         echo $responseReturn;
     }catch(Exception $e){
        echo $e->getMessage();
    }
}

function deleteNewChargesSettings($chargeid){
    try{
   
   $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewChargeSettings($chargeid);
         $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : "."Done", $result); 
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewWardSettings($wardid){
    try{
   
    $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewWardSettings($wardid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}
function deleteNewRoomSettings($roomid){
    try{
   
    $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewRoomSettings($roomid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewRoomTypeSettings($roomid){
    try{
   
    $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewRoomTypeSettings($roomid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewServicesSettings($servicesid){
    try{
   
    $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewServicesSettings($servicesid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewOperationsSettings($operationid){
    try{
   
   $c = new Category();
   //print_r($taxid);
    $result = $c->deleteNewOperationsSettings($operationid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewCompanySettings($companyid){
    try{
   
    $c = new Category();
   //print_r($companyid);
    $result = $c->deleteNewCompanySettings($companyid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewSupplierSettings($supplierid){
    try{
   
    $c = new Category();
   //print_r($supplierid);
    $result = $c->deleteNewSupplierSettings($supplierid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewExpencesSettings($expenceid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewExpencesSettings($expenceid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}


function deleteNewSpecialoffersSettings($specialofferid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewSpecialoffersSettings($specialofferid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewSpecialofferdetailsSettings($splofferid){
    try{
   
     $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewSpecialofferdetailsSettings($splofferid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewReferalsSettings($referalrateid){
    try{
   
   $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewReferalsSettings($referalrateid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

function deleteNewReferalRatesSettings($referalid){
    try{
   
    $c = new Category();
   //print_r($expenceid);
    $result = $c->deleteNewReferalRatesSettings($referalid);
         if($result < 1)
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
}

/* ========= Added for Lab module ========= */

function getLabTestData($testId){
    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $lb = new Laboratory();
    try {
    
        $result =  $lb->getLabDetailData($testId);
     
      $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 

         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function createLabTest(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
    $lb = new Laboratory();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $labData = json_decode($request->getBody());
    //print_r($labData);
        $result =  $lb->createLabData($labData);
      //  var_dump($result);    
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }   

}



function editLabTestData(){

    $hsmRegistration = new HSMRegistrationLogin();
    $responseMessage = new ResponseMessage();
    $hsmMessage = new HSMMessages();
   $lb = new Laboratory();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $editTestData = json_decode($request->getBody());

        $result =  $lb->editLabTestData($editTestData);
        //var_dump($result);
        $responseMessage->setMessage(HSMMessages::$generaleditTestPriceMessage);
        $responseMessage->setStatus("Success");

        echo '{"responseMessageDetails": ' . buildJsonObject($responseMessage,$result) . '}';
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}


function getLastLabtestsdetailsId(){
	$hsmRegistration = new HSMRegistrationLogin();
	$responseMessage = new ResponseMessage();
	$hsmMessage = new HSMMessages();
	$lb = new Laboratory();
	try {
	
		$result =  $lb->getLastLabtestsdetailsId();
	
		$responseMessage->setMessage(HSMMessages::$generalDiagnosticLabMessage);
		$responseMessage->setStatus("Success");
	
		echo json_encode($result);
	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

function fetchThresholdInfo(){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $result = $c->fetchThresholdSettings();
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}


function createLabAppointment(){
    try{
    
       
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $appointmentData = json_decode($request->getBody());
     //print_r($appointmentData);
    $result = $c->createLabAppointment($appointmentData);
 
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }    
}


function insertNonPrescriptionDiagnosisDetails(){
    try{
            
    //$officeid = $_SESSION['officeid'];
  
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $consultationDetails = json_decode($request->getBody());
    print_r($consultationDetails);
    $result = $c->insertNonPrescriptionDiagnosisDetails($consultationDetails);
    //print_r($result);
    if($result > 0)
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
          $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
         echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

 function fetchDepartments(){
    //$officeid = $_SESSION['officeid'];
     $c = new Category();
    try{
    $departments = $c->getdepartments();
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

    function fetchmeasureunits(){
    $c = new Category();
    try{
    $result = $c->getmeasureunits();
 $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);       
         echo $responseReturn;
         
    }catch(Exception $e){
        echo $e->getMessage();
    } 
}

function insertTestCreationDetails(){
    try{
  
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $testcreationData = json_decode($request->getBody());
   
     /*$date = (date('ymdHis'));//echo "<br/>";
     $receiptid =  "HCM".$date."MEDICINE".mt_rand(0, 999);
     $appointmentId = mt_rand(0, 999);*/
   //print_r($testcreationData); echo "helllo";
     $result = $c->insertTestCreationDetails($testcreationData,$officeid);

   //print_r($result);
    if($result == "success")
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
      echo $responseReturn;
    }catch(Exception $e){
        echo $e->getMessage();
    }     
    catch(Exception $e){
        echo $e->getLine();
    } 
}

function UpdateTestCreation(){

    $hsmMessage = new HSMMessages();
    $c = new Category();
    try {
        $request = \Slim\Slim::getInstance()->request();
        $labData = json_decode($request->getBody());

        $result =  $c->UpdateTestCreation($labData);
        
        //var_dump($result);
        if($result == "Success")
                $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdated, "Success","Total Records : "."Done", $result); 
            else {
                 $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsUpdatedFailure, "Fail","Total Records : "."Done", $result); 
            }
            echo $responseReturn;
            
    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobile){
    $ad = new AppointmentData();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $ad->fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}

function fetchPatientTestDetails($appointmentId){
    $dd = new DiagnosticData();
    try{
        $result = $dd->fetchPatientTestDetails($appointmentId);
        if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            echo $responseReturn;
        }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
        }


    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}

function insertLabBillingDetails(){
    try{
  
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $labBillingData = json_decode($request->getBody());
   
     $date = (date('ymdHis')); //echo "$date";
     $receiptid =  "HCM".$date."TEST".mt_rand(0, 999);
     $appointmentId = mt_rand(0, 999);
     
    //print_r($labBillingData);
     $result = $c->insertLabBillingDetails($labBillingData,$receiptid,$officeid,$appointmentId);
    echo $result;
     
    if($result == "success")
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
      echo $responseReturn;
      
    }catch(Exception $e){
        echo $e->getMessage();
    }     
    catch(Exception $e){
        echo $e->getLine();
    } 
}

function diagnosticsTestDataByNameandId($diagnosticsId,$testname){
    
    
      $c = new Category();
    try{
        if($diagnosticsId == "nodata") $diagnosticsId = $_SESSION['officeid'];
        $result ="";
        $result = $c->diagnosticsTestDataByNameandId($diagnosticsId,$testname);
     //  echo "<br/>";echo "<br/>";echo "<br/>"; print_r($result);echo "<br/>";echo "<br/>";echo "<br/>";
        if(count($result) > 0){
              $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
              echo $responseReturn;
         }else{
               $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result);

               echo $responseReturn;
         } 
        
        
     } catch (PDOException $pdoex) {
       echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }
    
}


function fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobile){
      $c = new Category();
    
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $c->fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}

function fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobile){
    
     $c = new Category();
    
     $mobilePatientId = array();
    if($mobile != "nodata"){
        $mobilePatientId = fetchPatientId($mobile);
       
    }
 
    if(count($mobilePatientId) < 1 && $mobile != "nodata"){
      
        if(count($mobilePatientId) < 1 && $patientName == "nodata"  && $patientId == "nodata"  && $appointmentid == "nodata" ){
             $responseReturn = buildMessageBlock(HSMMessages::$generalNoAppointmentRecordsMessage, "Fail","Total Records : ".count($mobilePatientId), $mobilePatientId);
             echo $responseReturn;
        }
    } else {
    if(count($mobilePatientId) > 0 ){
        $mobileNumber = $mobilePatientId[0]->ID;
    }else{
        $mobileNumber = "nodata";
    }
    
    
    $result = $c->fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobile);
    //print_r($result);
     if(count($result) > 0)
          $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result); 
     else
          $responseReturn = buildMessageBlock(HSMMessages::$generalNoRecordsMessage, "Fail","Total Records : ".count($result), $result); 
    }     
     echo $responseReturn;
    
}

function getTestPrices($testname){
    
	  $c = new Category();

	try {
		$result =  $dd->getSearchedTestPriceData($_SESSION['officeid'],$testname);

		if(count($result) > 0){
			$responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
			echo $responseReturn;
		}else{
			$responseReturn = buildMessageBlock(HSMMessages::$generalNoSearchResultLabMessage, "Fail","Total Records : ".count($result), $result);

			echo $responseReturn;
		}


	} catch (PDOException $pdoex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';
	} catch (Exception $ex) {
		//echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
	}
}

function getPatientTestDetails($appointmentId){
    $dd = new DiagnosticData();
    try{
        $result = $dd->getPatientTestDetails($appointmentId);
        if(count($result) > 0){
            $responseReturn = buildMessageBlock(HSMMessages::$generalSuccessMessage, "Success","Total Records : ".count($result), $result);
            echo $responseReturn;
        }else{
            $responseReturn = buildMessageBlock(HSMMessages::$generalNoMedicalTestMessage, "Fail","Total Records : ".count($result), $result);

            echo $responseReturn;
        }


    } catch (PDOException $pdoex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($pdoex) . '}';

    } catch (Exception $ex) {
        echo '{"responseErrorMessageDetails": ' . buildErrorObject($ex) . '}';
    }

}


function insertHallBooking(){
    
    try{
  
    //$officeid = $_SESSION['officeid'];
    $_SESSION["id"]=1035;
    $officeid = $_SESSION["id"];
    $c = new Category();
  
     $request = \Slim\Slim::getInstance()->request();
    $HallBookingData = json_decode($request->getBody());
     $result = $c->insertHallBooking($HallBookingData);

    if($result == "success")
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInserted, "Success","Total Records : "."Done", $result); 
     else {
         $responseReturn = buildMessageBlock(HSMMessages::$generalRecordsInsertedFailure, "Fail","Total Records : "."Done", $result); 
     }
      echo $responseReturn;
      
    }catch(Exception $e){
        echo $e->getMessage();
    }     
    catch(Exception $e){
        echo $e->getLine();
    }
}

?>