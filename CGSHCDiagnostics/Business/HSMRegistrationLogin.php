<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSMRegistrationLogin
 *
 * @author kpava
 */
class HSMRegistrationLogin {
    
    
     function authenticateUser($userId,$password){
        $decryptPassword = new EncryptDecryptData();
        
        $database = new HSMDatabase();
        $sql = "SELECT u.*,c.cardname FROM users u left join card_master c on c.id = u.cardtype WHERE  u.username = :username and u.status = 'Y'";
       
        try {
                
		$db = $database->getConnection();
                $stmt = $db->prepare($sql);
		$stmt->bindParam("username", $userId);
                //$stmt->bindParam("password", $password);
                $stmt->execute();
                $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db = null;
               
                if(count($userDetails) > 0){
                    
                    $fetchedPassword = $userDetails[0]->password;
                    $decodedPassword = $decryptPassword->decryptData($fetchedPassword);
                     if($password == $decodedPassword){
                         $profession = $userDetails[0]->profession;
                         if($profession == "Lab" || $profession == "Staff" || $profession == "Medical" )
                            $_SESSION['instname'] = $this->fetchOfficeName($userDetails[0]->officeid,$userDetails[0]->profession);
                          
                         
                         
                         
                            return  $userDetails;
                     }else {
                        
                         return new ArrayObject();
                     }
                }else{
                    return new ArrayObject();
                }
                
          } catch (PDOException $pdoex) {
                //writeLogs($pdoex, "PDOException");
                throw new Exception($pdoex);

            } catch (Exception $ex) {
                //writeLogs($ex, "Exception");
                throw new Exception($ex);
            }
    
}
    
}
