<?php
include("views/header.php") ?>

<style>
    body {
        background-image: linear-gradient(to bottom, #f2f2f2, #fff);
        height: 100vh;
        margin: 0;
        padding: 0;
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
<div class="welcome-text">
    

    <!-- form to sign up new users -->
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary "><b>Welcome To The Ozitech Team Sign Up Page</b></div>
                    <div class="card-body">
                        <form action="form.php" method="post">
                            <fieldset>
                                <div>
                                    <label for="name" class="form-label mt-4"><b>Name</b></label>
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter your name:" required>
                                    <label for="email" class="form-label mt-4"><b>Email address</b></label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email ">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div>
                                    <label for="password" class="form-label mt-4"><b>Password</b></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                                </div>
                                <div>
                                    <label for="Select_1" class="form-label mt-4"><b>Select your Category</b></label>
                                    <select class="form-select" id="Select_1">
                                        <option>Staff</option>
                                        <option>Student</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="contents" class="form-label mt-4"><b>Give a brief description of Yourself:</b></label>
                                    <textarea class="form-control" id="contents" name="contents" rows="3"></textarea>
                                </div>
                                <!-- <div>
                        <label for="formFile" class="form-label mt-4">Upload a picture of yourself:</label>
                        <input class="form-control" type="file" id="formFile">
                        </div>     -->
                                <input type="submit" value="Submit">
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>