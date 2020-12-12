<?php 

$con = mysql_connect("localhost","db_username","db_password");
$db = mysql_select_db("books4u",$con);
	
	if(!$db)
	{
		mysql_error();
	}



	

?>