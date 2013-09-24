<?php

class Dashboard extends Eloquent {
	
	public static $rules_pm = array(
		'message' => 'required|min:2|max:500'	
	);
	
	
	
	public static $rules_signup = array(
			'username' => 'Required|Min:3|Max:20|Alpha',
			'email' => 'Required|Between:6,50|Email|Unique:users',
			'password' => 'Required|AlphaNum|Between:6,20|Confirmed',
			'password_confirmation' => 'Required|AlphaNum|Between:6,20'
	 );
	
	
	
	public static function validate_pm($data) {
		
		return Validator::make($data, static::$rules_pm);
		
	}
	
	
	
	public static function validate_signup($data) {
	
		return Validator::make($data, static::$rules_signup);
	
	}
	
	
	protected static function getAllUsersMessages() {
		
	$messages = DB::table('messages')->where('recipient_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
	
	return $messages;
	}
	
	
	protected static function getSender() {
	
	$sender = DB::table('users')->where('id', Input::get('recipient'))->first();

	
	return $sender;
	
	}
	
	
	protected static function initOnline() {
	
		$online = App::make('SentryUsersOnline');
	
		return $online;
	}
	
	
	
	protected static function getUser() {
	
		$user = DB::table('users')->where('id', Input::get('recipient'))->first();
	
		return $user;
	
	}
	
	
	
	protected static function msg_Status($status) {
		
		if ($status == 'ok') {
			$view = '<div class="alert alert-success">Your message was sent!</div>';
			
		} elseif ($status == 'failed') {
			$view = '<div class="alert alert-error">Message is too short.</div>';
		}
		
		return $view;
		
	}
	
	
	
	
protected static function getMsgSender($user) {	
	$sender = DB::table('users')->where('id', $user)->first();
	return $sender;
}


} 