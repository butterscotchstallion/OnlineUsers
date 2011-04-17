<?php 
/**
 * Worst Way Possible - A Practical Programmer's Guide: Simple Steps to better code
 * "Online Users" 
 * Released Apr 16 2011
 * http://prgmrbill.com
 * @author PrgmrBill <hi@prgmrbill.com>
 * @description - Online Users 
 *
 */
class User
{
	// The PDO connection that is used
	private $connection;
    
    // Number of minutes a user is considered active
    // Ex: if user was seen in last 5 minutes they are 
    // considered 'online'
	private $seenThreshold = 5;
    
    // @param resource $connection - db connection
	public function __construct($connection)
	{
		$this->connection = $connection;
	}
	
    // @param string $sessionID - session_id of user
    // @param string $userAgent - user agent of browser
    public function Update($sessionID, $userAgent)
    {
        try
		{
            // Add to user table. If this sessionID is
            // in the table already, then update it.
			$q = "INSERT INTO user(user_session_id, 
                                   user_last_seen,
                                   user_agent)
                  VALUES(:sessionID, NOW(), :userAgent)
                  ON DUPLICATE KEY
                  UPDATE user_session_id = :sessionID,
                         user_last_seen = NOW()";
			$stmt = $this->connection->prepare($q);
			$stmt->execute(array(':sessionID' => $sessionID,
                                 ':userAgent' => $userAgent,
                                 ':sessionID' => $sessionID));
            return $stmt->rowCount() > 0;
		}
		catch(PDOException $e)
		{
			echo sprintf("Error message: %s - Code: %d", $e->getMessage(), $e->getCode());
			return false;
		}
    }
    
	public function FetchOnlineUsers()
	{
		try
		{
			$q = "SELECT u.user_id AS userID,
                         u.user_session_id AS sessionID,
                         u.user_last_seen AS lastSeen,
                         u.user_agent AS userAgent
                  FROM user u
                  WHERE u.user_last_seen > DATE_SUB(NOW(), INTERVAL :seenThreshold MINUTE) AND NOW()";

			$stmt = $this->connection->prepare($q);
			$stmt->execute(array(':seenThreshold' => intval($this->seenThreshold)));
            $users = $stmt->FetchAll(PDO::FETCH_OBJ);
			return $users;
		}
		catch(PDOException $e)
		{
			echo sprintf("Error message: %s - Code: %d", $e->getMessage(), $e->getCode());
			return false;
		}
	}
}