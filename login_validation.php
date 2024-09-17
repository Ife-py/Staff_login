<?php 
session_start();
include("./database.php");
?>
<?php 
function form_handling($db){
    if($_SERVER["REQUEST_METHOD"]!=="POST"){
        // fetching data from text field
        return;
    }

    $email=$_POST['email'] ?? '';
    $password=$_POST['password'] ?? '';

    if(empty($email)||empty($password)){
        echo "Please fill all fields";
        return;
    }

    try {
        // Query the database for email and password
        $stmt = $db->prepare("SELECT id, email, password FROM staff_login WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['password'] === $password){
            $_SESSION['user_id'] = $row['id'];
            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'dashboard.php';
                  </script>";
        } else {
            echo "
            <script>
                alert('Login failed. Invalid email or password!');
                window.location.href = 'login.php';
            </script>";
            ;
        }
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database: " . $e->getMessage();
        exit;// Message if no match is found   
        }
    }   


form_handling($db);