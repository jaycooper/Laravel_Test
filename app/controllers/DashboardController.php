<?php

class DashboardController extends BaseController {
	
	
public $restful = true;
	


public function get_index() {
		
		return View::make('dashboard.index');
		
	}
	
	

public function get_login() {
	
		return View::make('dashboard.login');
	
	}
	

public function post_login() {
	
		$userdata = array(
		  'email' => Input::get('email'),
		  'password' => Input::get('password')	
	    );
		
	if (Auth::attempt($userdata)) {
		
		return Redirect::to('dashboard');
		
	} else {
		
		  return Redirect::to('login')->with('login_e', true);
		  
	}
	
}


public function get_logout() {
	
	Auth::logout();
	return Redirect::to('login');
	
}



public function get_signup() {
	
	return View::make('dashboard.signup');
	
}



public function post_signup() {
	
	$validation = Dashboard::validate_signup(Input::all());
	
	if ($validation->fails()) {
		
		$messages = $validation->messages();
		
		return Redirect::to('signup')->with('errors', $messages);
		
	} else {
		 
	$userdata = array(
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => Hash::make(Input::get('password')),
			'last_ip' => Request::server('REMOTE_ADDR'),
			'last_browser' => Request::server('HTTP_USER_AGENT')
	         );
	
	$user = new User($userdata);
	$user->save();
	
	return Redirect::to('login?status=success');
	
	}
}
	
	

public function get_incoming() {
	
	return View::make('dashboard.incoming')
	->with('messages', Dashboard::getAllUsersMessages())
	->with('sender', Dashboard::getSender());
}



public function get_onlineusers() {

	return View::make('dashboard.onlineusers');
	
}



public function get_pm() {
	
	return View::make('dashboard.pm')->with('user', Dashboard::getUser());

}



public function post_pm() {
	
	$validation = Dashboard::validate_pm(Input::all());
        
        if ($validation->fails() && Input::get('recipient') > 0 ) {
        	
        	return Dashboard::msg_Status('failed');
        	
        } else {
        
		$userdata = array(
				'text' => Input::get('message'),
				'sender_id' => Auth::user()->id,
				'recipient_id' => Input::get('recipient')
		        );
		$user = new Message($userdata);
		$user->save();
		return Dashboard::msg_Status('ok');
        }
		
}
	
	
	
	
	
}