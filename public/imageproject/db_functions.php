<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
		if(file_exists('mysql.class.php'))
			require_once('mysql.class.php');
		  
		if(file_exists('database.php'))
			require_once('database.php');
		  
		if(file_exists('error_messages.php'))
			require_once('error_messages.php');
		  
		$this->db = new MySQL(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */

 
    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = $this->db->query("SELECT * FROM users");
        return $result;
    }
	
	public function getAllPlaces() {
		$result = $this->db->query("SELECT  `id` ,  `name` ,  `address` ,  `lat` ,  `lng` ,  `place_class` 
						FROM  `places` WHERE 1 ORDER BY  `place_class` ,  `name` ");
		return $result;
	}
	
	public function insertNewTask($userId, $placeId) {
		$this->db->query("INSERT INTO tasks (user_id, place_id, date_added) VALUES ( '" .$userId. "', '" .$placeId. "', now() )");
	}
 
	public function getLasInsertedId() {
		return $this->db->last_id();
	}
	
	public function getAllPlacesForReview() {
		$result = $this->db->query("SELECT * FROM places_for_review");
		return $result;
	}
}
 
?>