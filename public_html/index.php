<?php
    include_once("./database/constants.php");
    if (isset($_SESSION['userid'])) {
        header("location:" . DOMAIN . "/dashboard.php");
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
    <!-- For the Navbar -->
    <?php include_once("../templates/header.php"); ?>

    <br>
    <div class="container">
        <?php
        // This will get the msg from main.js when user is trying to register
        if (isset($_GET["msg"]) && !empty($_GET["msg"])) { ?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_GET["msg"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
        <?php
        }
        ?>
        <div class="card mx-auto" style="width: 18rem;">
            <img src="images/image_A.png" style="width: 60%" class="card-img-top mx-auto" alt="User Profile Picture">
            <div class="card-body">

                <form id="login_form" onsubmit="return false">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="log_email" id="log_email" placeholder="Enter your email">
                        <small id="e_error" class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="log_password" id="log_password">
                        <small id="p_error" class="form-text"></small>
                    </div>
                    <div class="d-flex justify-content-center mb-2">
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-sign-in-alt">&nbsp;</i>Login</button>
                    </div>
                    <span>Don't have an account <a href="register.php"> Register</a></span>
                </form>
            </div>
            <div class="card-footer">
                <a href="">Forget Password ?</a>
            </div>
        </div>
    </div>
</body>

</html>