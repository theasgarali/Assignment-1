<?php

namespace OOP\Classes;

// Observer pattern - splObserver. If login fails, send an email to the admin email.

class FailureMail implements \SplObserver{

	public function  update($observable) // means the LoginSubject
    {
        $user = $observable->user; //assigned at line 47 and line 59 of LoginSubject.php

        $auth = new Auth(); // initialise a Auth(see Auth.php) instance, to write the login logs(write to database)

        if(isset($user['fail'])){
			//write failure auth logs to the database.
			$auth->write_login($user['failure email'], Auth:: STATUS_FAIL);

			//send an email alert to the admin of the site as log in has failed.
			$to_email = 'moviesite@outlook.com';
            $subject = 'Checking user log ins';
            $message = 'Log in has failed';
            $headers = 'From: '.ADMIN_EMAIL;
            mail($to_email,$subject,$message,$headers);
        }
        else {
        	//write success auth log to the database.
			$auth->write_login($user['email'], Auth:: STATUS_SUCCESS);
		}
    }
}