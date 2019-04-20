<?php
 
    $mysqli = false;
    function connectDB () {
        global $mysqli;
        $mysqli = new mysqli("localhost", "root", "", "bookStore_db");
        $mysqli->query("SET NAMES 'utf8'");
    }
    
    function closeDB () {
        global $mysqli;
        $mysqli-> close ();
    }
    
    function sqlQuery($query) {
        global $mysqli;
        connectDB();
        $result = $mysqli->query("$query");
        closeDB();    
        return $result;        
    }
    
    function sqlQuery_select ($query) {
        global $mysqli;
        connectDB();
        $result = $mysqli->query("$query");
        closeDB();
        return resultToArray($result); 
    }
    
    function resultToArray($result) {
        $array = array();
        while(($row = $result->fetch_assoc())!=false)
            $array[] = $row;
        return $array;
    }
 
 
?>
 