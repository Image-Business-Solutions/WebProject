<?php
function json_safe($data)
{
    return json_encode(json_fix($data));
}
function json_fix($data)
{
    # Process arrays
    if(is_array($data))
    {
        $new = array();
        foreach ($data as $k => $v)
        {
            $new[json_fix($k)] = json_fix($v);
        }
        $data = $new;
    }
    # Process objects
    else if(is_object($data))
    {
        $datas = get_object_vars($data);
        foreach ($datas as $m => $v)
        {
            $data->$m = json_fix($v);
        }
    }
    # Process strings
    else if(is_string($data))
    {
       //$data = iconv('cp1251', 'utf-8', $data);
    }
    return $data;
}
/*
function foo()
{
	$message = "There's problem! Don't worry there are magicians that are fighting hard now to slove it. Show them this below and they know what to do:\n";

	$bt = debug_backtrace();
	$caller = array_shift($bt);
	$fileAndLine = $caller['file'].": ".$caller['line'];
	$message .= bin2hex($fileAndLine)."!".ERROR_SQL_RESPONSE;
	
	return $message;
	
}
*/
if(file_exists('mysql.class.php'))
	require_once('mysql.class.php');
  
if(file_exists('database.php'))
	require_once('database.php');
  
if(file_exists('error_messages.php'))
	require_once('error_messages.php');
  
$db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
$result = $db->query("SELECT  `id` ,  `name` ,  `address` ,  `lat` ,  `lng` ,  `place_class` 
						FROM  `places` WHERE 1 ORDER BY  `place_class` ,  `name` ");

# Anything found?
if($db->num_rows($result))
{
	$response["result"] = array();
	
	while( ($row = $db->fetch_assoc($result)) != false )
		array_push($response["result"], $row);
		
	$response["status"] = 1;
}
else
{
	$response["status"] = 0;
	$response["message"] = "Wizards don't know you!\nTry to authenticate with other information!";
};

echo json_safe($response);