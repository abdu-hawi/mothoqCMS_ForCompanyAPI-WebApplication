<?php

require_once('session.php');

if( (!isset($_POST['userName'])) || (!isset($_POST['password'])) )
{
	die('BAD ACCESS');
}

require_once('db.php');

if( empty ($_POST['userName']) || empty ($_POST['password']) )
{
	invoice_db_close();
	die('FILL INFO');
}
require_once('compAPI.php');
$user = invoice_comp_get_by_name($_POST['userName']);


$stat = 0;

if(!$user)
{
	echo ('no in comp <br/>');
	require_once('branchAPI.php');
	$user = invoice_bra_get_by_name($_POST['userName']);
	if(!$user)
	{
		invoice_db_close();
		echo('no in branch <br/>');
	}else{
		$stat = 2;
		echo('in branch <br/>');
	}
}else{
	$stat = 1;
	echo ('in comp <br/>');
}
//$pass = @md5($tf_handle,mysqli_real_escape_string($tf_handle,strip_tags($_POST['password'])));
$pass = @md5(mysql_real_escape_string(strip_tags($_POST['password']),$tf_handle));

invoice_db_close();
echo $user->passward + '<br/>';
if( strcmp ($pass , $user->passward) != 0 )
{
	die('BAD pass');
}

$user->passward = 0;

if($stat == 1){
	$_SESSION['cominfo'] = $user;
	header ('Location:../system/main.php');
}elseif($stat == 2){
	$_SESSION['brainfo'] = $user;
	header ('Location:../include_inv/order.php');
}else{
	
}

//header ('Location: showforums.php');

?>