<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterData
 *
 * @author kpava
 */
class MasterData {

    function validateUserId($userId) {
        $dbConnection = new BusinessHSMDatabase();

        $sql = "SELECT * from users where username = :userId ";
        try {
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->execute();
            $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return ($userDetails);
        } catch (PDOException $pdoex) {
            throw new Exception($pdoex);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }
}
