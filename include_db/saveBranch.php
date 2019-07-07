<?php

require_once('session.php');

if( (!isset($_POST['name'])) || (!isset($_POST['password'])) || (!isset($_POST['bra_stat'])) )
{
	die('إملأ جميع الخيارات');
}

require_once('branchAPI.php');


$user = invoice_bra_get_by_name($_POST['name']);
if($user != NULL)
{
	invoice_db_close();
	die('USER EXIST');
}

$n_name = trim($_POST['name']);
$n_pass = trim($_POST['password']);
$n_com_id = trim($_POST['com_id']);
$n_bra_stat = trim($_POST['bra_stat']);
//$query = sprintf("INSERT INTO `users` VALUE (NULL,'%s','%s','%s')" , $n_name , $n_pass , $n_email);
//$qresult = @mysqli_query($tf_handle,$query);

$result = invoice_bra_add($n_com_id,$n_name,$n_pass,$n_bra_stat);

//invoice_db_close();

if($result){
	if($_SESSION['cominfo']!= false){
		header('Location:../system/main.php');
	}else{
		$_SESSION['com_id']  = false;
		$_SESSION['fail'] = false;
		header('Location:../login.php');
	}
	
}else{
    GLOBAL $tf_handle;
    @mysqli_query($tf_handle,"DELETE FROM `company` WHERE `com_id` = '$n_com_id'");
	$_SESSION['fail'] = true;
    header('Location:../register_com.php');
}

?>