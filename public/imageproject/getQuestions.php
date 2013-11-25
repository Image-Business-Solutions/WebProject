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

if(file_exists('mysql.class.php'))
	require_once('mysql.class.php');
  
if(file_exists('database.php'))
	require_once('database.php');
  
if(file_exists('error_messages.php'))
	require_once('error_messages.php');
  
$db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

if( isset( $_POST['product_id'] ) )
{
	$result = $db->query("SELECT  `questions`.`id`, `questions`.`question` ,  `answer_types`.`type` ,
		`answer_options`.`value`, `rel_forms_questions`.`answer_type_id` as `type_id`, `rel_forms_questions`.`id` as `rel_id`
							FROM `rel_forms_questions` 
							LEFT JOIN  `answer_options` ON  `answer_options`.`rel_forms_questions_id` =  `rel_forms_questions`.`id` 
							LEFT JOIN  `questions` ON  `rel_forms_questions`.`question_id` =  `questions`.`id` 
							LEFT JOIN  `answer_types` ON  `answer_types`.`id` =  `rel_forms_questions`.`answer_type_id` 
							WHERE  `rel_forms_questions`.`form_id` 
								IN (SELECT `forms`.`id` FROM `forms`, `forms_for_products`
									WHERE `forms`.`id` = `forms_for_products`.`form_id` 
									AND `forms_for_products`.`product_id` = " . $db->escape($_POST['product_id']) . " )");
}
else if(isset( $_POST['category_id'] ))
	{
		$result = $db->query("SELECT  `questions`.`id`, `questions`.`question` ,  `answer_types`.`type` ,
		`answer_options`.`value`, `rel_forms_questions`.`answer_type_id` as `type_id`, `rel_forms_questions`.`id` as `rel_id`
								FROM `rel_forms_questions` 
								LEFT JOIN  `answer_options` ON  `answer_options`.`rel_forms_questions_id` =  `rel_forms_questions`.`id` 
								LEFT JOIN  `questions` ON  `rel_forms_questions`.`question_id` =  `questions`.`id` 
								LEFT JOIN  `answer_types` ON  `answer_types`.`id` =  `rel_forms_questions`.`answer_type_id` 
								WHERE  `rel_forms_questions`.`form_id` 
									IN (SELECT `forms`.`id` FROM `forms`, `forms_for_categories`
										WHERE `forms`.`id` = `forms_for_categories`.`form_id` 
										AND `forms_for_categories`.`category_id` = " . $db->escape($_POST['category_id']) . " )");
	}
	else exit(1);

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
}

echo json_safe($response);