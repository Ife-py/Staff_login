<?php 

try {
    $db = new PDO("mysql:host=localhost;dbname=staff login", "root", ""); // Corrected the DSN format
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
} catch (Exception $e) {
    echo "Could not connect to the database: " . $e->getMessage();
    exit;
}


function get_members($db){
    try{
        $results=$db->query("SELECT name ,email ,password ,contents from staff_login");
        $members=$results->fetchAll(PDO::FETCH_ASSOC);
        return $members;

    }catch(Exception $e){
        echo "Error fetching members: " . $e->getMessage();
        exit;
    }

}