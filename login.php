<?php
include("./views/header.php");
?>
<!-- form to take in input from user
<div class="container">
  <div class="row pt-5">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <form class="" action="login_validation.php" method="post">
        <label class="form-label mt-4"><b>Input Your Details To Login:</b></label>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="Input" name="email" placeholder="name@example.com">
          <label for="Input">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="Password" name="password" placeholder="Password" autocomplete="off">
          <label for="Password">Password</label>
        </div>
        <button type="submit" value="login" class="btn btn-primary ">Login</button>
      </form>
    </div>
    <div class="col-md-3"></div>
  </div>
</div> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body {
          background-image: linear-gradient(to bottom, #f2f2f2, #fff);
          height: 100vh;
          margin: 0;
          padding: 0;
      }
      .container{
      margin-top: 5rem;
      }
      .card {
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .card-body {
          padding: 2rem;
      }
      .form-control {
          height: 40px;
          padding: 10px;
          font-size: 16px;
      }
      .btn-primary {
          background-color: #337ab7;
          border-color: #337ab7;
          padding: 10px 20px;
          font-size: 16px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <form class="" action="login_validation.php" method="post">
                <label class="form-label mt-4"><b>Input Your Details To Login:</b></label>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="Input" name="email" placeholder="name@example.com">
                  <label for="Input">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="Password" name="password" placeholder="Password" autocomplete="off">
                  <label for="Password">Password</label>
                </div>
                <button type="submit" value="login" class="btn btn-primary ">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>