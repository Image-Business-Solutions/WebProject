<?php
if (isset($_GET["regId"])) {
    $regId = $_GET["regId"];
    $placeId = $_GET["places"];
	$userId = $_GET["userId"];
    include_once 'db_functions.php';
    $db = new DB_Functions();
	
	$db->insertNewTask($userId,$placeId);
	
    include_once './GCM.php';
     
    $gcm = new GCM();
 
    $registatoin_ids = array($regId);
    $message = array("taksId" => $db->getLasInsertedId());
    $result = $gcm->send_notification($registatoin_ids, $message);
 
    echo $result;
}
?>