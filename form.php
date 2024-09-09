<?php 
include("./database.php")?>
<?php
// Function to handle form data

function handleFormData($db) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch form data securely
        $name = $_POST['name']??'';
        $email = $_POST['email']??'';
        $password =$_POST['password']??'';
        $contents =  $_POST['contents']??''; // Corrected the field name
        // $formFile = $_FILES['Formfile']??null; // Corrected the field name and used $_FILES for file uploads


        if (empty($name)||empty($email)||empty($password)){
            echo "Please fill in all fields.";
            return;
        }
        // validate file upload
        // if($formFile && !in_array($formFile['type'],['image/jpeg','image/png'])){
        //     echo "error only JPEG and PNG images are allowed.";
        //     return;
        // }
        // Hash the password

        // Prepare the SQL statement to prevent SQL injection
        $sql = "INSERT INTO staff_login (name, email, password,contents) 
        VALUES (:name, :email, :password, :contents)";

        $stmt = $db->prepare($sql);

        // Bind parameters to the statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Use the hashed password
        $stmt->bindParam(':contents', $contents);
        // $stmt->bindParam(':image_name', $formFile['name']); // Use the file name

        // Execute the prepared statement
        try{
            if ($stmt->execute()) {
                echo "Your record has been stored successfully.";
            } else {
                echo "Error: Unable to save your record.";
            }
        }catch(Exception $e){
            echo"An error occured:".$e->getMessage();
        }
    }
}

// Call the function to handle form data
handleFormData($db);