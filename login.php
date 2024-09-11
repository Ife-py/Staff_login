<?php 
include("./views/header.php");
?>

<form class="login_container" action="login_validation.php" method="post">
  <label class="form-label mt-4">Input your details to login</label>
  <div class="form-floating mb-3">
    <input type="email" class="form-control" id="Input" name="email"  placeholder="name@example.com">
    <label for="Input">Email address</label>
  </div>
  <div class="form-floating">
    <input type="text" class="form-control" id="Password"  name="password" placeholder="Password" autocomplete="off">
    <label for="Password">Password</label>
  </div>
  <button type="submit" value="login" class="btn btn-primary">Login</button>
</form>