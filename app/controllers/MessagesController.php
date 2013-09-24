<?php

class MessagesController extends BaseController {
	
	public $restful = true;
	
	public function get_index() {
		
		return View::make('dashboard.index');
		
	}
	
}