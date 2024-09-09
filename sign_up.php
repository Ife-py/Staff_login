<?php 
include("views/header.php")?>

<div class="welcome text">
    <h1>Welcome to the Ozitech team sign up page</h1>
<form action="form.php" method="post">
    <fieldset>
        <div class="row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
        </div>
        </div>
        <div>
        <label for="name" class="form-label mt-4">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your name:" required>
        <label for="email" class="form-label mt-4">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div>
        <label for="password" class="form-label mt-4">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
        </div>
        <div>
        <label for="Select_1" class="form-label mt-4">Select your Category</label>
        <select class="form-select" id="Select_1">
            <option>Staff</option>
            <option>Student</option>
        </select>
        </div>
        <div>
        <label for="contents" class="form-label mt-4">Give a brief description of Yourself:</label>
        <textarea class="form-control" id="contents" rows="3"></textarea>
        </div>
        <!-- <div>
        <label for="formFile" class="form-label mt-4">Upload a picture of yourself:</label>
        <input class="form-control" type="file" id="formFile">
        </div>     -->
        <input type="submit" value="Submit">
    </fieldset>
</form>
</div>