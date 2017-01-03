<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Laboratory {
    

 function createLabData($labData){
     	
     	$dbConnection = new HSMDatabase();
     	$insertedId = "";
     	
     	
     	$sql = "INSERT INTO  labtests (testname,testtype,status,createdby,createddate,department,sampletype,
            reportingtime,discountapplied,officeid)
     	VALUES (:testname, :testtype, :status, :createdby, SYSDATE(), :department, :sampletype, :reportingtime,
        :discountapplied, :officeid)";
     	
     	$sql1 = "INSERT INTO  labtestsdetails (testid,testname,parametername,unitsid,comments,status,createdby,createddate,bioref,addinputs)
     	VALUES (:testid, :testname, :parametername, :unitsid, :comments, :status, :createdby, SYSDATE(), :bioref, :addinputs)";
     	
     	$sql2 ="INSERT INTO  diagnostics_tests (testid,diagnosticsid,status,createdby,createddate)
     	VALUES (:testid, :diagnosticsid, :status, :createdby, SYSDATE())";
     	
        echo "$sql";
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testname", $labData->testname);
     		$stmt->bindParam("testtype", $labData->testtype);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("createdby", $labData->createdby);
     		$stmt->bindParam("department", $labData->department);
                $stmt->bindParam("sampletype", $labData->sampletype);
                $stmt->bindParam("reportingtime", $labData->reportingtime);
                $stmt->bindParam("discountapplied", $labData->discountapplied);
                $stmt->bindParam("officeid", $labData->officeid);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     		
     		foreach($labData->paramData as $key => $value){
     			 
                    $unitsDetails =  $this->getmeasureunitsByName($value[1]);
                    
     			$stmt = $db->prepare($sql1);
     			$stmt->bindParam("testid", $insertedId);
     			$stmt->bindParam("testname", $labData->testname);
     			$stmt->bindParam("parametername", $value[0]);
     			$stmt->bindParam("unitsid", $unitsDetails[0]->id);
     			$stmt->bindParam("comments", $value[2]);
     			$stmt->bindParam("status", $labData->status);
     			$stmt->bindParam("createdby", $labData->createdby);
     			$stmt->bindParam("bioref", $value[4]);
     			$stmt->bindParam("addinputs", $value[3]);
     			$stmt->execute();
     			$presMasterData = $db->lastInsertId();
     			//echo $stmt->debugDumpParams();
     		}
     		
     		$stmt = $db->prepare($sql2);
     		$stmt->bindParam("testid", $insertedId);
     		$stmt->bindParam("diagnosticsid", $labData->diagnosticstestid);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("createdby", $labData->createdby);
     		$stmt->execute();
     		
     		$db = null;
     		return $insertedId;
     		
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	
     }
     
     function getLabData($userId){
     	
     	$db = new HSMDatabase();
     	if($userId != ""){
     		$sql = "select * from labtests where createdby = $userId ORDER BY createddate DESC";
     	}else{
     		$sql = "select * from labtests ORDER BY createddate DESC";
     	}
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		/*if($userId != ""){
     			$stmt->bindParam("createdby", $userId);
     		}*/
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getIndustryUnMapTestData($officeid){
     	$db = new HSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT lab.id,lab.testname,lab.department FROM labtests lab LEFT JOIN diagnostics_tests ON  diagnostics_tests.testid = lab.id WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
      $sql = "select labtests.id,labtests.testname,departments.departmentname from labtests,departments where departments.id = labtests.department and 
                    labtests.id not in (select testid from industry_test where industryid = $officeid)";
     // echo $sql;
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$unMappedDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $unMappedDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     function getUnMapTestData(){
     	$db = new HSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT lab.id,lab.testname,lab.department FROM labtests lab LEFT JOIN diagnostics_tests ON  diagnostics_tests.testid = lab.id WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
     	/*$sql = "SELECT lab.id,lab.testname,departments.departmentname FROM labtests as lab
     	LEFT JOIN diagnostics_tests ON diagnostics_tests.testid = lab.id
     	LEFT JOIN departments ON departments.id = lab.department WHERE diagnostics_tests.testid IS NULL ORDER BY id DESC";
         * 
         */
        $officeid = $_SESSION['officeid'];
        $sql = "select labtests.id,labtests.testname,departments.departmentname from labtests,departments where departments.id = labtests.department and 
                    labtests.id not in (select testid from diagnostics_tests where diagnosticsid = $officeid)";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $medicalDetails;
     
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
    }

     }
     function getTestData($testId){
     
     	$db = new HSMDatabase();
     		$sql = "select * from labtests where id = $testId";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     	 
     }
     
     function getLabDetailData($testId){
     	$db = new HSMDatabase();
     	$sql = "SELECT * FROM labtestsdetails WHERE testid = $testId";
        echo "$sql";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("testid", $testId);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     		 
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
    /* function getLabFullDetail($testId){
     	$db = new HSMDatabase();
     	$sql = "select * from labtestsdetails where testid = $testId";
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("testid", $testId);
     		$stmt->execute();
     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $labDetails;
     
     	} catch(PDOException $e) {
     
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
   */  
     
     
     
     function editLabTestData($labData){
     	$dbConnection = new HSMDatabase();
     	
      	$sql = "UPDATE  labtests SET testname=:testname, testtype=:testtype, status=:status,  createddate=SYSDATE(), department=:department WHERE id = $labData->testid";
     	
      //$sql1 = "UPDATE labtestsdetails SET testname=:testname, parametername=:parametername, unitsid=:unitsid, comments=:comments, status=:status, createddate=SYSDATE(), bioref=:bioref, addinputs=:addinputs WHERE id = $labData->paramIds[$key]";
      	
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testname", $labData->testname);
     		$stmt->bindParam("testtype", $labData->testtype);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("status", $labData->status);
     		$stmt->bindParam("department", $labData->department);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     	foreach($labData->paramData as $key => $value){
     		
     		if($labData->paramType[$key] == 'insert'){
     			
     					$stmt = $db->prepare("INSERT INTO  labtestsdetails (testid,testname,parametername,unitsid,comments,status,createdby,createddate,bioref,addinputs)
     			VALUES (:testid, :testname, :parametername, :unitsid, :comments, :status, :createdby, SYSDATE(), :bioref, :addinputs)");

     					$stmt->bindParam("testid", $labData->testid);

     					$stmt->bindParam("testname", $labData->testname);

     					$stmt->bindParam("parametername", $value[0]);

     					$stmt->bindParam("unitsid", $value[1]);

     					$stmt->bindParam("comments", $value[2]);

     					$stmt->bindParam("status", $labData->status);

     					$stmt->bindParam("createdby", $labData->createdby);

     					$stmt->bindParam("bioref", $value[3]);

     					$stmt->bindParam("addinputs", $value[4]);

     					$stmt->execute();

     					$presMasterData = $db->lastInsertId();

     			

     		}else{
     			$stmt = $db->prepare("UPDATE labtestsdetails SET testname=:testname, parametername=:parametername, unitsid=:unitsid, comments=:comments, status=:status, createddate=SYSDATE(), bioref=:bioref, addinputs=:addinputs WHERE id =". $labData->paramIds[$key]);
	     		$stmt->bindParam("testname", $labData->testname);
	     		$stmt->bindParam("parametername", $value[0]);
	     		$stmt->bindParam("unitsid", $value[1]);
	     		$stmt->bindParam("comments", $value[2]);
	     		$stmt->bindParam("status", $labData->status);
	     		$stmt->bindParam("bioref", $value[3]);
	     		$stmt->bindParam("addinputs", $value[4]);
	     		$stmt->execute();
	     		$insertedId = $db->lastInsertId();
     		}
     	}
     		
     		$db = null;
     		return $insertedId;
     		
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     	 
     }
     
    
     function getLastLabtestsdetailsId(){

     	$db = new HSMDatabase();

     	$sql = 'SELECT MAX(id) as MaximumID FROM labtestsdetails';

     

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//$response = Slim::getInstance()->response();

     	}

     }
     

     function getLabTests($officeId){

     	$db = new HSMDatabase();

     	$sql = "select * from labtests where id in (select testid from diagnostics_tests where diagnosticsid = :diagnosticsid)";

     

     	try {

     		$db = $db->getConnection();

     		$stmt = $db->prepare($sql);

     		$stmt->bindParam("diagnosticsid", $officeId);

     		$stmt->execute();

     		$labDetails = $stmt->fetchAll(PDO::FETCH_OBJ);

     		$db = null;

     		return $labDetails;

     

     	} catch(PDOException $e) {

     

     	} catch(Exception $e1) {

     		//    $response = Slim::getInstance()->response();

     	}

     }
     
     

}
   

