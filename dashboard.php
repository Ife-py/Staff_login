<!-- php codes to handle different sort of requests sent -->
<?php 
  session_start();
  include("./views/header.php");
  include("./database.php");

  // check to see if user is logged in
  if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
    exit;
  }


  // getting the user_id info
  $user_id=$_SESSION['user_id'];

  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['sign_in'])){
      // check if alerady signed in
      $stmt=$db->prepare("SELECT * FROM user_sessions where user_id= :user_id and check_out_time IS NULL");
      $stmt->bindParam(':user_id',$user_id);
      $stmt->execute();
      $activeSession=$stmt->fetch(PDO::FETCH_ASSOC);

      if($activeSession){
        $message="You are already logged in.";
      }else{
        $stmt = $db->prepare("INSERT INTO user_sessions (user_id, check_in_time) VALUES (:user_id, NOW())");
          if ($stmt->execute([':user_id' => $user_id])) {
              $message = "You have successfully signed in.";
          } else {
              $message = "Error signing in.";
          }
      }
    }

    if (isset($_POST['sign_out'])) {
      // Sign out
      $stmt = $db->prepare("UPDATE user_sessions SET check_out_time = NOW() WHERE user_id = :user_id AND check_out_time IS NULL");
      if ($stmt->execute([':user_id' => $user_id])) {
          if ($stmt->rowCount() > 0) {
              $message = "You have successfully signed out.";
          } else {
              $message = "You are not currently signed in.";
          }
      } else {
          $message = "Error signing out.";
      }
    }

    if (isset($_POST['delete'])) {
      $session_id = intval($_POST['session_id']); // Ensure $session_id is set and sanitized
      
      if ($session_id > 0) { // Check if a valid session ID is provided
          try {
              // Preparing the DELETE SQL statement
              $stmt = $db->prepare("DELETE FROM user_sessions WHERE id = :id");
              $stmt->bindParam(':id', $session_id, PDO::PARAM_INT);

              if ($stmt->execute()) {
                  $message = "Session deleted successfully.";
              } else {
                  $message = "ERROR: Unable to delete the session.";
              }
          } catch (Exception $e) {
              echo "Error: " . $e->getMessage();
          }
      } else {
          $message = "Invalid session ID.";
      }
    }

    if(isset($_POST['Todo_text']) && isset($_POST['options'])) {
      $todo_text=$_POST['Todo_text'];
      $options=$_POST['options'];
      try {
          // Prepare the SQL statement to insert user's todo list into the todo table
          $stmt = $db->prepare("INSERT INTO todo (`user_id`, `Todo_text`, `options`) VALUES (:user_id, :Todo_text, :options)");

          // Execute the prepared statement with bound parameters
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':Todo_text' ,$todo_text);
          $stmt->bindParam(':options',$options);

          $stmt->execute();
          // Check if the row was successfully inserted
          if ($stmt->rowCount() > 0) {
              $message = "You have successfully added a new to-do item.";
          } else {
              $message = "Error adding your to-do item.";
          }
      } catch (PDOException $e) {
          // Handle any database-related errors
          $message = "Database error: " . $e->getMessage();
      }
    }
  }


  // Get the current user's details

  $stmt=$db->prepare("SELECT*FROM staff_login where id=:user_id");
  $stmt->bindParam(':user_id',$user_id);
  $stmt->execute();
  $user=$stmt->fetch(PDO::FETCH_ASSOC);

  // display the username
  $username=$user['name'];
  // Get the member detail for the current user
  $stmt=$db->prepare("SELECT*FROM staff_login where id=:user_id");
  $stmt->bindParam(':user_id',$user_id);
  $stmt->execute();
  $member=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!-- display settings using bootstrap classes -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <style>
    body {
        background-image: linear-gradient(to bottom, #f2f2f2, #fff);
        height: 100vh;
        margin: 0;
        padding: 0;
        }
    </style>
  </head>
  <body>
    <a href="logout.php" class="btn btn-primary" style="float:right">Logout</a>
    <div class="container">
      <h3><b>Welcome, <?php echo $username;?>!</b></h3>
      <div class="row">
        <div class="col-md-8">
          <?php if (empty($member)): ?>
            <tr>
                <td colspan="3">No members found.</td>
            </tr>
          <?php endif; ?>
          <table class="table table-hover bg-primary">
            <thead>
              <tr class="table-primary">
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Brief introduction</th>
                <th scope="col">Sign in</th>
                <th scope="col">Sign Out</th>
              </tr>
            </thead>
            <tbody>
                <?php if($member):?>
                  <tr>
                    <td><?php echo htmlspecialchars($member['name']); ?></td>
                    <td><?php echo htmlspecialchars($member['email']); ?></td>
                    <td><?php echo htmlspecialchars($member['contents']); ?></td>
                    <td>
                      <form method="post" action="">
                        <button class="btn btn-primary" type="submit" name="sign_in">Sign In</button>
                      </form>
                    </td>
                    <td>
                      <form method="post" action="">
                        <button class="btn btn-secondary" type="submit" name="sign_out">Sign Out</button>
                      </form>
                    </td>
                  </tr>
                <?php endif ;?>
            </tbody>
          </table>
          <div class="card mb-1">
            <div class="card-header">
              <p>Form to record your todo item</p>
            </div>
            <div class="card-body">
              <form action="" method="post">
                
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="Input" name="Todo_text" placeholder="Type in your to do item here:">
                  <label for="Input"name="T">To-Do:</label>
                </div>
                <div>
                  <label for="options" class="form-label mt-4"><b>Select your Category</b></label>
                  <select class="form-select" id="options" name="options">
                      <option>Low</option>
                      <option>Medium</option>
                      <option>High</option>
                  </select>
                </div>
                <input type="submit" value="submit">
              </form>
            </div>
          </div>
          <?php if (isset($message)) echo "<p>$message</p>"; ?>    
          <!-- display previous session details -->

            <?php 
            $stmt = $db->prepare("SELECT * FROM user_sessions WHERE user_id = :user_id AND check_out_time IS NOT NULL ORDER BY check_in_time DESC");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $previousSessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

          <!-- table to display previous sessions  -->
            <table class="table table-hover bg-primary mb-1">
              <div><b>Previous Sessions:</b></div>
              <thead>
                <tr class="table-primary">
                  <th scope="col">Id</th>
                  <th scope="col">Check In Time</th>
                  <th scope="col">Check Out Time</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-secondary">
                <?php foreach($previousSessions as $session) {?>
                  <tr>
                    <td><?php echo htmlspecialchars($session['id']); ?></td>
                    <td><?php echo htmlspecialchars($session['check_in_time']); ?></td>
                    <td><?php echo htmlspecialchars($session['check_out_time']); ?></td>
                  </tr>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            

        </div>
        <div class="col-md-4"> 
          <!-- display user to-do-list items -->
          <?php 
          $stmt = $db->prepare("SELECT * FROM todo WHERE user_id = :user_id AND Todo_text IS NOT NULL ORDER BY options DESC");
          $stmt->bindParam(':user_id', $user_id);
          $stmt->execute();
          $previousitems = $stmt->fetchAll(PDO::FETCH_ASSOC)
          ?>
          <table class="table table-hover">
            <h3><b>Recorded To-do item</b></h3>
            <thead>
              <tr class="table-primary">
                <th scope="col">To-do-item</th>
                <th scope="col">Level</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-secondary">
                <?php foreach($previousitems as $items){?>
                  <tr> 
                    <td><?php echo htmlspecialchars($items['Todo_text']);?></td>
                    <td><?php echo htmlspecialchars($items['options']);?></td>
                  </tr>
              </tr>
            </tbody>
              <?php } ?>
          </table>
          <!-- display current session details -->
          <h4><b>Current Session Details</b></h4>
            <?php
            $stmt = $db->prepare("SELECT * FROM user_sessions WHERE user_id = :user_id ORDER BY id DESC LIMIT 1");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $lastSession = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($lastSession) {
              echo "<p><b>Sign-in Time:</b> " . ($lastSession['check_in_time'] ? $lastSession['check_in_time'] : "N/A") . "</p>";
              echo "<p><b>Sign-out Time: </b>" . ($lastSession['check_out_time'] ? $lastSession['check_out_time'] : "N/A") . "</p>";
            } else {
              echo "<p><b>No session data available.</b></p>";
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html> 