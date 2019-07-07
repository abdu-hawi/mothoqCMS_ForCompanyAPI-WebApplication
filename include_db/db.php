<?php

define('DB_NAME' , 'last_invoice_test');
define('DB_HOST' , 'localhost');
define('DB_USER' , 'root');
define('DB_PASSWORD' , '');

// connect with siver

$tf_handle = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');

//die('ok');
//@mysql_close($tf_handle);

//-----------------------------------------------
// to used ARABIC langauge

@mysqli_query($tf_handle,"SET NAMES 'utf8'");
@mysqli_query($tf_handle,"SET CHARACTER SET utf8");  
@mysqli_query($tf_handle,"SET SESSION collation_connection = 'utf8_general_ci'"); 

function invoice_db_close()
{
	global $tf_handle;
	$tf_handle->close();
}


//tinyf_db_close();

?>