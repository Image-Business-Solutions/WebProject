<?php
class DatabaseException extends Exception
{
}

class DatabaseConnection extends Mysqli
{
    public function __construct($database = "") {

		if( file_exists("database.cfg") )
		{
			require_once("database.cfg");
		}
	
        parent::__construct($HOST, $USER, $PASSWORD, $database, $PORT, $SOCKET);

        $this->throwConnectionExceptionOnConnectionError();
    }

    private function throwConnectionExceptionOnConnectionError() {

        if (!$this->connect_error) return;

        $message = sprintf('(%s) %s', $this->connect_errno, $this->connect_error);

        throw new DatabaseException($message);
    }
	
    public function getResult($query) {
		$statement = $this->query($query);
        $statement->execute();
        $statement->bind_result($result);
        $statement->fetch();
        $statement->close();
        return $result;
    }
	
}