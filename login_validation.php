<?php 
include("./database.php")
?>
<?php 
function form_handling($db){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // fetching data from text field
        $email=$_POST['email'] ?? '';
        $password=$_POST['password'] ?? '';
    }

    if(empty($email)||empty($password)){
        echo "Please fill all fields";
        return;
    }

    try {
        // Query the database for email and password
        $stmt = $db->query("SELECT email, password FROM staff_login");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $is_authenticated=false;

        foreach ($rows as $row) {
            if ($row['email'] == $email && $row['password']) {
                echo "Login successful";
                $is_authenticated = true;
                break;  // Stop the loop once authenticated
            }
        }
    
        if (!$is_authenticated) {
            echo "Login failed. Invalid email or password";
        }
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database: " . $e->getMessage();
        exit;// Message if no match is found   
        }
}


form_handling($db);