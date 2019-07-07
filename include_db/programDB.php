<?php

define('DB_NAME_PRO' , 'invoice_program_db');
define('DB_HOST_PRO' , 'localhost');
define('DB_USER_PRO' , 'root');
define('DB_PASSWORD_PRO' , '');

// connect with siver


$db = @mysqli_connect(DB_HOST_PRO,DB_USER_PRO,DB_PASSWORD_PRO,DB_NAME_PRO) or die('Could not connect...');

//die('ok');
//@mysql_close($tf_handle);

//-----------------------------------------------
// to used ARABIC langauge

@mysqli_query($db,"SET NAMES 'utf8'");

function invoice_db_close_pro()
{
	global $db;
	$db->close();
}


//tinyf_db_close();

?>