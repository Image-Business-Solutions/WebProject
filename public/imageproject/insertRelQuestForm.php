<?php
	/*
	$query = "INSERT INTO `rel_forms_questions`(`form_id`, `question_id`, `answer_type_id`)
	VALUES ";
	for($i = 36 ; $i <= 61 ; $i++ )
	{
		$query .= "($i,2,4),";
		$query .= "($i,3,3),";
		$query .= "($i,4,1),";
		$query .= "($i,5,3),";
		$query .= "($i,6,1)";
		if( $i != 61 )
		{
			$query .= ",";
		}
	}
	*/
	if(file_exists('mysql.class.php'))
		require_once('mysql.class.php');
	
	if(file_exists('database.php'))
		require_once('database.php');
		
	$db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

	$query = "SELECT `id` FROM `rel_forms_questions` WHERE `answer_type_id` = 4";
	$result = $db->query($query);
	
	$query = "INSERT INTO `answer_options`(`value`, `rel_forms_questions_id`) 
	VALUES ";
	$i=0;
	while( ($row = $db->fetch_assoc($result)) != false )
	{
		$query .= "('30%'," . $row['id'] . "),";
		$query .= "('10%'," . $row['id'] . "),";
		$query .= "('0%'," . $row['id'] . "),";
		$query .= "('-10%'," . $row['id'] . "),";
		$query .= "('-20%'," . $row['id'] . "),";
		$query .= "('-30%'," . $row['id'] . ")";
		$i++;
		if($db->num_rows($result) != $i)
		{
			$query .= ",";
		}
	}
	
	$db->query($query);
	
	echo $db->error();