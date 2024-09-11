<?php 
session_start();
include("./views/header.php");
include("./database.php");

// check to see if user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location:login.php');
  exit;
}


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
}

// Get the current user's details
$stmt=$db->prepare("SELECT*FROM staff_login where id=:user_id");
$stmt->bindParam(':user_id',$user_id);
$stmt->execute();
$user=$stmt->fetch(PDO::FETCH_ASSOC);

// display the username
$username=$user['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
  <h2>Welcome, <?php echo $username;?>!</h2>
</body>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Brief introduction</th>
      <th scope="col">Sign in</th>
      <th scope="col">Sign Out</th>
    </tr>
  </thead>
  <tbody>
      <?php $members=get_members($db) ?>
      <tr class="table-primary">
      <?php foreach($members as $member): ?>
      <tr>
        <td><?php echo htmlspecialchars($member['name']); ?></td>
        <td><?php echo htmlspecialchars($member['email']); ?></td>
        <td><?php echo htmlspecialchars($member['contents']); ?></td>
        <td>
          <form method="post" action="">
            <button type="submit" name="sign_in">Sign In</button>
          </form>
        </td>
        <td>
          <form method="post" action="">
            <button type="submit" name="sign_out">Sign Out</button>
          </form>
        </td>
      </tr>
      <?php endforeach ;?>
      <?php if (empty($members)): ?>
          <tr>
              <td colspan="3">No members found.</td>
          </tr>
      <?php endif; ?>
  </tbody>
</table>
<a href="logout.php" class="btn btn-primary">Logout</a>


<?php if (isset($message)) echo "<p>$message</p>"; ?>

<h2>Current Session Details</h2>
<?php
$stmt = $db->prepare("SELECT * FROM user_sessions WHERE user_id = :user_id ORDER BY id DESC LIMIT 1");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$lastSession = $stmt->fetch(PDO::FETCH_ASSOC);

if ($lastSession) {
  echo "<p>Check-in Time: " . ($lastSession['check_in_time'] ? $lastSession['check_in_time'] : "N/A") . "</p>";
  echo "<p>Check-out Time: " . ($lastSession['check_out_time'] ? $lastSession['check_out_time'] : "N/A") . "</p>";
} else {
  echo "<p>No session data available.</p>";
}
?>
<h2>Previous Sessions:</h2>
<?php 
$stmt = $db->prepare("SELECT * FROM user_sessions WHERE user_id = :user_id AND check_out_time IS NOT NULL ORDER BY check_in_time DESC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$previousSessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

?>
<ul>
  <?php foreach($previousSessions as $session) {?>
    <li>
      Session ID:<?php echo $session['id'];?><br>
      Sign-in Time:<?php echo $session['check_in_time'] ?><br>
      Sign-out Time :<?php echo $session['check_out_time'] ?><br>
    </li>


    <?php } ?>
</ul>

</body>
</html>