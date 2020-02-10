<?php

namespace OOP\Classes;

// Observer pattern - Class implements splObserver. If login fails, send an email to the admin email.

class FailureMail implements \SplObserver{

	public function  update($observable)
    {
        $user = $observable->user;

        $auth = new Auth();

        if(isset($user['fail'])){

			//write fail auth log.
			$auth->write_login($user['failure email'], Auth:: STATUS_FAIL);

			//send an email.
			$to_email = 'moviesite@outlook.com';
            $subject = 'Checking user log ins';
            $message = 'Log in has failed';
            $headers = 'From: '.ADMIN_EMAIL;
            mail($to_email,$subject,$message,$headers);
        }
        else {
        	//write success auth log
			$auth->write_login($user['email'], Auth:: STATUS_SUCCESS);
		}
    }
}