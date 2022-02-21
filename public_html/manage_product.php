<?php
include_once("./database/constants.php");
if (!isset($_SESSION["userid"])) {
    header("location:" . DOMAIN . "/");
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
    <script type="text/javascript" src="./js/manage.js"></script>

    <!-- css for the desgin link -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <?php
    // for the navbar
    include_once("../templates/header.php");
    ?>
    <br>

    <div class="container">
        <table class="table table-bordered border-secondary table-hover table-dark table-striped mt-5 align-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Added Date</th>
                    <th scope="col">Status</th>
                    <th colspan="2" scope="col">Action</th>

                </tr>
            </thead>
            <tbody id="get_product">
                <!-- <tr>
                    <th scope="row">1</th>
                    <td>Electronics</td>
                    <td>Root</td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td> <a href="#" class="btn btn-danger btn-sm">Delete</a> </td>
                    <td> <a href="#" class="btn btn-info btn-sm">Edit</a> </td>
                </tr> -->
            </tbody>
        </table>
    </div>


    <?php  include_once("../templates/update_product.php") ?>


</body>

</html>