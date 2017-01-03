<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author kpava
 */
class Category {
    
      function fetchCategoryDetails($officeid,$insttype){
        $sql = "SELECT id, categoryName, description, createdby, createddate, status, officeid FROM category where status = 'Y' and officeid = '$officeid' and "
                . " insttype = '$insttype' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $categoryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $categoryDetails;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createCategoryDetails($categoryData){
        $sql = "INSERT INTO category(category_name, description, created_by, created_date, status, officeid, insttype) "
                . " VALUES ('$categoryData->category_name', '$categoryData->description', '$categoryData->created_by', CURDATE(), 'Y', '$categoryData->officeid', '$categoryData->insttype') ";
        
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $categoryId = $db->lastInsertId();
                $db = null;
              return $categoryId;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function updateCategoryDetails($categoryinfo){
        
        $sql = "update category set categoryName = '$categoryinfo->categoryName',insttype = '$categoryinfo->insttype',description ='$categoryinfo->description'"
                . " where id = $categoryinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function deleteNewCategoryDetails($categoryid){
       
        $sql = "update category set status = 'N' where id = $categoryid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $categoryData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $categoryData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function fetchSubCategoryDetails($officeid,$insttype){
        $sql = "SELECT id, category_id, sub_category_name, description, created_by, created_date, status, officeid, insttype FROM sub_category;
                          where status = 'Y' and officeid = '$officeid' and "
                              . " insttype = '$insttype' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subCategoryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $subCategoryDetails;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createSubCategoryDetails($subCategoryData){
        $sql = "INSERT INTO sub_category
(category_id, sub_category_name, description, created_by, created_date, status, officeid, insttype) 
VALUES ('$subCategoryData->category_id', '$subCategoryData->sub_category_name', '$subCategoryData->description',  '$subCategoryData->created_by',"
                . " CURDATE(), 'Y', '$subCategoryData->officeid', '$subCategoryData->insttype') ";
        
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subCategoryId = $db->lastInsertId();
                $db = null;
              return $subCategoryId;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function updateSubCategoryDetails($subcategoryinfo){
        
        $sql = "update subcategory set categoryName = '$subcategoryinfo->categoryName',insttype = '$subcategoryinfo->insttype',description ='$subcategoryinfo->description'"
                . " where id = $subcategoryinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subcategoryData = $db->lastInsertId();
                $db = null;
               

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function deleteSubCategoryDetails($subcategoryid){
       
        $sql = "update subcategory set status = 'N' where id = $subcategoryid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subcategoryData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $subcategoryData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchItemDetails($officeid,$insttype){
        $sql = "SELECT id, itemname, itemdescription, itemtype, status, createddate, createdby, photo, thumbnail, categoryid, subcategoryid, discount, 
            officeid, insttype  FROM item  where status = 'Y' and officeid = '$officeid' and "
                              . " insttype = '$insttype' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subCategoryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $subCategoryDetails;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createItemDetails($itemData){
        $sql = "INSERT INTO item
(itemname, itemdescription, itemtype, threshold, status, createddate, createdby, photo, thumbnail, categoryid, subcategoryid, discount, officeid, insttype) 
VALUES ('$itemData->itemname', '$itemData->itemdescription', '$itemData->itemtype', '$itemData->threshold','Y', CURDATE(), '$itemData->createdby', 'photo', 'thumbnail', 
'$itemData->categoryid', '$itemData->subcategoryid', '$itemData->discount', '$itemData->officeid', '$itemData->insttype')";
        
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itemId = $db->lastInsertId();
                $db = null;
              return $itemId;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function updateItemDetails($iteminfo){
        
        $sql = "update item set itemname = '$iteminfo->itemname',itemdescription = '$iteminfo->itemdescription','itemtype ='$iteminfo->itemtype','threshold ='$iteminfo->threshold'"
                . " where id = $iteminfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itemData = $db->lastInsertId();
                $db = null;
               

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function deleteNewItemDetails($itemid){
       
        $sql = "update item set status = 'N' where id = $itemid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itemData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $itemData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchSubItemDetails($officeid,$insttype){
        $sql = " SELECT id, itemid, itemprice, effectivedate, salesprice, status, createddate, createdby, officeid,insttype "
                . " FROM itemprice  where status = 'Y' and officeid = '$officeid' and "
                              . " insttype = '$insttype' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subCategoryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $subCategoryDetails;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createSubItemDetails($itemPriceData){
        $sql = " INSERT INTO itemprice
(itemid, itemprice, effectivedate, salesprice, status, createddate, createdby, officeid,insttype) 
VALUES ('$itemPriceData->itemid', '$itemPriceData->itemprice', '$itemPriceData->effectivedate', '$itemPriceData->salesprice', 'Y',CURDATE(),"
                . " '$itemPriceData->createdby', '$itemPriceData->officeid', '$itemPriceData->insttype')";
        
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itemPrice = $db->lastInsertId();
                $db = null;
              return $itemPrice;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
 
    function updateSubItemDetails($subiteminfo){
        
        $sql = "update itemprice set itemname = '$subiteminfo->itemname',itemdescription = '$subiteminfo->itemdescription',itemtype ='$subiteminfo->itemtype'"
                . " where id = $subiteminfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itempriceData = $db->lastInsertId();
                $db = null;
               

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function deleteSubNewItemDetails($subitemid){
       
        $sql = "update itemprice set status = 'N' where id = $subitemid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $itempriceData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $itempriceData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
       function fetchSupplier($officeid,$insttype){
        $sql = " SELECT id, supplierName, contactPersonName, supplieraddress, email, landLineNo, mobileNo, status, tin, regNumber, createddate, 
            createdby, officeid, insttype FROM supplier  where status = 'Y' and officeid = '$officeid' and "
                              . " insttype = '$insttype' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $subCategoryDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $subCategoryDetails;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function createSupplierDetails($supplierData){
        $sql = " INSERT INTO supplier
(supplierName, contactPersonName, supplieraddress, email, landLineNo, mobileNo, status, tin, regNumber, createddate, createdby, officeid, insttype) 
VALUES ('$supplierData->supplierName', '$supplierData->contactPersonName', '$supplierData->supplieraddress', '$supplierData->email', "
                . " '$supplierData->landLineNo', '$supplierData->mobileNo', 'Y', '$supplierData->tin', '$supplierData->regNumber', CURDATE(), "
                . " '$supplierData->createdby', '$supplierData->officeid', '$supplierData->insttype')";
        
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $supplierDetails = $db->lastInsertId();
                $db = null;
              return $supplierDetails;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
   function fetchTaxSettings($officeid){
        $sql = "select * from tax where officeid = 1 and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchOperationSettings($officeid){
         if($officeid == "")
             $officeid = "1";
        $sql = "select * from hosoperations where officeid = $officeid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $hospitalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $hospitalData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchChargesSettings($officeid){
        $sql = "select * from extracharges where officeid = 1 and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchWardSettings($officeid){
        if($officeid == "")
            $officeid = "1";
        $sql = "select * from ward where officeid = $officeid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              //  print_r($chargeData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchWardDetailsSettings($officeid){
        $sql = "select wd.* from wards_details wd,ward w where w.id = wd.wardid and w.status = 'Y' and w.officeid = $officeid and wd.occupancy = '0' ";
       // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomSettings($officeid){
         if($officeid == "")
             $officeid ="1";
         
        $sql = "select * from rooms where officeid = $officeid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomDetailsSettings($officeid){
          $sql = "select rd.* from rooms_details rd,rooms r where r.id = rd.roomid and r.status = 'Y' and r.officeid = $officeid and rd.occupancy = '0' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomTypeSettings($officeid){
          if($officeid == "")
             $officeid ="1";
        $sql = "select * from roomtype where officeid = $officeid and status = 'Y' ";
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($roomData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    
     function fetchRoomTypeSettingsById($roomid){
          
        $sql = "select id,roomtype from roomtype where id = $roomid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchServicesSettings($officeid){
        $sql = "select hs.*,hst.servicetypename as servicetypename from hosservices hs, hosservicestype hst where hst.id = hs.servicetype "
                . "and hs.officeid = 1 and hs.status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $servicesData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
      function fetchServicesTypeSettings($officeid){
        $sql = "select * from hosservicestype where officeid = 1 and status = 'Y' ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesTypeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $servicesTypeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    
    function fetchCompanySettings($officeid){
        
         if($officeid == "")
             $officeid ="1";
         
        $sql = "select * from hosiptal where officeid = $officeid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
        // echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $companyData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($companyData);
                return $companyData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
      function fetchSupplierSettings($officeid){
        
         if($officeid == "")
             $officeid ="1";
         
        $sql = "select * from supplier where officeid = $officeid and status = 'Y' ";
         $dbConnection = new HSMDatabase();
        // echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $supplierData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($supplierData);
                return $supplierData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    
    function fetchExpencesSettings($spentdatefrom,$spentdateto,$officeid){
        
         if($officeid == "")
             $officeid ="1";
      $sql = "select * from expenses where spentdatefrom between '$spentdatefrom' AND '$spentdateto' AND officeid = '$officeid' AND status = 'Y'";  
         $dbConnection = new HSMDatabase();
         echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $supplierData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($supplierData);
                return $supplierData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
   
    
    function fetchSpecialoffersSettings($currentdate,$officeid){
        
         if($officeid == "")
             $officeid ="1";
         $currentdate = date('Y-m-d');
         
      $sql = "select * from specialoffers where currentdate = '$currentdate' AND officeid = '$officeid' AND status = 'Y'";  
         $dbConnection = new HSMDatabase();
         echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $SpecialoffersData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($SpecialoffersData);
                return $SpecialoffersData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}   
    }
    
    
    function fetchSpecialofferdetailsSettings($splofferid,$officeid){
        
         if($officeid == "")
             $officeid ="1";
         $currentdate = date('Y-m-d');
         
      $sql = "select s.offername,offerfromdate,offertodate,offerprice,currentdate,
          createddate from specialoffer s.splofferid,offeronid,createddate  ";
         $dbConnection = new HSMDatabase();
         echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $SpecialoffersDetailsData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($SpecialoffersData);
                return $SpecialoffersDetailsData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}   
    }
    
    
    function fetchRerralsSettings($officeid){
        
         if($officeid == "")
             $officeid ="1";
         $currentdate = date('Y-m-d');
         
      $sql = "select * from referal where officeid = '$officeid' AND status = 'Y'";  
         $dbConnection = new HSMDatabase();
         echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($SpecialoffersData);
                return $referalData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}   
    }
    
    
    function fetchReferalRatesSettings($officeid){
        
         if($officeid == "")
             $officeid ="1";
         $currentdate = date('Y-m-d');
         
     // $sql = "select * from referalrates where officeid = '$officeid' AND status = 'Y'";
         
         $sql = "select Rr.id,Rr.referalid,Rr.referedto,Rr.referencetype,Rr.status,Rr.paymenttype,
             Rr.amountpercent,Rr.effectivedate,R.referalname,R.referaltype,R.mobile,R.address,R.city,
             R.district,R.mandal,R.zipcode from referalrates Rr,referal R where R.id=Rr.referalid";
   
         $dbConnection = new HSMDatabase();
         //echo $sql;
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $ReferalratesData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($SpecialoffersData);
                return $ReferalratesData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}   
    }
    
    function insertNewChargeSettings($chargeInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into extracharges(chargename,chargetype,chargebleamount,status,createddate,createdby,officeid,discount) "
                . "values('$chargeInfo->chargename','$chargeInfo->chargetype',"
                . "'$chargeInfo->chargebleamount',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$chargeInfo->discount')";
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function insertNewServicesSettings($servicesInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
      //  var_dump($servicesInfo);
         
        $sql = "insert into hosservices(servicesname,servicetype,subservicename,status,createddate,createdby,officeid,servicecost) "
                . "values('$servicesInfo->servicesname',$servicesInfo->servicetype,"
                . "'$servicesInfo->subservicename',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$servicesInfo->servicecost')";
     //   echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
                return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function insertNewWardSettings($wardInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
         $userid  = $officeid;
       // var_dump($wardInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into ward(wardname,wardtype,bedscount,status,createddate,createdby,officeid,discount,bedcost) "
                . "values('$wardInfo->wardname','$wardInfo->wardtype',"
                . "'$wardInfo->bedscount',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$wardInfo->discount','$wardInfo->bedcost')";
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
                $this->createWardList($wardInfo->bedscount, $wardInfo->wardname, $wardData, $userid);
                return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function insertNewRoomSettings($roomInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
      //  var_dump($roomInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        //echo $officeid;
         
        $sql = "insert into rooms(roomname,roomtype,totalrooms,status,createddate,createdby,officeid,discount,roomcost) "
                . "values('$roomInfo->roomname','$roomInfo->roomtype',"
                . "'$roomInfo->totalrooms',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$roomInfo->discount','$roomInfo->roomcost')";
        
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                $this->createRoomsList($roomInfo->totalrooms, $roomInfo->roomname, $roomData, $userid,$roomInfo->roomtype);
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function createRoomsList($roomscount,$roomname,$roomid,$userid,$roomtype){
        
         if($userid == "")
            $userid = "Admin";
          $dbConnection = new HSMDatabase();
           $db = $dbConnection->getConnection();
           
          $result =  $this->cRoomTypeSettingsById($roomtype);
           
        for($i=1;$i<$roomscount+1;$i++){
            $roomnumber = $result[0]->roomtype."-".$roomname."-".$i;
            
            $sql = "insert into rooms_details(roomid,status,createddate,createdby,room_name) "
                . "values($roomid,"
                . " 'Y',CURDATE(),'$userid','$roomnumber')";
        
                  try {
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $roomDetailsData = $db->lastInsertId();
                       
                   } catch(PDOException $e) {
                        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                } catch(Exception $e1) {
                        echo '{"error111":{"text111":'. $e1->getMessage() .'}}'; 
                } 
                
        }
      $db = null;
   return $roomDetailsData;       
    }
    
    
     function deleteRoomsDetails($roomid){
         $sql = "delete from rooms_details  where roomid = $roomid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteOperationsDetails($operationid){
         $sql = "delete from hosoperations  where id = $operationid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $operationData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function createWardList($wardcount,$wardname,$wardid,$userid){
        
        
         if($userid == "")
            $userid = "Admin";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection();
        for($i=1;$i<$wardcount+1;$i++){
            $wardnumber = $wardname."-".$i;
            $sql = "insert into wards_details(wardid,status,createddate,createdby,ward_name) "
                . "values($wardid,"
                . " 'Y',CURDATE(),'$userid','$wardnumber')";
        
                
                  try {
                       
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $roomDetailsData = $db->lastInsertId();
                       
                   } catch(PDOException $e) {
                        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                } catch(Exception $e1) {
                        echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
                } 
        }
       $db = null;
       return $roomDetailsData;      
    }
    
    
    function createCompanyAddress($displayName, $id, $userid){
        
        
         if($userid == "")
            $userid = "Admin";
         $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection();
            $sql = "insert into hospital(id,addressline1,addressline2,addressline3,status,createddate,createdby) "
                . "values($id,'$addressline1','$addressline2','$addressline3','Y',CURDATE(),'$userid')";
        
                echo $sql;
                  try {
                       
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $adressData = $db->lastInsertId();
                      
                   } catch(PDOException $e){
                        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                } catch(Exception $e1) {
                        echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
                }
                
       $db = null;
       return $adressData;
    }
    
    function insertNewTaxSettings($taxInfo,$officeid){
     
      //$userid  = $_SESSION['logeduser'];
       
           $userid  = $officeid;
       // $officeid = $_SESSION['officeid'];
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into tax(taxname,taxdesc,taxrate,status,createddate,createdby,officeid) values('$taxInfo->taxname','$taxInfo->taxdesc',"
                . " '$taxInfo->taxrate',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
              
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    function insertNewCompanySettings($companyInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into hosiptal(hosiptalname,signatureInNameOf,dateOfIncorporation,mobile,addressline1,addressline2,addressline3,"
                . "landLine,email,isDealer,isRetailer,status,setupdate,createddate,createdby,officeid)"
                . " values('$companyInfo->hosiptalname','$companyInfo->signatureInNameOf',"
                . "'$companyInfo->dateOfIncorporation','$companyInfo->mobileNo','$companyInfo->addressline1','$companyInfo->addressline2','$companyInfo->addressline3','$companyInfo->landLineNo',"
                . "'$companyInfo->email',"
                . "'$companyInfo->isDealer','$companyInfo->isRetailer',"
                
                . " 'Y','$companyInfo->setupdate',CURDATE(),'$userid',$officeid)";
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $companyData = $db->lastInsertId();
                $db = null;
                //$this->createCompanyAddress($companyInfo->addressline1,$companyInfo->addressline2, $companyInfo->addressline3,$companyData, $userid);
                return $companyData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }


    function insertNewSupplierSettings($supplierInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into supplier(supplierName,contactPersonName,supplieraddress,email,mobileNo,landLineNo,tin,"
                . "regNumber,status,createddate,createdby,officeid)"
                . " values('$supplierInfo->supplierName','$supplierInfo->contactPersonName',"
                . "'$supplierInfo->supplieraddress','$supplierInfo->email','$supplierInfo->mobileNo','$supplierInfo->landLineNo','$supplierInfo->tin',"
                . "'$supplierInfo->regNumber',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $supplierData = $db->lastInsertId();
                $db = null;
                return $supplierData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    
    function insertNewExpencesSettings($expencesInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into expenses(expensestype,expensesname,amount,insttype,spentdateto,spentdatefrom,comments,"
                . "status,createddate,createdby,officeid)"
                . " values('$expencesInfo->expensestype','$expencesInfo->expensesname',"
                . "'$expencesInfo->amount','$expencesInfo->insttype','$expencesInfo->spentdateto','$expencesInfo->spentdatefrom','$expencesInfo->comments',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $expencesData = $db->lastInsertId();
                $db = null;
                return $expencesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
      function insertNewSpecialoffersSettings($specialoffcersInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into specialoffers(offername,offerfromdate,offertodate,offerprice,currentdate"
                . "status,createddate,createdby,officeid)"
                . " values('$specialoffcersInfo->offername','$specialoffcersInfo->offerfromdate',"
                . "'$specialoffcersInfo->offertodate','$specialoffcersInfo->offerprice','$specialoffcersInfo->currentdate',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $specialoffersData = $db->lastInsertId();
                $db = null;
                return $specialoffersData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
   
    function insertNewSpecialofferdetailsSettings($specialoffcersdetailsInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into specialofferdetails(splofferid,offeronid,"
                . "status,createddate,createdby,officeid)"
                . " values('$specialoffcersdetailsInfo->splofferid','$specialoffcersdetailsInfo->offeronid',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $specialoffersData = $db->lastInsertId();
                $db = null;
                return $specialoffersData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function insertNewReferalsSettings($referalsInfo,$officeid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $officeid;
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into referal(referalname,referaltype,address,landline,city,district,mandal,zipcode,mobile,"
                . "status,createddate,createdby,officeid)"
                . " values('$referalsInfo->referalname','$referalsInfo->referaltype','$referalsInfo->address','$referalsInfo->landline',"
                . "'$referalsInfo->city','$referalsInfo->district','$referalsInfo->mandal','$referalsInfo->zipcode','$referalsInfo->mobile',"
                . " 'Y',CURDATE(),'$userid',$officeid)";

         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalData = $db->lastInsertId();
                $db = null;
                return $referalData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function insertNewReferalRatesSettings($referalratesInfo,$testid){
        //$userid  = $_SESSION['logeduser'];
     $userid  = $testid;
        if($userid == "")
            $userid = "Admin";
         if($testid == "")
            $testid = "1";
         
        $sql = "insert into referalrates(referalid,referencetype,referedto,paymenttype,amountpercent,effectivedate,"
                . "status,createddate,createdby,testid)"
                . " values('$referalratesInfo->referalid','$referalratesInfo->referencetype','$referalratesInfo->referedto',"
                . "'$referalratesInfo->paymenttype','$referalratesInfo->amountpercent','$referalratesInfo->effectivedate',"
                . " 'Y',CURDATE(),'$userid',$testid)";
        
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalratesData = $db->lastInsertId();
                $db = null;
                return $referalratesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
            echo $e1->getLine();
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}
    }
   
    function updateExistingTaxInfo($taxinfo){
        
        $sql = "update tax set taxname = '$taxinfo->taxname',taxdesc='$taxinfo->taxdesc',taxrate=$taxinfo->taxrate"
                . " where id = $taxinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function updateExistingChargesInfo($chargeinfo){
        
        $sql = "update extracharges set chargename = '$chargeinfo->chargename',chargetype='$chargeinfo->chargetype',"
                . " chargebleamount=$chargeinfo->chargebleamount,discount='$taxinfo->discount' where id = $chargeinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingWardInfo($wardinfo){
        
        $sql = "update ward set wardname = '$wardinfo->wardname',wardtype='$wardinfo->wardtype',"
                . " bedscount=$wardinfo->bedscount,discount='$wardinfo->discount',bedcost=$wardinfo->bedcost where id = $wardinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
                return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingRoomInfo($roominfo){
        
        $sql = "update rooms set roomname = '$roominfo->roomname',roomtype='$roominfo->roomtype',"
                . " totalrooms=$roominfo->totalrooms,discount='$roominfo->discount',roomcost=$roominfo->roomcost where id = $roominfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function updateExistingOperationsInfo($operationsinfo){
        
        $sql = "update hosoperations set operationname = '$operationsinfo->operationname',Department='$operationsinfo->Department',operationcost='$operationsinfo->operationcost'"
                . "  where id = $operationsinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationsData = $db->lastInsertId();
                $db = null;
                return $operationsData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function updateExistingRoomTypeInfo($roomtypeinfo){
        
        $sql = "update roomtype set roomtype='$roomtypeinfo->roomtype'"
                . "  where id = $roomtypeinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function updateExistingServicesInfo($servicesinfo){
        
        $sql = "update hosservices set servicesname = '$servicesinfo->servicesname',servicetype='$servicesinfo->servicetype',"
                . " subservicename=$servicesinfo->subservicename,servicecost=$servicesinfo->servicecost where id = $servicesinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
                return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function updateExistingServicesTypeInfo($servicestypeinfo){
        
        $sql = "update hosservicestype set servicetypename = '$servicestypeinfo->servicetypename' where id = $servicestypeinfo->id ";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicestypeData = $db->lastInsertId();
                $db = null;
                return $servicestypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
  
    
    function updateExistingCompanyInfo($companyinfo){
        
        $sql = "update hosiptal set hosiptalname = '$companyinfo->hosiptalname',signatureInNameOf ='$companyinfo->signatureInNameOf',dateOfIncorporation ='$companyinfo->dateOfIncorporation',addressline1 ='$companyinfo->addressline1',addressline2 ='$companyinfo->addressline2',"
                . "addressline3 ='$companyinfo->addressline3',mobile ='$companyinfo->mobile',"
                . "landline ='$companyinfo->landline',email ='$companyinfo->email',isDealer ='$companyinfo->isDealer',isRetailer ='$companyinfo->isRetailer'"
                . "  where id = $companyinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $companyData = $db->lastInsertId();
                $db = null;
                return $companyData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    
    function updateExistingSupplierInfo($supplierinfo){
        
        $sql = "update supplier set supplierName = '$supplierinfo->supplierName',contactPersonName ='$supplierinfo->contactPersonName',supplieraddress ='$supplierinfo->supplieraddress',email ='$supplierinfo->email',landLineNo ='$supplierinfo->landLineNo',"
                . "mobileNo ='$supplierinfo->mobileNo',tin ='$supplierinfo->tin',"
                . "regNumber ='$supplierinfo->regNumber'"
                . "  where id = $supplierinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $supplierata = $db->lastInsertId();
                $db = null;
                return $supplierData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function updateExistingExpencesInfo($expencesinfo){
        
        $sql = "update expenses set expensestype = '$expencesinfo->expensestype',expensesname ='$expencesinfo->expensesname',amount ='$expencesinfo->amount',insttype ='$expencesinfo->insttype',spentdateto ='$expencesinfo->spentdateto',"
                . "spentdatefrom ='$expencesinfo->spentdatefrom',comments ='$expencesinfo->comments'"
                . "  where id = $expencesinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $expencesData = $db->lastInsertId();
                $db = null;
                return $expencesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
  
    
    function updateExistingSpecialoffersInfo($specialoffersinfo){
        
        $sql = "update specialoffers set offername = '$specialoffersinfo->offername',offerfromdate ='$specialoffersinfo->offerfromdate',offertodate ='$specialoffersinfo->offertodate',offerprice ='$specialoffersinfo->offerprice'"
                . "  where id = $specialoffersinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $expencesData = $db->lastInsertId();
                $db = null;
                return $expencesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function updateExistingSpecialofferdetailsInfo($specialoffersdetailsinfo){
        
        $sql = "update specialofferdetails set offername = '$specialoffersdetailsinfo->offername',offerfromdate ='$specialoffersdetailsinfo->offerfromdate',offertodate ='$specialoffersdetailsinfo->offertodate',offerprice ='$specialoffersdetailsinfo->offerprice'"
                . "  where id = $specialoffersdetailsinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $expencesData = $db->lastInsertId();
                $db = null;
                return $expencesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function updateExistingReferalsInfo($referalinfo){
        
        $sql = "update referal set referalname = '$referalinfo->referalname',referaltype ='$referalinfo->referaltype',address ='$referalinfo->address',landline ='$referalinfo->landline',"
                . "city ='$referalinfo->city',district ='$referalinfo->district',mandal ='$referalinfo->mandal',zipcode ='$referalinfo->zipcode',mobile ='$referalinfo->mobile'"
                . "  where id = $referalinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalData = $db->lastInsertId();
                $db = null;
                return $referalData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingReferalRatesInfo($referalratesinfo){
        
        $sql = "update referalrates set referalid = '$referalratesinfo->referalid',referencetype ='$referalratesinfo->referencetype',referedto ='$referalratesinfo->referedto',testid ='$referalratesinfo->testid',"
                . "paymenttype ='$referalratesinfo->paymenttype',amountpercent ='$referalratesinfo->amountpercent',effectivedate ='$referalratesinfo->effectivedate'"
                . "  where id = $referalratesinfo->id ";
        
        echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $ReferalratesData = $db->lastInsertId();
                $db = null;
                return $ReferalratesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
     function deleteNewTaxSettings($taxid){
       
        $sql = "update tax set status = 'N' where id = $taxid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewOperationsSettings($operationid){
       
        $sql = "update hosoperations set status = 'N' where id = $operationid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $operationData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewChargeSettings($chargeid){
       
        $sql = "update extracharges set status = 'N' where id = $chargeid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewWardSettings($wardid){
       
        $sql = "update ward set status = 'N' where id = $wardid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
               $this->deleteWardDetails($wardid);
               return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewRoomSettings($roomid){
       
        $sql = "update rooms set status = 'N' where id = $roomid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
               $this->deleteRoomsDetails($roomid);
               return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewRoomTypeSettings($roomtypeid){
       
        $sql = "update roomtype set status = 'N' where id = $roomtypeid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
               
               return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewServicesSettings($servicestypeid){
       
        $sql = "update hosservices set status = 'N' where id = $servicestypeid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
               
               return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
       function deleteNewServicesTypeSettings($servicestypeid){
       
        $sql = "update hosservicestype set status = 'N' where id = $servicestypeid "; 
      // echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicestypeData = $db->lastInsertId();
                $db = null;
               
               return $servicestypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewCompanySettings($companyid){
       
        $sql = "update hosiptal set status = 'N' where id = $companyid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $companyData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $companyData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    
    function deleteNewSupplierSettings($supplierid){
       
        $sql = "update supplier set status = 'N' where id = $supplierid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $SupplierData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $SupplierData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function deleteNewExpencesSettings($expenceid){
       
        $sql = "update expenses set status = 'N' where id = $expenceid "; 
      //echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $ExpencesData = $db->lastInsertId();
                $db = null;
               // print_r($ExpencesData);
                return $ExpencesData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function deleteNewSpecialoffersSettings($specialofferid){
       
        $sql = "update specialoffers set status = 'N' where id = $specialofferid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $specialofferData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $specialofferData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
  
      function deleteNewSpecialofferdetailsSettings($specialofferdetailsid){
       
        $sql = "update specialofferdetails set status = 'N' where id = $specialofferdetailsid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $specialofferdetailsData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $specialofferdetailsData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function deleteNewReferalsSettings($referalid){
       
        $sql = "update referal set status = 'N' where id = $referalid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $referalData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewReferalRatesSettings($referalrateid){
       
        $sql = "update referalrates set status = 'N' where id = $referalrateid "; 
      echo $sql;
        $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $referalData = $db->lastInsertId();
                $db = null;
               // print_r($specialofferData);
                return $referalData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchPatientVisit($startDate,$endDate,$hospitalId){
       
        $dbConnection = new HSMDatabase();
       $sql = "select p.patientname,a.doctorname,p.appointmentdt,a.appointmenttime,a.amount,ifnull(u.cardtype,'') as cardtype "
               . "from prescription p,appointment a,users u where a.id = p.appointmentid and  "
               . "p.hositpalid = :hospitalid and appointmentdt BETWEEN :startDate and :endDate and u.ID = a.patientid";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("hospitalid", $hospitalId);
   		$stmt->execute();
   		$patientList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($patientList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchPatientGeneralInfo($patientid){
       
       
       
        $sql = "select * from patient_general_info where status = 'Y' and patientid = :patientid order by createddate DESC";
      //  echo $sql;
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $patientData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $patientData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
       
   } 
    
 function insertPatientGenralInfo($patientGeneralData){
        
        $sql = "INSERT INTO patient_general_info( paramname, paramvalue, observation, "
                . "status, patientid,createddate) VALUES (:paramname,:paramvalue,:observation,'Y',"
                . ":patientid,CURDATE())";
          $dbConnection = new HSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("paramname", $patientGeneralData->paramname);    //echo "Hello ";
            $stmt->bindParam("paramvalue", $patientGeneralData->paramvalue); //   echo "Hello ";
            $stmt->bindParam("observation", $patientGeneralData->observation);   
           $stmt->bindParam("patientid", $patientGeneralData->patientid); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();       
        
    }
 
    function fetchThresholdSettings($officeid){
        $sql = "SELECT MIN(threshold), itemname FROM item GROUP BY threshold";
         $dbConnection = new HSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $thresholdData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($thresholdData);
                return $thresholdData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	}
        
    }

    
    function createLabAppointment($appointmentData){
        
             $dbConnection = new HSMDatabase();
             $date = (date('ymdHis')); //echo "$date";
            $receiptId =  "HCM".$date."APP".mt_rand(0, 999);
            
             $userid = "1035";
            $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate,StaffName,receiptid)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE(),'$userid','$receiptid')";
                echo $sql;
            try{
//                 
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("doctor", $appointmentData->DoctorId);
            $stmt->bindParam("appdate", $appointmentData->AppointementDate);
            $stmt->bindParam("slot", $appointmentData->AppointmentTime);
            $stmt->bindParam("status",$appointmentData->status);
            $stmt->bindParam("pid", $appointmentData->PatientId);
            $stmt->bindParam("hosiptal", $appointmentData->HosiptalId);
            $stmt->bindParam("pname", $appointmentData->PatientName);
            $stmt->bindParam("hname",$appointmentData->HospitalName);
            $stmt->bindParam("dname", $appointmentData->DoctorName);
            $stmt->bindParam("pregnancy", $appointmentData->pregnancy);
            $stmt->bindParam("child", $appointmentData->child);
            
//            if($appointmentType == "Pregnancy")
//                $stmt->bindParam("pregnancy",$Yes);
//            else 
//                $stmt->bindParam("pregnancy",$No);
//            if($appointmentType == "Child")
//                $stmt->bindParam("child",$Yes);
//            else 
//                $stmt->bindParam("child",$No);
           $stmt->execute();
            $appointment = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams(); 
            //$email->sendMail($doctorName,$hname[0]->hosiptalname,$pname[0]->name,$appdate,$slot,$pid);
            return $appointment; 
  
            } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getLine();
                 echo $pdoex;
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getLine();
                 echo $ex;
                 echo $ex->getFile();
             } 
        
    }
    
    
    function insertNonPrescriptionDiagnosisDetails($consultationDetails){
       $dbConnection = new HSMDatabase();
         $date = (date('ymdHis')); //echo "$date";
       $receiptid =  "HCM".$date."TEST".mt_rand(0, 999);
        echo $receiptid;
//            if($appointmentId == ""){
//                $appointmentId = "0";
//            }
            $appointmentId = "509";
            $price = "100";
            
         $sql = "INSERT INTO consultationdiagnosisdetails(type,namevalue,status,appointmentid,patientid,receiptid,amountcollected,createddate,nonprestest)"
                 . " VALUES(:diagtype,:nameValue,'P','$appointmentId',:patientId,'$receiptid',$price,CURDATE(),'NP')";   
            echo $sql;
        try{
           // echo "..............".$appointmentId;
            
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("diagtype", $consultationDetails->type);
                $stmt->bindParam("nameValue", $consultationDetails->namevalue);
                $stmt->bindParam("patientId", $consultationDetails->patientid);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
           
        } catch(Exception $e1) {
              echo $e1->getLine();
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
    
     function insertBillPaymentDetails($paymentDetails){ 
      
        $dbConnection = new HSMDatabase();
    //    echo "................trantype".$trantype;echo "<br/><br/>";
     
        $officeid ="123";
        $userid = "1035";
  
       
      // echo "heloooooooo".$paymentDetails->trantype;
         $sql = "INSERT INTO payments (patientid,amount,status,paymentfor,paymentdate,createddate,createdby,transactiontype,"
                 . "receiptid,insttype,comments,officeid,appointmentid,actualamount,receiveddate,trantype) "
                 . " VALUES('$paymentDetails->patientid','$paymentDetails->amount','Y','$paymentDetails->paymentfor','$paymentDetails->paymentdate',"
                 . "$paymentDetails->createddate,'$paymentDetails->createdby','$paymentDetails->transactiontype',"
                 . "'$paymentDetails->receiptid','$paymentDetails->insttype','$paymentDetails->comments',$paymentDetails->officeid,"
                 . "'$paymentDetails->appointmentid','$paymentDetails->actualamount','$paymentDetails->receiveddate','$paymentDetails->trantype')";   
         echo $sql;
        try{
         
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {  echo $e->getLine();
            echo '{"error payment":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo $e1->getLine();
            echo '{"error11  payment":{"text11":'. $e1->getMessage() .'}}'; 
        } 
    
    }
   
    function insertDiscountForLab($discountDetails){ 
      
        $dbConnection = new HSMDatabase();
    //    echo "................trantype".$trantype;echo "<br/><br/>";
     
        $officeid ="123";
        $userid = "1035";
  
       
      // echo "heloooooooo".$discountDetails->trantype;
        try{
         $sql = "INSERT INTO discounts (discounttype,endtype,endid,status,createddate,createdby,promotional,cgsdiscount,"
                 . "silver,general,noncardholders,officeid,fromhome,appusers) "
                 . " VALUES('$discountDetails->discounttype','$discountDetails->endtype','$discountDetails->endid','Y','$discountDetails->createddate',"
                 . "'$discountDetails->createdby','$discountDetails->promotional','$discountDetails->cgsdiscount','$discountDetails->silver',"
                 . "'$discountDetails->general','$discountDetails->noncardholders','$discountDetails->officeid',"
                 . "'$discountDetails->fromhome','$discountDetails->appusers')";   
         echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();  
                $masterData = $db->lastInsertId();
             
                $db = null;
              
                //return $presMasterData;
        } catch(PDOException $e) {  echo $e->getLine();
            echo '{"error discount":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo $e1->getLine();
            echo '{"error11  discount":{"text11":'. $e1->getMessage() .'}}'; 
        } 
            
    }
    
     function getdepartments(){
    	$db = new HSMDatabase();
    	$sql = "select * from departments ORDER BY id ASC";
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
    
    function getmeasureunits(){
    	$db = new HSMDatabase();
    	$sql = "select * from measureunits ORDER BY id ASC";
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
    
     function insertTestCreationDetails($testcreationData,$officeid){
     	
     	$dbConnection = new HSMDatabase();
     	$insertedId = "";
        
        //print_r($testcreationData);
      	//echo $testcreationData->testname;
        
    $sql = "INSERT INTO  labtests (testname,price,testtype,status,createdby,createddate,department,sampletype,reportingtime,discountapplied,officeid)
     	VALUES (:testname, :price, 'blood', 'Y', :createdby, SYSDATE(), :department, 'blood', :reportingtime,'Y', '$officeid')";
    
    
    $sql1 = "INSERT INTO labtestsdetails (testid,testname,parametername,unitsid,comments,status,createdby,createddate,bioref,addinputs)
             VALUES (:testid, :testname, :parametername, :unitsid, :comments, 'Y',:createdby, SYSDATE(), :bioref,:addinputs)";
    
        
     try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);//echo "hi";
                $stmt->bindParam("testname", $testcreationData->testname);
                $stmt->bindParam("price", $testcreationData->price);
                //$stmt->bindParam("status", $testcreationData->status);
                $stmt->bindparam("createdby", $testcreationData->createdby);
                $stmt->bindParam("department", $testcreationData->department);
                //$stmt->bindParam("sampletype", $testcreationData->sampletype);
                $stmt->bindParam("reportingtime", $testcreationData->reportingtime);
      		$stmt->execute();
                $insertedId = $db->lastInsertId();
                //echo ($insertedId);
                        
              if(isset($insertedId)){
                $stmt = $db->prepare($sql1);
                $stmt->bindParam("testid", $insertedId);
                $stmt->bindParam("testname", $testcreationData->testname);
                $stmt->bindParam("parametername", $testcreationData->parametername);
                $stmt->bindParam("unitsid", $testcreationData->unitsid);
                $stmt->bindParam("comments", $testcreationData->comments);
                //$stmt->bindParam("status", $testcreationData->status);
                $stmt->bindParam("createdby", $testcreationData->createdby);
                $stmt->bindParam("bioref", $testcreationData->bioref);
                $stmt->bindParam("addinputs", $testcreationData->addinputs);
                $stmt->execute();
                $insertedId_sql1 = $db->lastInsertId();
                //echo "in sql1";
                //return $insertedId_sql1;
               
                if(isset($insertedId_sql1)){
                  return "success";
                }
                else{
                  return "Fail";
                }
                
              }   
            
                
          $db = null;      
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
            echo $e1->getLine();
            echo '{"error11":{"text11":'. $e1->getLine() .'}}';
     	}
     }
     
    
  function UpdateTestCreation($labData){
      
     	$dbConnection = new HSMDatabase();
        $insertedId = "";
        //print_r($labData);
   
      	$sql = "UPDATE  labtests SET testname=:testname, testtype=:testtype, status=:status,  createddate=SYSDATE(), department=:department WHERE id = $labData->testid";
     	
      //$sql1 = "UPDATE labtestsdetails SET testname=:testname, parametername=:parametername, unitsid=:unitsid, comments=:comments, status=:status, createddate=SYSDATE(), bioref=:bioref, addinputs=:addinputs WHERE id = $labData->paramIds[$key]";
      
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->bindParam("testname", $labData->testname);
     		$stmt->bindParam("testtype", $labData->testtype);
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
                    
                       echo $labData->testid;
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
                         if(isset($insertedId)){
                  return "success";
                }
                else{
                  return "Fail";
                }
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
       
     function fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobilePatientId){
        
        
     $sql = " select  distinct appointment.id as appointmentid,appointment.* from appointment INNER JOIN consultationdiagnosisdetails ON consultationdiagnosisdetails.appointmentid = appointment.id 
where (labamount is  NULL or labamount = '') and ";//
//AND hosiptalid = 1 and consultationdiagnosisdetails.type = 'MEDICAL TEST'  ORDER BY appointment.id DESC
                 
                 
          $dbConnection = new HSMDatabase();
       //  $sql = "select * from appointment  where (amount is not NULL or amount != '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "appointment.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "appointment.status = ?";
                $params[] = $status;
                
                $cond[] = "consultationdiagnosisdetails.type = ? ";
                 $params[] = 'MEDICAL TEST';
                         
              /*  $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];
*/
                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY appointment.id DESC";
              // echo $sql;echo "<br/>";
            //   print_r($params);echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $paidNonPrescriptionPatient = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $paidNonPrescriptionPatient;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
    }
     
    function fetchPatientTestDetails($appointmentId){
     	$dbConnection = new HSMDatabase();
     	//$sql = "select * from consultationdiagnosisdetails where appointmentid = :appointmentid";
     	$sql = "SELECT consultationdiagnosisdetails.id as constid,consultationdiagnosisdetails.*,labtests.*,d.finalprice,consultationdiagnosisdetails.patientid,consultationdiagnosisdetails.nonprestest FROM diagnostics_tests d,consultationdiagnosisdetails INNER JOIN labtests ON labtests.id = consultationdiagnosisdetails.namevalue "
                . "WHERE consultationdiagnosisdetails.appointmentid = $appointmentId AND consultationdiagnosisdetails.type = 'MEDICAL TEST' and "
                . " d.testid = namevalue  and consultationdiagnosisdetails.status = 'P' ";
      // echo $sql;
     	trY{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("appointmentid", $appointmentId);
     		$stmt->execute();
     		$appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		 
     		return $appointmentPatientTestDetails;
     
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
     
    function insertLabBillingDetails($labBillingData,$receiptid,$officeid,$appointmentId){
     	
     	$dbConnection = new HSMDatabase();
     	$insertedId = "";
        $userid = "1035";
  
     $sql = "INSERT INTO appointment(patientid,PatientName,phoneMumber,status,createdate,receiptid)
             VALUES (:Patientid,:pname,:mobile,'Y',CURDATE(),'$receiptid')";
    
   $sql1 = "INSERT INTO labtests(testname,price,status,createdby,createddate)
        VALUES (:testname, :price, 'Y', 'LAB', SYSDATE())";
    
     $sql2 = "INSERT INTO payments (patientid,amount,status,createdby,createddate,paymentfor,paymentdate,transactiontype,insttype,comments,officeid,appointmentid,actualamount,receiveddate,trantype,receiptid)
     VALUES (:Patientid, :amount, 'Y','sai',CURDATE(),:paymentfor,CURDATE(),'D','LAB', :comments, '$officeid','$appointmentId', :actualamount,SYSDATE(),'1','$receiptid')";
  

     try{
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
        
            $stmt->bindParam("Patientid", $labBillingData->Patientid);
            $stmt->bindParam("pname", $labBillingData->PatientName);
            $stmt->bindParam("mobile", $labBillingData->phoneMumber);
            //$stmt->bindParam("doctor", $labBillingData->referDoctor);
           // $stmt->bindParam("age", $labBillingData->age);
            //$stmt->bindParam("gender", $labBillingData->gender);
          //$stmt->bindParam("createdby", $labBillingData->createdby);     
             $stmt->execute();
                $insertedId = $db->lastInsertId();
                
             if(isset($insertedId)){
                
                 foreach($labBillingData->TestCollection as $value) {
  
                        $stmt = $db->prepare($sql1);
                        $stmt->bindParam("testname", $value->testname);
                        $stmt->bindParam("price", $value->price);
                        //$stmt->bindParam("createdby", $value->createdby);
                        $stmt->execute();
                        $lastInsertIdsql1 = $db->lastInsertId(); 
                        
                     }
                
          }
          if(isset($lastInsertIdsql1)){
              try{
                    $stmt = $db->prepare($sql2);
                    //echo $sql2;
                    //echo $lastInsertIdsql1;
                   // print_r($labBillingData->Offers); $count = 1;
                   // $array = json_decode($labBillingData->Offers);
                    //var_dump(json_decode($labBillingData->Offers, true));
                 // echo $array->cash;
                //echo $array[1];
                    //$offer = explode(",",$labBillingData->Offers); 
                    //echo $labBillingData->actualamount;
                    //echo $labBillingData->Offers[0]->cash;
                    
                    $cash = "CASH";
                    $comments = 'Test';
                    $stmt->bindParam("Patientid", $labBillingData->Patientid);
                    $stmt->bindParam("comments", $comments);                 
                    $stmt->bindParam("paymentfor", $cash );     
                    $stmt->bindParam("amount", $labBillingData->Offers[0]->cash);
                    $stmt->bindParam("actualamount", $labBillingData->actualamount);
                    $stmt->execute();
                    
                    $ecash = "e-cash";
                    $comments = 'Test';
                    $stmt->bindParam("Patientid", $labBillingData->Patientid);
                    $stmt->bindParam("comments", $comments);                 
                    $stmt->bindParam("paymentfor", $ecash );     
                    $stmt->bindParam("amount", $labBillingData->Offers[0]->ecash);
                    $stmt->bindParam("actualamount", $labBillingData->actualamount);
                    $stmt->execute();
                    
                     $wallet = "wallet";
                    $comments = 'Test';
                    $stmt->bindParam("Patientid", $labBillingData->Patientid);
                    $stmt->bindParam("comments", $comments);                 
                    $stmt->bindParam("paymentfor", $wallet );     
                    $stmt->bindParam("amount", $labBillingData->Offers[0]->wallet);
                    $stmt->bindParam("actualamount", $labBillingData->actualamount);
                    $stmt->execute();
                   
                    $insertedId_sql1 = $db->lastInsertId(); 

              }
              catch(PDOException $e)
            {
            echo "Error: " . $e->getMessage();
                }
             }
              $db = null; 
              if (isset($insertedId_sql1) && $insertedId_sql1 != ""){
                return "success";
                }
                else{
                  return "Fail";
                }
                      
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
            echo $e1->getLine();
            
            echo '{"error11":{"text11":'. $e1->getLine() .'}}';
     	}
     }
     
     function diagnosticsTestDataByNameandId($diagnosticsId, $testname) {

        $dbConnection = new HSMDatabase();
        // echo $diagnosticsId;
        $sql = "SELECT dt.testid as testid,lt.testname as testname, dt.finalprice as price from diagnostics_tests "
                . "dt,labtests lt where dt.testid = lt.id and lt.testname != '' and  lt.testname like '%$testname%' ";
        try {
            $db = $dbConnection->getConnection();


            if ($diagnosticsId != "Others") {
                $sql = $sql . " and dt.diagnosticsid =  :diagnosticsId";
            }
            // if()
            // echo "sql.......".$sql;       
            $stmt = $db->prepare($sql);
            if ($diagnosticsId != "Others")
                $stmt->bindParam("diagnosticsId", $diagnosticsId);
            $stmt->execute();
            $diagnosticsDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($diagnosticsDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }
    
     function fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a, prescription p  ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "p.appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "p.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "p.status = ?";
                $params[] = $status;
                
                $cond[] = "a.id = p.appointmentid ";
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY p.id DESC";
               // echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
     
     function fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select a.*,ifnull(u.cardtype,'') as cardtype from appointment a,users u  where (a.amount is NULL or a.amount = '') "
                 . "and u.ID = a.patientid and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "a.appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "a.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "a.status = ?";
                $params[] = $status;
                
                $cond[] = "a.hosiptalid = ?";
                $params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY a.id DESC";
               // echo $sql;
               // print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
    function getSearchedTestPriceData($diagnosticsId,$testname){
     
     	$db = new HSMDatabase();
     	$sql = "SELECT labtests.testname,labtests.department, diagnostics_tests.id, diagnostics_tests.testid 
     	FROM labtests INNER JOIN diagnostics_tests ON labtests.id=diagnostics_tests.testid WHERE diagnostics_tests.diagnosticsid =$diagnosticsId AND labtests.testname like '%$testname%' ORDER BY labtests.id";

     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$TestsPriceDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		return $TestsPriceDetails;
     		 
     	} catch(PDOException $e) {
     		 
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
     
     function getPatientTestDetails($appointmentId){
     	$dbConnection = new HSMDatabase();
   
     	$sql = "SELECT consultationdiagnosisdetails.id as constid,consultationdiagnosisdetails.*,labtests.*,d.finalprice,consultationdiagnosisdetails.patientid,consultationdiagnosisdetails.nonprestest FROM diagnostics_tests d,consultationdiagnosisdetails INNER JOIN labtests ON labtests.id = consultationdiagnosisdetails.namevalue "
                . "WHERE consultationdiagnosisdetails.appointmentid = $appointmentId AND consultationdiagnosisdetails.type = 'MEDICAL TEST' and "
                . " d.testid = namevalue  and consultationdiagnosisdetails.status = 'P' ";
      // echo $sql;
     	trY{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		//$stmt->bindParam("appointmentid", $appointmentId);
     		$stmt->execute();
     		$appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
     		$db = null;
     		 
     		return $appointmentPatientTestDetails;
     
     
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     }
     
     
  
  
}
