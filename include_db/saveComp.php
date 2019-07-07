<?php

require_once('session.php');

if( (!isset($_POST['name'])) || (!isset($_POST['password'])) || (!isset($_POST['email'])) ||
   (!isset($_POST['desc'])) || (!isset($_POST['img'])) )
{
	die('BAD ACCESS');
}

require_once('compAPI.php');

$user = invoice_comp_get_by_name($_POST['name']);
if($user != NULL)
{
	invoice_db_close();
	die('USER EXIST');
}

$user = invoice_comp_get_by_email($_POST['email']);
if($user != NULL)
{
	invoice_db_close();
	die('EMAIL EXIST');
}

$n_name = trim($_POST['name']);
$n_desc = trim($_POST['desc']);
$n_pass = trim($_POST['password']);
$n_email = trim($_POST['email']);
$n_img = trim($_POST['img']);

$result = invoice_comp_add($n_name,$n_desc,$n_pass,$n_email,$n_img );

//////////////

if($result){
	
	$qry = invoice_comp_get_id_by_name($n_name);
	if($qry != NULL){
		$_SESSION['com_id'] = $qry[0];
		invoice_db_close();
		header('Location:../register_branch.php');
	}else{
		$qry_del = mysqli_query($tf_handle,"DELETE `com_id` FROM `company` WHERE `com_name` = '$n_name'");
		$_SESSION['fail'] = true;
		invoice_db_close();
		header('Location:../register_com.php');
	}
	
}else{
	$_SESSION['fail'] = true;
	invoice_db_close();
	echo ('fail');
	header('Location:../register_com.php');
}

/*
global $tf_handle;
	$_SESSION['com_id']  = $tf_handle->insert_id;
	$_SESSION['fail'] = false;
	invoice_db_close();
	header('Location:../register_branch.php');
*/
?>