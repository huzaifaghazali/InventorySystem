<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");


//================= Entering the data into the database ==========================================//
//  For Registeration form processing create account after the values are correct
if (isset($_POST["username"]) && isset($_POST["email"])) {
    $user = new User();
    $resut =  $user->createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"], $_POST["usertype"]);
    echo $resut;
    exit();
}

// For login form processing sign in the account
if (isset($_POST["log_email"]) && isset($_POST["log_password"])) {
    $user = new User();
    $resut = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
    echo $resut;
    exit();
}


// =============== To get the category ===============
if (isset($_POST["getCategory"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("categories");
    foreach ($rows as $row) {
        echo "<option value='" . $row["c_id"] . "'>" . $row["category_name"] . "</option>";
    }
    exit();
}

// =============== To get the brand ===============
if (isset($_POST["getBrand"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("brands");
    foreach ($rows as $row) {
        echo "<option value='" . $row["brand_id"] . "'>" . $row["brand_name"] . "</option>";
    }
    exit();
}

// =============== Add Category ===============
if (isset($_POST["category_name"]) && isset($_POST["parent_category"])) {
    $obj = new DBOperation();
    $result = $obj->addCategory($_POST["parent_category"], $_POST["category_name"]);
    echo $result;
    exit();
}

// =============== Add Brand ===============
if (isset($_POST["brand_name"])) {
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST["brand_name"]);
    echo $result;
    exit();
}

// =============== Add Product ===============
if (isset($_POST["added_date"]) && isset($_POST["product_name"])) {
    $obj = new DBOperation();
    $result = $obj->addProduct(
        $_POST["select_category"],
        $_POST["select_brand"],
        $_POST["product_name"],
        $_POST["product_price"],
        $_POST["product_qty"],
        $_POST["added_date"]
    );
    echo $result;
    exit();
}

// =============== Manage Category ===============

if (isset($_POST["manageCategory"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("categories", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if (count($rows) > 0) {
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        foreach ($rows as $row) {
?>
            <tr>
                <td scope="row"><?php echo $n; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row["parent"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye">&nbsp;</i>Active</a></td>
                <td> <a href="#" did="<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm del_cat"><i class="fas fa-trash-alt">&nbsp;</i>Delete</a> </td>
                <td> <a href="#" eid="<?php echo $row['c_id']; ?>" data-bs-toggle="modal" data-bs-target="#form_category" class="btn btn-info btn-sm edit_cat"><i class="fas fa-edit">&nbsp;</i>Edit</a> </td>
            </tr>

        <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="6"><?php echo $pagination; ?></td>
        </tr>

        <?php
        exit();
    }
}

// =============== Delete a Category ===============
if (isset($_POST["deleteCategory"])) {
    $m = new Manage();
    $result = $m->deleteRecord("categories", "c_id", $_POST["id"]);
    echo $result;
    exit();
}

// =============== Updating the category ===============
if (isset($_POST["updateCategory"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("categories", "c_id", $_POST["id"]);
    echo json_encode($result); // its an array. Want this array in javascirpt
    exit();
}

// =============== Update Category Record after getting data ===============
if (isset($_POST["update_category"])) {
    $m = new Manage();
    $id = $_POST["c_id"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_category"];
    $result = $m->update_record("categories", ["c_id" => $id], ["parent_category" => $parent, "category_name" => $name, "status" => 1]);

    echo $result;
    exit();
}


//=============================== BRAND =================================================================
// =============== Manage Brand ===============

if (isset($_POST["manageBrand"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("brands", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if (count($rows) > 0) {
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        foreach ($rows as $row) {
        ?>
            <tr>
                <td scope="row"><?php echo $n; ?></td>
                <td><?php echo $row['brand_name']; ?></td>
                <td><a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye">&nbsp;</i>Active</a></td>
                <td> <a href="#" did="<?php echo $row['brand_id']; ?>" class="btn btn-danger btn-sm del_brand"><i class="fas fa-trash-alt">&nbsp;</i>Delete</a> </td>
                <td> <a href="#" eid="<?php echo $row['brand_id']; ?>" data-bs-toggle="modal" data-bs-target="#form_brand" class="btn btn-info btn-sm edit_brand"><i class="fas fa-edit">&nbsp;</i>Edit</a> </td>
            </tr>

        <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="5"><?php echo $pagination; ?></td>
        </tr>

        <?php
        exit();
    }
}

// =============== Delete a Brand ===============
if (isset($_POST["deleteBrand"])) {
    $m = new Manage();
    $result = $m->deleteRecord("brands", "brand_id", $_POST["id"]);
    echo $result;
    exit();
}

// =============== Updating the Brand ===============
if (isset($_POST["updateBrand"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("brands", "brand_id", $_POST["id"]);
    echo json_encode($result); // its an array. Want this array in javascirpt
    exit();
}

// =============== Update Brand Record after getting data ===============
if (isset($_POST["update_brand"])) {
    $m = new Manage();
    $id = $_POST["brand_id"];
    $name = $_POST["update_brand"];
    $result = $m->update_record("brands", ["brand_id" => $id], ["brand_name" => $name, "status" => 1]);

    echo $result;
    exit();
}

//=============================== Product =================================================================
// =============== Manage Product ===============

if (isset($_POST["manageProduct"])) {
    $m = new Manage();
    $result = $m->manageRecordWithPagination("products", $_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];

    if (count($rows) > 0) {
        $n =  (($_POST["pageno"] - 1) * 5) + 1;
        foreach ($rows as $row) {
        ?>
            <tr>
                <td scope="row"><?php echo $n; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['brand_name']; ?></td>
                <td><?php echo $row['product_price']; ?></td>
                <td><?php echo $row['product_stock']; ?></td>
                <td><?php echo $row['added_date']; ?></td>
                <!-- <td><?php // echo $row['product_status']; 
                            ?></td> -->
                <td><a href="#" class="btn btn-success btn-sm"><i class="fas fa-eye">&nbsp;</i>Active</a></td>
                <td> <a href="#" did="<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm del_product"><i class="fas fa-trash-alt">&nbsp;</i>Delete</a> </td>
                <td> <a href="#" eid="<?php echo $row['product_id']; ?>" data-bs-toggle="modal" data-bs-target="#form_products" class="btn btn-info btn-sm edit_product"><i class="fas fa-edit">&nbsp;</i>Edit</a> </td>
            </tr>

        <?php
            $n++;
        }
        ?>
        <tr>
            <td colspan="10"><?php echo $pagination; ?></td>
        </tr>

    <?php
        exit();
    }
}

// =============== Delete a Product ===============
if (isset($_POST["deleteProduct"])) {
    $m = new Manage();
    $result = $m->deleteRecord("products", "product_id", $_POST["id"]);
    echo $result;
    exit();
}

// =============== Updating the Product ===============
if (isset($_POST["updateProduct"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products", "product_id", $_POST["id"]);
    echo json_encode($result); // its an array. Want this array in javascirpt
    exit();
}

// =============== Update Product Record after getting data ===============
if (isset($_POST["update_product"])) {
    $m = new Manage();
    $id = $_POST["product_id"];
    $name = $_POST["update_product"];
    $cat = $_POST["select_category"];
    $brand = $_POST["select_brand"];
    $price = $_POST["product_price"];
    $qty = $_POST["product_qty"];
    $date = $_POST["added_date"];
    $result = $m->update_record("products", ["product_id" => $id], ["category_id" => $cat, "brand_id" => $brand, "product_name" => $name, "product_price" => $price, "product_stock" => $qty, "added_date" => $date]);

    echo $result;
    exit();
}

// =============== Order Processing ===============

if (isset($_POST["getNewOrderItem"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecords("products"); // get all the list of records
    ?>
    <tr>
        <td><b class="number">1</b></td>
        <td>
            <select name="product_id[]" class="form-select form-select-sm product_id" id="" required>
              <option value="">Choose Product</option>
              <?php 
                    foreach ($rows as $row) {
                ?>  <option value="<?php echo $row['product_id']; ?>"><?php echo $row["product_name"]; ?></option>
                <?php
                    }
                ?>
                
            </select>
        </td>
        <td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly></td>
        <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required></td>
        <td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
        <td><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"></td>
        <td>Rs.<span class="amt">0</span></td>

    <?php
    echo exit();
}

// Get Price and Quantity of one item
if(isset($_POST["getPriceAndQty"])){
    $m = new Manage();
    $result = $m->getSingleRecord("products", "product_id", $_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["order_date"]) && isset($_POST["cust_name"])) {

    $orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];

    //Now getting array from order_form
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];

    $sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];

    $m = new Manage();
	echo $result = $m->storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
    exit();
}

    ?>