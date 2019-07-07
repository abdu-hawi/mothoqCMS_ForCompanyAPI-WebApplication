<?php

define('DB_NAME' , 'test');
define('DB_HOST' , 'localhost');
define('DB_USER' , 'root');
define('DB_PASSWORD' , '');

// connect with siver

$tf_handle = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');


$response = array();
$user_no = strip_tags(trim($_POST['user_id']));;
$shop_name = strip_tags(trim($_POST['shop_name']));
$shop_desc = strip_tags(trim($_POST['shop_desc']));
$order_date = strip_tags(trim($_POST['order_date']));
$total_amount = strip_tags(trim($_POST['final_total_amt']));
$json_items = $_POST['json_items'];


$obj = ' {"arr":
    [
     {"PRODUCT":"asa","QTY":"12","PRICE":"22"},
     {"PRODUCT":"asa","QTY":"12","PRICE":"22"},
     {"PRODUCT":"mom","QTY":"30","PRICE":"10"}
    ]
}';


$obj = json_decode($json_items->recent, true);
$ss = count($obj->recent);
$sobj = $obj[0];
$tobj = $sobj['PRODUCT'];
//$obj->recent; //array 
//$obj->recent[0]; //first element of array
//$obj->recent[0][0]; //first element of second array
//$obj->recent[0][0]->{'team 1'}; //access to object team 1
//$obj->recent[0][0]->{'team 1'}->score; //access to property of object team 1


$stmt = mysqli_query($tf_handle,"INSERT INTO `test` (`id`, `shop`, `desc_j`, `json_item`)
                     VALUES (NULL, '$tobj', '$ss', '$json_items')");


//$ms = "user id: ".$user_no." ,
//      shop name: ".$shop_name." ,
//      shop_desc: ".$shop_desc." ,
//      order date: ".$order_date." ,
//      json_items: ".$json_items ;
//      
//    $response['error'] = true;
//    $response['msg'] = $ms;

//for($count=0 ; $count<$_POST["total_item"] ; $count++){
//                
//            $item_name = trim($_POST['item_name'][$count]);
//            $item_qty = trim($_POST['order_item_quantity'][$count]);
//            $item_price = trim($_POST['order_item_price'][$count]);
//}



?>