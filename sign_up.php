<?php 
include("views/header.php")?>

<div class="welcome text">
    <h1>Welcome to the Ozitech team sign up page</h1>
<form>
    <fieldset>
        <legend>Legend</legend>
        <div class="row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
        </div>
        </div>
        <div>
        <label for="Email" class="form-label mt-4">Email address</label>
        <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div>
        <label for="Password" class="form-label mt-4">Password</label>
        <input type="password" class="form-control" id="Password" placeholder="Password" autocomplete="off">
        </div>
        <div>
        <label for="Select_1" class="form-label mt-4">Select your Category</label>
        <select class="form-select" id="Select_1">
            <option>Staff</option>
            <option>Student</option>
        </select>
        </div>
        <div>
        <label for="Textarea" class="form-label mt-4">Give a brief description of Yourself:</label>
        <textarea class="form-control" id="Textarea" rows="3"></textarea>
        </div>
        <div>
        <label for="formFile" class="form-label mt-4">Upload a picture of yourself:</label>
        <input class="form-control" type="file" id="formFile">
        </div>    
    </fieldset>
</form>
</div>