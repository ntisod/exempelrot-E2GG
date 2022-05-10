<?php

    function testDbField($dbTable, $dbCol, $value){
        //Hämta hemliga värden
        require("../includes/settings.php");

        //Testa om det går att ansluta till databasen
        try {
            //Skapa anslutningsobjekt
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Förbered SQL-kommando
            $sql = "SELECT $dbCol FROM $dbTable WHERE $dbCol= :value  LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindparam(":value", $value);
            //Skicka frågan till databasen
            $stmt->execute();
        
             // Ta emot resultatet från databasen
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
             $row1 = $stmt->fetch();
            if(empty($row1)){
                return false;
            }
            else{
                return true;
            }
        }
        catch(PDOException $e) {
            //Om något i anslutningen går fel
            echo "Error: " . $e->getMessage();
}
//Stäng anslutningen
$conn = null;
    }

    function testUserExist($username){
        return testDbField('users', 'username', $username);
    }

    