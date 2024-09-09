<?php 
include("./views/header.php")
?>

<form class="login_container" method="post">
  <label class="form-label mt-4">Input your details to login</label>
  <div class="form-floating mb-3">
    <input type="text" class="form-control" id="Input" placeholder="name@example.com">
    <label for="Input">Email address</label>
  </div>
  <div class="form-floating">
    <input type="text" class="form-control" id="Password" placeholder="Password" autocomplete="off">
    <label for="Password">Password</label>
  </div>
  <button type="submit" class="btn btn-primary">Login
    <a href="./personal.php">
  </button>
</form>