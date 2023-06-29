<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if($this->session->has('username') == false){
			return redirect('login');
		} else {
			return view('dashboard');
		}
	}
}
