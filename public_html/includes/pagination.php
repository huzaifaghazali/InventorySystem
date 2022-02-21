<?php

$con = mysqli_connect("localhost", "root", "", "test");

function pagination($con, $table, $pno, $n)
{
    $query = $con->query("SELECT COUNT(*) as rows FROM ". $table);
    $row = mysqli_fetch_assoc($query);

    $totalRecords = 100000;
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

    $pagination = "";

    if ($last != 1) {
    
        // previous button
        if($pageno > 1){
            $previous = "";
            $previous = $pageno - 1;
            $pagination .= "<a href='pagination.php?pageno=".$previous."' style = 'color:#4294F7;'> Previous </a>";
        }

        // display link between current page and previous button
        for ($i = $pageno - 5; $i < $pageno; $i++) {
            // to avoid the negative numbers
            if($i > 0){
                $pagination .= "<a href='pagination.php?pageno=".$i."' style = 'color:#4294F7;'> ".$i." </a>";
            }
        }
        // current Page
        $pagination .= "<a href='".$pageno."' style = 'color:#000057;'> $pageno </a>";

        // links between current page and next button
        for ($i = $pageno + 1; $i <= $last; $i++) {
            $pagination .= "<a href='pagination.php?pageno=".$i."' style = 'color:#4294F7;'> ".$i." </a>";
            if($i > $pageno + 4) {
                break;
            }
        }

        // Next Button

        if($last > $pageno) {
            $next = $pageno + 1;
            $pagination .= "<a href='pagination.php?pageno=".$next."' style = 'color:#4294F7;'> Next </a>";
        }
    }

    // LIMIT 0, 10 -> no of reacord
    // LIMIT 10 -> no of page, 10 

    $limit = "LIMIt " . ($pageno - 1) * $numberOfRecordsPerPage . "," . $numberOfRecordsPerPage;


    return ["pagination" => $pagination, "limit" => $limit];
}

// if (isset($_GET["pageno"])){

//     $pageno = $_GET["pageno"];
    

//     pagination($con, "xxx", $pageno, 10);
// }


