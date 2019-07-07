<?php

$con = mysqli_connect('localhost','root','','last_invoice_test');
if (!$con) die ("not con");

mysqli_query($con,"SET NAMES 'utf8'");
mysqli_query($con,"SET CHARACTER SET utf8");  
mysqli_query($con,"SET SESSION collation_connection = 'utf8_general_ci'");

function close_db(){
 mysqli_close($con);   
}

?>