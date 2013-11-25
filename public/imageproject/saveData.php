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

$response["message"] = 0;
	
if( isset( $_POST['data'] ) )
{
	date_default_timezone_set('Europe/Sofia');
	$date = date("Y-m-d H:i:s", time());
	
	$json = stripcslashes($_POST['data']);
	
	$data = json_decode($json, true);
	
	$date .= "";
	
	$query = "INSERT INTO `answers_data`(`user_id`, `rel_forms_questions_id`, `place_id`, `answer_type_id`, `value`, `date_time`)
VALUES ";
	$i=0;
	foreach( $data as $questionData )
	{
		$query .= "('" . $db->escape($questionData['user_id']) . "', '" . $db->escape($questionData['rel_id']) . "', '" . $db->escape($questionData['place_id']) . "', '" . $db->escape($questionData['type_id']) . "', '" . $db->escape($questionData['value']) . "', '" . $date . "')";
		$i++;
		if( $i != count($data) )
		{
			$query .= ",
";
		}
	}
	
	
	$myFile = "gay.txt";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $query . "");
	fclose($fh);
	
	$db->query($query);
	
	if( $db->error() != null )
	{
		$response["status"] = 0;
		$response["message"] = $db->error();
	}
	else
	{
		$response["status"] = 1;
	}
}
else
{
	$response["status"] = 0;
}

echo json_safe($response);