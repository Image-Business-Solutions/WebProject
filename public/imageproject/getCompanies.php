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
        $data = iconv('cp1251', 'utf-8', $data);
    }
    return $data;
}

if(file_exists('mysql.class.php'))
	require_once('mysql.class.php');
  
if(file_exists('database.php'))
	require_once('database.php');
  
if(file_exists('error_messages.php'))
	require_once('error_messages.php');
  
$db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

$result = $db->query("SELECT `companies`.`id`, `companies`.`name` FROM `companies`,`rel_comp_users_level` 
				WHERE `rel_comp_users_level`.`company_id` = `companies`.`id` 
				AND `rel_comp_users_level`.`user_id` = " . $db->escape($_POST['merchendizer_id']) . " 
				AND `rel_comp_users_level`.`permission_level_id` = 1 GROUP BY `companies`.`name`");

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
	$response["message"] = "UUps there is no information for you :p";
}

echo json_safe($response);