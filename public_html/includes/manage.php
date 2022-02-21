<?php
class Manage
{
    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect(); // connection is established
    }

    public function manageRecordWithPagination($table, $pno)
    {
        $a = $this->pagination($this->con, $table, $pno, 5);
        if ($table == "categories") {
            $sql = "SELECT p.category_name as category, p.c_id as c_id, c.category_name as parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_category = c.c_id " . $a["limit"];
        } else if ($table == "products") {
            $sql = "SELECT p.product_id, p.product_name, c.category_name, b.brand_name, p.product_price, p.product_stock, p.added_date, p.product_status FROM products p,brands b,categories c WHERE p.brand_id = b.brand_id AND p.category_id = c.c_id " . $a["limit"];
        } else {
            $sql = "SELECT * FROM " . $table . " " . $a["limit"];
        }

        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return ["rows" => $rows, "pagination" => $a["pagination"]];
    }




    private function pagination($con, $table, $pno, $n)
    {
        $query = $con->query("SELECT COUNT(*) as `rows` FROM " . $table);
        // echo mysqli_error($con);
        $row = mysqli_fetch_assoc($query);

        // $totalRecords = 100000;
        $pageno = $pno;
        $numberOfRecordsPerPage = $n;

        // display the number of pages on the webpage
        // $last = ceil($totalRecords / $numberOfRecordsPerPage);
        $last = ceil($row["rows"] / $numberOfRecordsPerPage);

        // last Page should not be equal to the first page 
        // total record 4 
        // number of records per page 10 
        // last will be 0.4
        // it will round off to 1

        $pagination = "<ul class='pagination justify-content-center'>";

        if ($last != 1) {

            // previous button
            if ($pageno > 1) {
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $previous . "' href='#' style = 'color:#4294F7;'> Previous </a></li>";
            }

            // display link between current page and previous button
            for ($i = $pageno - 5; $i < $pageno; $i++) {
                // to avoid the negative numbers
                if ($i > 0) {
                    $pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#' style = 'color:#4294F7;'> " . $i . " </a></li>";
                }
            }
            // current Page
            $pagination .= "<li class='page-item'><a class='page-link' pn='" . $pageno . "' href='#' style = 'color:#000;'> $pageno </a></li>";

            // links between current page and next button
            for ($i = $pageno + 1; $i <= $last; $i++) {
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $i . "' href='#' style = 'color:#4294F7;'> " . $i . " </a></li>";
                if ($i > $pageno + 4) {
                    break;
                }
            }

            // Next Button

            if ($last > $pageno) {
                $next = $pageno + 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='" . $next . "' href='#' style = 'color:#4294F7;'> Next </a></li></ul>";
            }
        }

        // LIMIT 0, 10 -> no of reacord
        // LIMIT 10 -> no of page, 10 

        $limit = "LIMIt " . ($pageno - 1) * $numberOfRecordsPerPage . "," . $numberOfRecordsPerPage;


        return ["pagination" => $pagination, "limit" => $limit];
    }

    public function deleteRecord($table, $pk, $id)
    {
        // Checking if the categories is not dependent
        if ($table == "categories") {
            $pre_stmt = $this->con->prepare("SELECT " . $id . " FROM categories WHERE parent_category = ?");
            $pre_stmt->bind_param("i", $id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result() or die($this->con->error);
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            } else {
                $pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
                $pre_stmt->bind_param("i", $id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result) {
                    return "CATEGORY_DELETED";
                }
            }
        } else {
            $pre_stmt = $this->con->prepare("DELETE FROM " . $table . " WHERE " . $pk . " = ?");
            $pre_stmt->bind_param("i", $id);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return "DELETED";
            }
        }
    }

    public function getSingleRecord($table, $pk, $id)
    {
        $pre_stmt = $this->con->prepare("SELECT * FROM " . $table . " WHERE " . $pk . " = ? LIMIT 1");
        $pre_stmt->bind_param("i", $id);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        }
        return $row;
    }


    public function update_record($table, $where, $fields)
    {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
        if (mysqli_query($this->con, $sql)) {
            return "UPDATED";
        }
    }

    public function storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, 
                                                $sub_total, $gst, $discount, $net_total, $paid, $due, $payment_type)
    {
        $pre_stmt = $this->con->prepare("INSERT INTO 
			`invoice`(`customer_name`, `order_date`, `sub_total`,
			 `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssdddddds",$cust_name,$orderdate,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
		$pre_stmt->execute() or die($this->con->error);
		$invoice_no = $pre_stmt->insert_id;

        if ($invoice_no != null) {
			for ($i=0; $i < count($ar_price) ; $i++) {

				// Here we are finding the remaing quantity after giving customer
				$rem_qty = $ar_tqty[$i] - $ar_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					// Update Product stock
					$sql = "UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$ar_pro_name[$i]."'";
					$this->con->query($sql);
				}


				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_product->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);
			}

			return $invoice_no;
		}
    }
}

// $obj = new Manage();
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("categories", 1));
// echo $obj->deleteRecord("categories", "c_id", 17);
// print_r($obj->getSingleRecord("categories", "c_id", 1));
// echo $obj->update_record("categories", ["c_id"=>1], ["parent_category"=>0, "category_name"=>"Electro", "status"=>1]);
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("brands", 1));
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("products", 1));