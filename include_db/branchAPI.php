<?php

	function invoice_bra_get($extra = '')
	{
		
		global $tf_handle;
		$query = " SELECT * FROM `branch` '.$extra.' " ;
		$qresult = @mysqli_query($tf_handle,$query);
		if(!$qresult)
			return NULL;
		
		$rcount = @mysqli_num_rows($qresult);
		if($rcount == 0)
			return NULL;
			
		$bra = array();
		for( $i = 0 ; $i < $rcount ; $i++ )
		{
			$bra[@count($bra)] = @mysqli_fetch_object($qresult);
		}
		
		@mysqli_free_result($qresult);
		
		return $bra;
		
	} // END invoice_users_get function
	
	function invoice_bra_get_by_id($uid)
	{
		// used for cryptography
		$id = (int)$uid;
		if($id == 0 )
			return NULL;
			
		$result = invoice_bra_get('WHERE `bra_id` =' .$id);
		if($result == NULL)
			return NULL;
			
		$bra = $result[0];
		return $bra;
		
	}// END invoice_users_get_by_id function
	
	function invoice_bra_get_by_name($name)
	{
		global $tf_handle;
		$n_name    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = mysqli_query($tf_handle , "SELECT * FROM `branch` WHERE `bra_name` = '$n_name'");
		//$rows = mysqli_fetch_row($result);
		$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	
	function invoice_bra_add($com_id,$name,$password,$bra_stat)
	{
		
		global $tf_handle;
		
		if ( empty($name) || empty($password) || empty($com_id) || empty($bra_stat))
			return false;
		
		$n_name    = @mysqli_real_escape_string($tf_handle , strip_tags($name));
		$n_pass    = @md5(mysql_real_escape_string($tf_handle ,strip_tags($password)));
        $n_com_id    = @mysqli_real_escape_string($tf_handle , intval($com_id));
		$n_bra_stat = @mysqli_real_escape_string($tf_handle,intval($bra_stat));
		
		$query = sprintf("INSERT INTO `branch` VALUE (NULL,'%d','%s','%s' , '%s')" ,$n_com_id, $n_name , $n_pass , $n_bra_stat);
		$qresult = @mysqli_query($tf_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END tinyf_users_add function
	
	require_once('db.php');
	
	

?>