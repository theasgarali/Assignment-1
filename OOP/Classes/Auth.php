<?php

namespace OOP\Classes;

// Authorisation (Auth) of users of the site. All classes that operates with db inherite DbConnection BASE class.
class Auth extends DbConnection
{
	const STATUS_SUCCESS = 1;
	const STATUS_FAIL = 2;

	//status description
	public static $statuses = [
		self:: STATUS_SUCCESS => 'success',
		self:: STATUS_FAIL => 'fail',
	];

	// This function checks the User status - whether logged in or not.
    public static function check(){
        if (isset($_SESSION['user'])) {
            return true;
        }    
        return false;
	}
	
    // This function checks the User Type if User type is Admin, it returns true else return false.
    public static function isAdmin(){
        if (isset($_SESSION['user']) && $_SESSION['type'] == 'admin') {
            return true;
        }
            
        return false;
    }

	//This function checks the login details of the user with the database data. If system found user data in database, it returns true else return false.
    public function check_login($email, $password) {

    	//get row
    	$row = $this->findOne(
    		"Select * from users where email=:email and password=:password",
			['email'=>$email, 'password'=>$password]
		);

        if ($row) {
            $_SESSION['user'] = $row['id'];
            $_SESSION['type'] = $row['type'];

            return $row;
        } else { 
            return false;  
        }
    }

	// This function is used to clear user session while logging out.
    public static function logout() {  
        $_SESSION['user'] = false;
        session_destroy();
    }
 
	// This function is used to insert new user data to database. This function is called when new user registers with the site to save data.
	public function signup($name, $email, $password){

    	//inset user data
    	$this->execute(
    		"INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'user')",
			['name'=>$name, 'email'=>$email, 'password'=>$password]
		);
	}

	// Check the email within database. If provided email is already in database, it returns true, else returns false.
    public function is_email($email){

    	//return user data, if it exists
    	return $this->findOne(
    		"Select * from users where email=:email",
			['email'=>$email]
		);
    }

	//Each time user successfully logs in, system will save login information to database.
	public function write_login($email, $status)
	{
		$this->execute(
			"INSERT INTO `auth_history` (`email`, `time`, `status`) VALUES (:email, :time, :status)",
			['email'=>$email, 'time'=>time(), 'status'=>$status]
		);
	}

	public function read_logins($limit=100) {

		//return history
		return $this->findAll(
			"SELECT * FROM `auth_history` ORDER BY `id` DESC LIMIT $limit"
		);
	}
}