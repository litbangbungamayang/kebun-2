<?php

namespace App\Controllers;

use Config\Services;

class C_login extends BaseController
{
	public function index()
	{
		return view('login');
	}

	public function logging_in()
	{	
		$rules = [
			'uname' => 'required',
			'pwd' => 'required|alpha_numeric'
		];
		$err_msg = [
			'uname' => [
				'required' => 'Username belum terisi!'
			],
			'pwd' => [
				'required' => 'Password belum terisi!'
			]
		];
		if(!$this->validate($rules, $err_msg
		)){
			$errors = $this->validation->getErrors();
			$str_errors = implode(", ", $errors);
			$this->session->setFlashdata('msg', $str_errors);
			return view('login');
		} else {
			$userdata = $this->m_user->verify($this->request);
			if($userdata === NULL){
				$this->session->setFlashdata('msg', "Username atau password salah!");
				return view('login');
			} else {
				$this->session->set($userdata);
				return view('dashboard');
			}
		}
	}
}
