<?php

function UpdateRecords($db, $table, $data, $id)
{

    $set_str = '';
    if (is_array($data) && count($data) > 0) {

        $i = 0;
        foreach (array_keys($data) as $key) {

            $set_str .= "" . $key . " = '" . $data[$key] . "'";

            if ($i + 1 != count($data)) {
                $set_str .= ',';
            }

            $i++;
        }

        $update_qry = "UPDATE `$table` SET " . $set_str . " WHERE id = $id";

        if (mysqli_query($db, $update_qry)) {
            return array(
                "mysqli_error" => false,
                "mysqli_insert_id" => mysqli_insert_id($db),
                "mysqli_affected_rows" => mysqli_affected_rows($db),
                "mysqli_info" => mysqli_info($db)
            );
        } else {
            return array("mysqli_error" => mysqli_error($db));
        }
    }
}

function getOneValue($db, $table, $field_name, $value, $whr_field)
{
    $qry = "SELECT " . $field_name . " FROM " . $table . " WHERE " . $whr_field . " = '" . $value."'";
    $res = mysqli_query($db, $qry);
    $row = mysqli_fetch_array($res);
    return $row[0];
}
function getSpecificFieldsRecords($db, $table_name, $field, $whr_field, $value)
{
    $qry = "SELECT $field FROM $table_name WHERE $whr_field = '$value'";
    if ($res = mysqli_query($db, $qry)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row[$field];
        }
    } else {
        $result['mysqli_error'] = mysqli_error($db);
    }
    return $result;
}
function getSpecific2FieldsRecords($db, $table_name, $field1, $field2, $whr_field, $value)
{
    $qry = "SELECT $field1, $field2 FROM $table_name WHERE $whr_field = '$value'";
    if ($res = mysqli_query($db, $qry)) {
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
    } else {
        $result['mysqli_error'] = mysqli_error($db);
    }
    return $result;
}
function getSpecificRecords($db, $table_name, $field, $value)
{
    $qry = "SELECT * FROM $table_name WHERE $field = '$value'";
    if ($res = mysqli_query($db, $qry)) {

        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
    } else {
        $result['mysqli_error'] = mysqli_error($db);
    }
    return $result;
}
function getSpecificSortedRecords($db, $table_name, $field, $value,$sorted_col, $order)
{
    $qry = "SELECT * FROM $table_name WHERE $field = '$value' ORDER BY $sorted_col $order";
    if ($res = mysqli_query($db, $qry)) {

        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
    } else {
        $result['mysqli_error'] = mysqli_error($db);
    }
    return $result;
}
function getSingleRecord($db, $table_name, $col_name, $value)
{
    $qry = "SELECT * FROM " . $table_name . " WHERE " . $col_name . " = '" . $value . "' ORDER BY id ASC LIMIT 1";

    if ($res = mysqli_query($db, $qry)) {
        
        $result = mysqli_fetch_assoc($res);
        $result['total'] = mysqli_num_rows($res);
        
    } else {

        $result['mysqli_error'] = mysqli_error($db);
    }
    
    return $result['total'];
}

// my own

function getNumberOfValue($db, $table_name, $col_name, $value)
{
    $qry = "SELECT * FROM " . $table_name . " WHERE " . $col_name . " = '" . $value . "' ";

    if ($res = mysqli_query($db, $qry)) {
        
        $result = mysqli_fetch_assoc($res);
        $result['total'] = mysqli_num_rows($res);
        
    } else {

        $result['mysqli_error'] = mysqli_error($db);
    }
    
    return $result['total'];
}

function getTotalNumber($db, $table_name)
{
    $qry = "SELECT * FROM $table_name  ";

    if ($res = mysqli_query($db, $qry)) {
        
        $result = mysqli_fetch_assoc($res);
        $result['total'] = mysqli_num_rows($res);
        
    } else {

        $result['mysqli_error'] = mysqli_error($db);
    }
    
    return $result['total'];
}

function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
{
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $s='';
        if(isset($_GET['s'])&&$_GET['s']!=''){
            $s.='&s='.$_GET['s'];
        }
        if(isset($_GET['uid'])&&$_GET['uid']!=''){
            $s.='&uid='.$_GET['uid'];
        }
        if(isset($_GET['payment_date'])&&$_GET['payment_date']!=''){
            $s.='&payment_date='.$_GET['payment_date'];
        }
        $pagination .= '<ul class="pagination pagination-sm">';

        $right_links = $current_page + 5;
        $previous = $current_page - 1; //previous link 
        $next = $current_page + 1; //next link
        $first_link = true; //boolean var to decide our first link

        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $pagination .= '<li class="page-item first"><a class="page-link" href="' . $page_url . '?page=1'.$s.'" title="First"><i class="fa fa-angle-double-left"></i></a></li>'; //first link
            $pagination .= '<li class"page-item"><a class="page-link" href="' . $page_url . '?page=' . 
            $previous_link .$s. '" title="Previous"><i class="fa fa-angle-left"></i></a></li>';
             //previous link
            for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
               
                if ($i > 0) {
                    $pagination .= '<li class="page-item"><a class="page-link" href="' . $page_url . '?page=' . $i .$s. '">' . $i . '</a></li>';
                }
            }
            $first_link = false; //set first link to false
        }

        if ($first_link) { //if current active page is first link
            $pagination .= '<li class="page-item first active"><a class="page-link" href="javascript:;">' . $current_page . '</a></li>';
        } elseif ($current_page == $total_pages) { //if it's the last active link
            $pagination .= '<li class="page-item last active"><a class="page-link" href="javascript:;">' . $current_page . '</a></li>';
        } else { //regular current link
            $pagination .= '<li class="page-item active"><a class="page-link" href="javascript:;">' . $current_page . '</a></li>';
        }

        for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
            if ($i <= $total_pages) {
                $pagination .= '<li class="page-item"><a class="page-link" href="' . $page_url . '?page=' . $i .$s. '">' . $i. '</a></li>';
            }
        }
        if ($current_page < $total_pages) {
            $j = $current_page + 1;
            $next_link = ($j > $total_pages) ? $total_pages : $j;
            $pagination .= '<li class="page-item"><a class="page-link" href="' . $page_url . '?page=' . $next_link .$s. '" ><i class="fa fa-angle-right"></i></a></li>'; //next link
            $pagination .= '<li class="page-item last"><a class="page-link" href="' . $page_url . '?page=' . $total_pages .$s. '" title="Last"><i class="fa fa-angle-double-right"></i></a></li>'; //last link
        }

        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}
function getPaginatedRecords($db, $table_name, $records_per_page)
{
    $result = array();
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    $results = mysqli_query($db, "SELECT COUNT(*) FROM $table_name");

    $get_total_rows = mysqli_fetch_row($results); //hold total records in variable

    if ($get_total_rows[0] > 0) {

        $total_pages = ceil($get_total_rows[0] / $item_per_page); //break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }


        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records
        //Fetch a group of records using SQL LIMIT clause
        $qry = "SELECT * FROM $table_name ORDER BY id DESC LIMIT $page_position, $item_per_page";


        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {

            //$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }

            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages,$page_url);
        } else {

            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getPaginatedSearchBookingRecords($db, $table_name, $search_data, $records_per_page, $col_1, $col_2)
{
    $result = array();
   // $search_term  = trim($search_term);
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    $qry = "SELECT * FROM $table_name WHERE $col_1 LIKE '%$search_data%' OR $col_2 LIKE '%$search_data%'";
    $results = mysqli_query($db, $qry);
    $get_total_rows = mysqli_num_rows($results); //hold total records in variable

    if ($get_total_rows > 0) {

       $total_pages = ceil($get_total_rows / $item_per_page);//break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }

        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records

        $qry = "SELECT * FROM $table_name WHERE $col_1 LIKE '%$search_data%' OR $col_2 LIKE '%$search_data%'";
        $qry.=" ORDER BY $table_name.uid DESC LIMIT $page_position, $item_per_page";
        $results = mysqli_query($db, $qry);

        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {
            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }
            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows, $total_pages,$page_url);
        } else {
            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getPaginatedFilteredRecords($db, $table_name, $date_start, $date_end, $records_per_page)
{
    $result = array();
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }


    $date_start = str_replace('/', '-', $date_start);
    $date_start = date('Y-m-d H:i:s', strtotime($date_start));
    if($date_end == ''){
        $date_end = $_GET['date-start'];
    }
    $date_end = str_replace('/', '-', $date_end);
    $date_end = date('Y-m-d H:i:s', strtotime('+59 seconds',strtotime('+59 minutes',strtotime('+23 hours',strtotime($date_end)))));

    $results = mysqli_query($db, "SELECT COUNT(*) FROM $table_name  WHERE publish_date BETWEEN '$date_start' AND '$date_end' ");

    $get_total_rows = mysqli_fetch_row($results); //hold total records in variable

    if ($get_total_rows[0] > 0) {

        $total_pages = ceil($get_total_rows[0] / $item_per_page); //break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }


        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records
        //Fetch a group of records using SQL LIMIT clause

        $qry = "SELECT * FROM $table_name WHERE publish_date BETWEEN '$date_start' AND '$date_end'  ORDER BY id DESC LIMIT $page_position, $item_per_page";

        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {

            //$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }

            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages,$page_url);
        } else {

            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getSortedSpecificConditionPaginatedFilteredRecords($db, $table_name, $where_field, $value, $records_per_page, $operator, $order_field, $order_type)
{
    $result = array();
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }


    $date_start = str_replace('/', '-', $date_start);
    $date_start = date('Y-m-d H:i:s', strtotime($date_start));
    if($date_end == ''){
        $date_end = $_GET['date-start'];
    }
    $date_end = str_replace('/', '-', $date_end);
    $date_end = date('Y-m-d H:i:s', strtotime('+59 seconds',strtotime('+59 minutes',strtotime('+23 hours',strtotime($date_end)))));

    $results = mysqli_query($db, "SELECT COUNT(*) FROM $table_name  WHERE $where_field $operator '$value' ORDER BY $order_field $order_type");
    $get_total_rows = mysqli_fetch_row($results); //hold total records in variable

    if ($get_total_rows[0] > 0) {

        $total_pages = ceil($get_total_rows[0] / $item_per_page); //break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }


        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records
        //Fetch a group of records using SQL LIMIT clause

        $qry = "SELECT * FROM $table_name WHERE $where_field $operator '$value' ORDER BY $order_field $order_type LIMIT $page_position, $item_per_page";

        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {

            //$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }

            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages,$page_url);
        } else {

            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getSpecificConditionSearchPaginatedFilteredRecords($db, $table_name, $search_data, $where_field, $value, $operator, $order_field, $order_type, $records_per_page, $search_field)
{
    $result = array();
   // $search_term  = trim($search_term);
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    $qry = "SELECT * FROM $table_name WHERE $where_field $operator '$value' AND $search_field LIKE '%$search_data%' ORDER BY $where_field $order_type";
    $results = mysqli_query($db, $qry);
    $get_total_rows = mysqli_num_rows($results); //hold total records in variable
    if ($get_total_rows > 0) {

       $total_pages = ceil($get_total_rows / $item_per_page);//break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }

        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records

        $qry = "SELECT * FROM $table_name WHERE $where_field $operator '$value' AND $search_field LIKE '%$search_data%'";
        echo $qry.=" ORDER BY $where_field $order_type LIMIT $page_position, $item_per_page";
        $results = mysqli_query($db, $qry);
        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {
            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }
            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows, $total_pages,$page_url);
        } else {
            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getAllRecords($db, $table)
{
    $GT_Arr =array();
    $selGT = "SELECT * FROM $table ORDER BY id ASC ";
    $qryGT = mysqli_query($db, $selGT);
    if (mysqli_num_rows($qryGT)) {
        while ($GT = mysqli_fetch_assoc($qryGT)) {
            $GT_Arr[] = $GT;
        }
    }
    return $GT_Arr;
}
function getLimitedRecords($db, $table, $limit)
{
    $selGT = "SELECT * FROM $table WHERE `status` = 1 ORDER BY id DESC LIMIT $limit";
    $qryGT = mysqli_query($db, $selGT);
    if (mysqli_num_rows($qryGT)) {
        while ($GT = mysqli_fetch_assoc($qryGT)) {
            $GT_Arr[] = $GT;
        }
    }
    return $GT_Arr;
}
function getAllSortedRecords($db, $table, $col, $order)
{
    $selGT = "SELECT * FROM $table ORDER BY  $col  $order ";
    $qryGT = mysqli_query($db, $selGT);
    if (mysqli_num_rows($qryGT)) {
        while ($GT = mysqli_fetch_assoc($qryGT)) {
            $GT_Arr[] = $GT;
        }
    }
    return $GT_Arr;
}
function getSortedPaginatedRecords($db, $table_name, $col, $order, $records_per_page)
{
    $result = array();
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    $results = mysqli_query($db, "SELECT COUNT(*) FROM $table_name");

    $get_total_rows = mysqli_fetch_row($results); //hold total records in variable

    if ($get_total_rows[0] > 0) {

        $total_pages = ceil($get_total_rows[0] / $item_per_page); //break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }


        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records
        //Fetch a group of records using SQL LIMIT clause
        $qry = "SELECT * FROM $table_name ORDER BY $col $order LIMIT $page_position, $item_per_page";


        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {

            //$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }

            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages, $page_url);
        } else {

            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getSortedSelectedPaginatedRecords($db, $table_name, $whr ='' ,$col, $order, $records_per_page)
{
    $result = array();
    $item_per_page = $records_per_page; //item to display per page
    if (isset($_GET["page"])) { //Get page number from $_GET["page"]
        $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        } //incase of invalid page number
    } else {
        $page_number = 1; //if there's no page number, set it to 1
    }

    $results = mysqli_query($db, "SELECT COUNT(*) FROM $table_name");

    $get_total_rows = mysqli_fetch_row($results); //hold total records in variable

    if ($get_total_rows[0] > 0) {

        $total_pages = ceil($get_total_rows[0] / $item_per_page); //break records into pages
        if ($page_number > $total_pages) {
            $page_number = $total_pages;
        }


        ################# Display Records per page ############################
        $page_position = (($page_number - 1) * $item_per_page); //get starting position to fetch the records
        //Fetch a group of records using SQL LIMIT clause
        $qry = "SELECT * FROM $table_name $whr ORDER BY $col $order LIMIT $page_position, $item_per_page";


        $res = mysqli_query($db, $qry);
        if (mysqli_query($db, $qry)) {

            //$result = mysqli_fetch_all($res,MYSQLI_ASSOC);

            while ($row = mysqli_fetch_assoc($res)) {
                $result[] = $row;
            }

            $result['pagination'] = paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages, $page_url);
        } else {

            $result['mysqli_error'] = mysqli_error($db);
        }
    } else {
        $result['success'] = 'false';
        $result['error'] = 'No data Found';
    }
    return $result;
}
function getAllEnabledRecords($db, $table_name, $field, $value)
{
    $qry = "SELECT * FROM $table_name WHERE $field = '$value' AND status = 1";

    if ($res = mysqli_query($db, $qry)) {

        while ($row = mysqli_fetch_assoc($res)) {

            $result[] = $row;

        }
        $result['total'] = mysqli_num_rows($res);
    } else {
        $result['mysqli_error'] = mysqli_error($db);
    }
    return $result;
}
function getConditionalOneValue($db, $table, $field_name, $whr)
{
    $qry = "SELECT " . $field_name . " FROM " . $table . " WHERE " . $whr;
    $res = mysqli_query($db, $qry);
    $row = mysqli_fetch_array($res);
    return $row[0];
}
function getMaxOrder($db, $table_name){
    $qry = "SELECT  MAX(setord) AS maxid from $table_name";
    $qryGT = mysqli_query($db, $qry);
    $row = mysqli_fetch_assoc($qryGT);
    return $row['maxid'];
}
function getSpecificMaxOrder($db, $table_name, $col, $val)
{
    $qry = "SELECT MAX(setord) AS maxid from $table_name WHERE $col = '$val'";
    $qryGT = mysqli_query($db, $qry);
    $row = mysqli_fetch_assoc($qryGT);
    return $row['maxid'];
}
function check_admin_login($url)
{
    if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false) {
        if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] != '') {
            header('location:' . $url . 'dashboard.php');
        }
    } else {

        if (!isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == '') {
            header('location:' . $url);
        }
    }
}
function limitText($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
  }
function getAddress() {

    $protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

}
function countPageViews($db,$post_id,$post_views){

    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    $qry = "SELECT user_ip FROM page_views WHERE post_id=$post_id and user_ip='$user_ip'";
    $res = mysqli_query($db,$qry);

    if(mysqli_num_rows($res)==0) {
        
        $insertviewQry = "INSERT INTO page_views SET post_id = $post_id, user_ip ='$user_ip' ";
        $insertview = mysqli_query($db,$insertviewQry);

        $post_views = $post_views + 1;
        $updateviewQry = "UPDATE posts SET post_views = '$post_views' WHERE id = ".$post_id;
        $updateview = mysqli_query($db,$updateviewQry);
    }
    return $post_views;
}


function getYTID($url){

    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
   
    return $match[1];
}
function slug($db ,$text, $table_name)
{
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=','®');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','','-');
	$slug = str_replace($code_entities_match, $code_entities_replace, $text);

	$query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE slug LIKE '%$slug%'";
	$result = mysqli_query($db, $query) or die(mysqli_error($db));
	$row = mysqli_fetch_assoc($result);
	$numHits = $row['NumHits'];

	return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	//return $text;
} 
function isDupicateAdd($db,$table,$field,$value)
{
	
	$q = "select `".$field."` from `".$table."` where ".$field." = '".$value."'"; 

	$r = mysqli_query($db,$q);

	if(mysqli_num_rows($r) > 0)

		return true;

	else

		return false;

}
function isDupicateEdit($db,$table,$field,$value,$id)
{
	$q = "SELECT `".$field."` FROM `".$table."` WHERE ".$field." = '".$value."' AND id != $id"; 

	$r = mysqli_query($db,$q);

	if(mysqli_num_rows($r) > 0)
		return true;
	else
		return false;
}
function getTotalRecords($db,$table,$field,$value)
{
	$q = "select count(*) as tr from `".$table."` where ".$field." = '".$value."'"; 

	$r = mysqli_query($db,$q);

	$row = mysqli_fetch_assoc($r);
	
	return $row['tr'];
}

function getTotalRecordsExcept($db,$table,$field,$value,$exp_field,$exp_val)
{
	$q = "SELECT COUNT(*) as tr from `$table` WHERE $field = '$value' AND $exp_field != '$exp_val' "; 

	$r = mysqli_query($db,$q);

	$row =mysqli_fetch_assoc($r);
	
	return $row['tr'];
}
function getMaxFromCol($db,$table,$col,$venue_id){
    $q="SELECT MAX( $col ) AS max FROM `$table` WHERE venue_id = $venue_id";
    $res = mysqli_query($db,$q) or die(mysqli_error($db));
    $row =  mysqli_fetch_assoc($res);
    return $row['max'];
}
function randomString($db){

    $unique_ref_length = 11;
    $unique_ref_found = false;

    $possible_chars = "0123456789abcefghijklmnopqrstuvwyzABCDEFGHIJKMNOPQRSTVWYZ";  

    while (!$unique_ref_found) {  
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
         
         $query = "SELECT `reset_token` FROM `users` 
                WHERE `reset_token` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }
    return  $unique_ref;
}
function referral_code_generate($db){

    $unique_ref_length = 8;
    $unique_ref_found = false;

    $possible_chars = "0123456789abcefghijklmnopqrstuvwyzABCDEFGHIJKMNOPQRSTVWYZ";  

    while (!$unique_ref_found) {  
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
         
         $query = "SELECT `referral_code` FROM `users` 
                WHERE `referral_code` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }
    return  $unique_ref;
}
function getUid($db) 
{ 
    $unique_ref_length = 16;
    $unique_ref_found = false;

    $possible_chars = "0123456789abcefghijklmnopqrstuvwyzABCDEFGHIJKMNOPQRSTVWYZ";

    while (!$unique_ref_found) {
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
         
         $query = "SELECT `uid` FROM `users` 
                WHERE `uid` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }
    return  $unique_ref;
}
function getBranchID($db) 
{ 
    $unique_ref_length = 10;
    $unique_ref_found = false;  

    $possible_chars = "123456789#@ABCDEFGHIJKMNOPQRSTVWXYZ";  

    while (!$unique_ref_found) {  
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
         
         $query = "SELECT `branch_id` FROM `venue_details` 
                WHERE `branch_id` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }
    return  $unique_ref;
}  
function getPassword() 
{ 
    $unique_ref_length = 8;
    $possible_chars = "123456789abcefghijklmnopqr@#&!stuvwxyz#ABCDEFGHIJKMNOPQRSTVWXYZ";  
    $unique_ref = "";  
    $i = 0;  

    while ($i < $unique_ref_length) {   
        $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
        $unique_ref .= $char;  
        $i++;
    }  
    return  $unique_ref;
} 
function getTempId($db) 
{ 
    $unique_ref_length = 4;
    $possible_chars = "123456789";  
    $unique_ref_found = false;  
    $unique_ref = "";  
   
    while (!$unique_ref_found) {  
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
     
         $query = "SELECT `temp_id` FROM `temp_orders` 
                WHERE `temp_id` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }


    return  $unique_ref;
} 
function getOrderId($db){

    $unique_ref_length = 8;
    $unique_ref_found = false;  

    $possible_chars = "1234567890";  

    while (!$unique_ref_found) {  
        
        $unique_ref = "";  
        $i = 0;  

        while ($i < $unique_ref_length) {   
            $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
            $unique_ref .= $char;  
            $i++;
        }  
        $unique_ref = 'OD'.$unique_ref;
         $query = "SELECT `order_id` FROM `orders` 
                WHERE `order_id` = '$unique_ref'"; 

        $result = mysqli_query($db,$query) or die(mysqli_error($db));  
        if (mysqli_num_rows($result)==0) {   
            $unique_ref_found = true;   
        }  
    
    }
    return  $unique_ref;
}
function encrypt_password($u_password){
    return  password_hash($u_password, PASSWORD_DEFAULT);
}


function sendPasswordResetEmail($to,$reset_password,$email){
	ob_start(); 
    require_once ('../pass-reset-template.php'); 
   $body =  ob_get_clean();

   $subject= "Reset Your e-society Password";
    
   require_once 'phpmailer/class.phpmailer.php'; 
   
          $mail = new PHPMailer(true); 
          try{
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;     
            $mail->Host       = "smtp.gmail.com"; // SMTP server
            $mail->Username   = "kosinfo2272@gmail.com";     // SMTP server username
            $mail->Password   = "kos2272@"; 
            $mail->SMTPSecure = "ssl"; 
           // $mail->IsSendmail();  // tell the class to use Sendmail
        
           $mail->AddReplyTo('kosinfo2272@gmail.com','No Reply');
        
           $mail->From       = 'kosinfo2272@gmail.com';
           $mail->FromName   = 'e-society';
            
            $mail->AddAddress($to);
     
            $mail->Subject  =   $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap
        
            $mail->MsgHTML($body);
            
            $mail->IsHTML(true); // send as HTML
        
            $sendEmail = $mail->Send();

            return true;
      } catch (phpmailerException $e) {
          echo $e->errorMessage();
          
      }
}
function sendAccVerificationEmail($to,$varification_link,$get_password){
   
    ob_start(); 
        require_once ('../email-verification-template.php'); 
    $body =  ob_get_clean();
    // $body = "Test email";
    $subject= "Activate Your E-society Account";
    
   require_once 'phpmailer/class.phpmailer.php'; 
   
          $mail = new PHPMailer(true); 
          try{
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;     
            $mail->Host       = "smtp.gmail.com"; // SMTP server
            $mail->Username   = "kosinfo2272@gmail.com";     // SMTP server username
            $mail->Password   = "kos2272@"; 
            $mail->SMTPSecure = "ssl";
           // $mail->IsSendmail();  // tell the class to use Sendmail
        
            $mail->AddReplyTo('kosinfo2272@gmail.com','No Reply');
        
            $mail->From       = 'kosinfo2272@gmail.com';
            $mail->FromName   = 'e-society';
            
            $mail->AddAddress($to);
     
            $mail->Subject  =   $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap
        
            $mail->MsgHTML($body);
            
            $mail->IsHTML(true); // send as HTML
        
            $sendEmail = $mail->Send();

            return true;
      } catch (phpmailerException $e) {
          echo $e->errorMessage();
      }
}

//notice send in email

function sendNoticeEmail($to,$notice_title,$notice_description){
   
    ob_start(); 
        require_once ('../notice_email_templet.php'); 
    $body =  ob_get_clean();
    // $body = "Test email";
    $subject= "Your Notice";
    
   require_once 'phpmailer/class.phpmailer.php'; 
   
          $mail = new PHPMailer(true); 
          try{
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;     
            $mail->Host       = "smtp.gmail.com"; // SMTP server
            $mail->Username   = "kosinfo2272@gmail.com";     // SMTP server username
            $mail->Password   = "kos2272@"; 
            $mail->SMTPSecure = "ssl";
           // $mail->IsSendmail();  // tell the class to use Sendmail
        
            $mail->AddReplyTo('kosinfo2272@gmail.com','king computer');
        
            $mail->From       = 'kosinfo2272@gmail.com';
            $mail->FromName   = 'e-society';
            
            $mail->AddAddress($to);
     
            $mail->Subject  =   $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap
        
            $mail->MsgHTML($body);
            
            $mail->IsHTML(true); // send as HTML
        
            $sendEmail = $mail->Send();

            return true;
      } catch (phpmailerException $e) {
          echo $e->errorMessage();
      }
}

function sendOrderEmail($db,$order_id,$user_details){

    $order = getSingleRecord($db,'orders','order_id',$order_id);
    $package = getSingleRecord($db,'packages','id',$order['package_id']);
    $currency = getOneValue($db,'countries','currency',$package['country_id'],'id');
    $to = $user_details['email']; 
	ob_start(); ?>
    <html>

        <head>

            <title>Welcome to Momenty.asia</title>

        </head>

        <body style ="font-family: Helvetica, Arial, sans-serif;">

            <div style="width:100%;text-align:center"><img width="20%" src="https://momenty.asia/beta/images/logo.png"></div>

            <p>Hello <?php echo $user_details['name']?$user_details['name']:'Dear Momenty user'; ?>,</p>

            <br />

            <p>You are successfully subscribed to the momenty package.</p>
            <p>Your subscription details are as following:</p>
            <br />
            <p><strong>Order ID:</strong> #<?php echo $order['order_id'];?></p>
            <p><strong>Subscription:</strong> <?php echo $package['package_name'];?></p>
            <p><strong>Subscription Price:</strong> <?php echo $package['price']." ".$currency." / month"; ?></p>
            <?php if($order['order_shipping_amount']>0){?>
            <p><strong>Shipping Charges:</strong> <?php echo $order['order_shipping_amount']." ".$currency; ?></p>
            <?php } ?>
            <p><strong>Subscription Total Payment:</strong> <?php echo $order['order_total']." ".$currency; ?></p>
            <p><strong>Subscription validity:</strong> <?php echo $order['order_validity']." Months"; ?></p>
            <p><strong>Subscription start from:</strong> <?php echo date('m-Y',strtotime($order['order_start_date'])); ?></p>
            <p><strong>Subscription ends at:</strong> <?php echo date('m-Y',strtotime($order['order_expiration_date'])); ?></p>
            <p><strong>Transaction reference number:</strong> <?php echo $order['transaction_ref'];?></p>

            <br /> <br />
            

            <p>Thank you,</p>

            <p>Momenty.asia Team</p>

        </body>

        </html>
<?php
   $body =  ob_get_clean();

   $subject= "Thanks for Subscribing to Momenty";
    
   require_once 'phpmailer/class.phpmailer.php'; 
   
          $mail = new PHPMailer(true); 
          try{
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;     
            $mail->Host       = "smtp.gmail.com"; // SMTP server
            $mail->Username   = "noreply@momenty.asia";     // SMTP server username
            $mail->Password   = "Kb$6c1j6"; 
            $mail->SMTPSecure = "ssl"; 
           // $mail->IsSendmail();  // tell the class to use Sendmail
        
            $mail->AddReplyTo('noreply@momenty.asia','Momenty');
        
            $mail->From       = 'noreply@momenty.asia';
            $mail->FromName   = 'Momenty';
            
            $mail->AddAddress($to);
     
            $mail->Subject  =   $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap
        
            $mail->MsgHTML($body);
            
            $mail->IsHTML(true); // send as HTML
        
            $sendEmail = $mail->Send();

            return true;
      } catch (phpmailerException $e) {
          echo $e->errorMessage();
          
      } 
}
function sendContactEmail($name,$email,$message){

    ob_start(); ?>
    <html>
        <head>
            <title>Welcome to Momenty.asia</title>
        </head>
        <body style ="font-family: Helvetica, Arial, sans-serif;">
            <div style="width:100%;text-align:center"><img width="20%" src="https://momenty.asia/beta/images/logo.png"></div>
            <p>Hello Admin,</p>
            <p>New contact inquiry received from Momenty</p>
            <p>The details are as follow:</p>
            <br />
            <p><strong>Name:</strong> <?php echo $name;?></p>
            <p><strong>Email:</strong> <?php echo $email;?></p>
            <p><strong>Message:</strong> <?php echo $message;?></p>
            <br /> <br />
            <p>Thank you.</p>
        </body>

    </html> <?php

    $body =  ob_get_clean();

    $subject= "New contact inquiry from Momenty";
     
    require_once 'phpmailer/class.phpmailer.php'; 
           
            $to = 'contact@momenty.asia';
           $mail = new PHPMailer(true); 
           try{
             $mail->IsSMTP();                           // tell the class to use SMTP
             $mail->SMTPAuth   = true;                  // enable SMTP authentication
             $mail->Port       = 465;     
             $mail->Host       = "mail.momenty.asia"; // SMTP server
             $mail->Username   = "noreply@momenty.asia";     // SMTP server username
             $mail->Password   = "Kb$6c1j6"; 
             $mail->SMTPSecure = "ssl"; 
            // $mail->IsSendmail();  // tell the class to use Sendmail
         
             $mail->AddReplyTo('noreply@momenty.asia','Momenty');
         
             $mail->From       = 'noreply@momenty.asia';
             $mail->FromName   = 'Momenty';
             
             $mail->AddAddress($to);
      
             $mail->Subject  =   $subject;
             $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
             $mail->WordWrap   = 80; // set word wrap
         
             $mail->MsgHTML($body);
             
             $mail->IsHTML(true); // send as HTML
         
             $sendEmail = $mail->Send();
 
             return true;
       } catch (phpmailerException $e) {
           return $e->errorMessage();
           
       } 

}
function getPaymentStatus($status){
    switch ($status) {
        case 'C':
            return PAYMENT_COMPLETE;
            break;

        case 'P':
            return PAYMENT_PENDING;
            break;

        case 'F':
            return PAYMENT_FAILED;
            break;

        case 'X':
            return PAYMENT_CANCEL;
            break;
        
        case 'R':
            return PAYMENT_REFUND;
            break;
    }
}
function getBookingStatus($status){
    switch ($status) {
        case 'C':
            return BOOKING_CONFIRM;
            break;

        case 'U':
            return BOOKING_UNCONFIRMED;
            break;

        case 'X':
            return BOOKING_CANCEL;
            break;
    }
}


function getSumOfSingleColumn($db, $table, $field_name, $field, $value){
    $sum_count = "SELECT SUM( $field_name ) as total FROM $table WHERE $field = '$value'";
    $run_count = mysqli_query($db, $sum_count);
    $row = mysqli_fetch_assoc($run_count);
    $income_show = $row['total'];
    return $income_show;
}
