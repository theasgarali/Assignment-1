<?php


/*If login details are not matched to the database values, the class "createUser" is checking the details. 
If details are not matched it sends the failure message notifying that login attempted has failed.
If a user logs in, relative observers are invoked.*/

namespace OOP\Classes;

class LoginSubject implements \SplSubject
{
    // variable to save observers 
    private $observers = array();

    //a variable to save user state
    public $_user;

    //if user state is changed, It notify to observers and let them update. 
    public function notify()
    {
        foreach( $this->observers as $observer )
            $observer->update( $this );

    }

    //detach a observer from subject.
    public function detach( $observer )
    {
        $this->observers []= $observer; // an an observer to the observer subject.
    }

    //attach a observer from subject.
    public function attach( $observer )
    {
        $this->observers []= $observer;
    }

    //This is the IMPORTANT part where we change user state ie login event. subject notify to observer. 
    public function createUser($email, $pass)
    {
        // create auth instance
		$auth = new Auth();

		//try to check login
		if ($user = $auth->check_login($email, $pass)) {
			//it is OK, store user
			$this->user = $user;

			//notify state change to observers.
			$this->notify();

			return true;
		}
		else {
			//Here if there is no in database, change user state.
			$user['fail'] = 1;
			$user['failemail'] = $email;
			$user['failpassword'] = $pass;
			$this->user = $user;

			//notify state change to observers.
			$this->notify();

			return false;
		}
    }
}