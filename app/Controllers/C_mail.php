<?php

namespace App\Controllers;

use Config\Services;

class C_mail extends BaseController
{
	public function cekRole($request){
		return $this->m_user->cekRole(array($request));
	}

	public function presensi(){
		//module_id = 1
		if ($this->session->has('username') == true){
			return view('presensi');
		} else {
			return redirect('login');
		}
	}

	public function getAsalDokumen(){
		return json_encode($this->m_surat->getAsalDokumen());
	}

}
