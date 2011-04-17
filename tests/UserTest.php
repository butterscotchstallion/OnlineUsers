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
session_start();
require '../lib/config.php';
require '../lib/User.class.php';

class UserTest extends PHPUnit_Framework_TestCase
{
	// @covers User::FetchOnlineUsers
	public function testFetchOnlineUsers()
	{
		$connection    = GetConnection();
		$u             = new User($connection);
        
        // Add us
		$updateSuccess = $u->Update(session_id(), 'Testing with PHPUnit!');
        $this->assertTrue($updateSuccess);
        
        // Verify we made it in
<<<<<<< HEAD
        $users           = $u->FetchOnlineUsers();
        $userResultCount = count($users);
=======
        $users = $u->FetchOnlineUsers();
        var_dump($users);
        var_dump(count($users));
>>>>>>> bae3c9b65d6f60abf933382a27bb94149f3abc50
        $this->assertType('array', $users);
        
        // count returns false if it's 0
        $this->assertTrue($userResultCount);
	}
}



