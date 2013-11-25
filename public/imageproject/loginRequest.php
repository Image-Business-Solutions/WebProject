<?php
if( isset($_POST['email']) && isset($_POST['password']) )
{

	function foo()
	{
		$message = "There's problem! Don't worry there are magicians that are fighting hard now to slove it. Show them this below and they know what to do:\n";

		$bt = debug_backtrace();
		$caller = array_shift($bt);
		$fileAndLine = $caller['file'].": ".$caller['line'];
		$message .= bin2hex($fileAndLine)."!".ERROR_SQL_RESPONSE;
		
		return $message;
		
	}
	
	if(file_exists('mysql.class.php'))
		require_once('mysql.class.php');
	  
	if(file_exists('database.php'))
		require_once('database.php');
	  
	if(file_exists('error_messages.php'))
		require_once('error_messages.php');
	  
	$db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

	$pass = $_POST['password'];

	if(file_exists('passwordEncrypt.php'))
	{
		require_once('passwordEncrypt.php');
		$pass = EncryptPassword($db->escape($pass));
	}

	$email = $_POST['email'];

	$result = $db->query("SELECT * FROM `users` WHERE password = '".$db->escape($pass)."' AND email = '".$db->escape($email)."'");

	# Anything found?
	if($db->num_rows($result))
	{
		$result = $db->fetch_assoc($result);
		
		$response["status"] = 1;
		$response["id"] = (integer) $result["id"];
	}
	else
	{
		$response["status"] = 0;
		$response["message"] = "Wizards don't know you!\nTry to authenticate with other information!";
	}


	//print_r($response);
}
else
{
	$response["status"] = 0;
	$response["message"] = "Ingredients you are giving to the wizards are not the requested ones!";
}

echo json_encode ( $response );