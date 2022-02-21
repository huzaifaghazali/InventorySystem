<?php
    include_once("./database/constants.php");
    if (isset($_SESSION['userid'])) {
        // header("location:" . DOMAIN . "/dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Management System</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap javascirpt and jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- font icon link -->
    <script src="https://kit.fontawesome.com/3e762e891a.js" crossorigin="anonymous"></script>

    <!-- for the javascirpt funcationality link -->
    <script type="text/javascript" src="./js/main.js"></script>

     <!-- css for the desgin link -->
     <link href="./css/style.css" rel="stylesheet">

</head>

<body>
<div class="overlay"><div class="loader"></div></div>
    <?php
    // for the navbar
    include_once("../templates/header.php");
    ?>
    <br><br>
    <div class="container">
        <div class="card mx-auto" style="width: 30rem;">
            <div class="card-header text-center">
                <h4>Register</h4>
            </div>
            <div class="card-body">
                <form id="register_form" onsubmit="return false" autocomplete="off">
                    <div class="form-group my-3">
                        <label for="username">Full Name</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your Username">
                        <small id="u_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group my-3">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your Email">
                        <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group my-3">
                        <label for="password1">Password</label>
                        <input type="password" name="password1" class="form-control" id="password1" placeholder="Enter your Password">
                        <small id="p1_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group my-3">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Re-enter the Password">
                        <small id="p2_error" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group my-3">
                        <label for="usertype">Usertype</label>
                        <select name="usertype" id="usertype" class="form-control">
                            <option value="">Choose User Type</option>
                            <option value="1">Admin</option>
                            <option value="0">Other</option>
                        </select>
                        <small id="t_error" class="form-text text-muted"></small>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="user_register" class="btn btn-primary"> <span class="fas fa-user-plus">&nbsp;</span>Register</button>
                    </div>
                    <br>
                    <span class="">If you have an account <a href="index.php">Login</a></span>

                </form>
            </div>
        </div>
    </div>

</body>

</html>