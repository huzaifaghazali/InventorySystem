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
    <script type="text/javascript" src="./js/order.js"></script>

    <!-- css for the desgin link -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

<div class="overlay">
    <div class="loader"></div>
</div>
    <?php
    // for the navbar
    include_once("../templates/header.php");
    ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card new_order_card">
                    <h4 class="card-header">New Orders</h4>
                    <div class="card-body">
                        <form id="get_order_data" action="" onsubmit="return false">
                            <div class="form-group row mb-4">
                                <label for="" class="col-sm-3 order_label">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="text" id="order_date" name="order_date" class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 order_label">Customer Name*</label>
                                <div class="col-sm-6">
                                    <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" placeholder="Enter Customer Name" required>
                                </div>
                            </div>

                            <div class="card order_list_card">
                                <div class="card-body">
                                    <h3>Make a order list</h3>
                                    <table class="table table-hover table-dark table-striped align-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</td>
                                                <th scope="col">Total Quantity</td>
                                                <th scope="col">Quantity</td>
                                                <th scope="col">Price</td>
                                                <th colspan="2" scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_item">
                                            <!-- <tr>
                                                <td><b id="number">1</b></td>
                                                <td>
                                                    <select name="producd_id[]" class="form-select form-select-sm" id="" required>
                                                        <option value="">Washing Machine</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="tqty[]" class="form-control form-control-sm" readonly></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm" readonly></td>
                                                <td>Rs.1540</td>
                                            </tr> -->

                                        </tbody>
                                    </table>
                                    <div class="buttons_group">
                                        <button id="add_button" class="btn btn-success add_order_button"><i class="fas fa-plus">&nbsp;</i>Add</button>
                                        <button id="remove_button" class="btn btn-danger remove_order_button"><i class="fas fa-trash-alt">&nbsp;</i>Remove</button>
                                    </div>
                                </div> <!-- card body ends -->
                            </div> <!-- order list card ends -->
                            <br>
                            <div class="form-group row mb-3">
                                <label for="sub_total" class="col-sm-3 col-form-label order_label">Sub Total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="gst" class="col-sm-3 col-form-label order_label">GST (18%)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="gst" class="form-control form-control-sm" id="gst" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="discount" class="col-sm-3 col-form-label order_label">Discount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="discount" class="form-control form-control-sm" id="discount" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="net_total" class="col-sm-3 col-form-label order_label">Net Total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_total" class="form-control form-control-sm" id="net_total" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="paid" class="col-sm-3 col-form-label order_label">Paid</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="due" class="col-sm-3 col-form-label order_label">Due</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="payment_type" class="col-sm-3 col-form-label order_label">Payment Method</label>
                                <div class="col-sm-6">
                                    <select name="payment_type" class="form-select form-select-sm" id="payment_type" required>
                                        <option>Cash</option>
                                        <option>Card</option>
                                        <option>Draft</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="buttons_group">
                                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info fas fa-plus-square" value="&#xf0fe Order">
                                <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>