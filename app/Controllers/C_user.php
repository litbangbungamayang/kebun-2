<?php

namespace App\Controllers;

use Config\Services;

class C_user extends BaseController
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

	public function cekLokasi(){
		$lat = $this->request->getGet('lat');
		$lon = $this->request->getGet('lon');
		$acc = $this->request->getGet('acc');
		$dl = $this->request->getGet('dl');
		return json_encode($this->m_user->cekLokasi(array('lat'=>$lat, 'lon'=>$lon, 'kdunit'=>session('kd_unit'), 'acc'=>$acc, 'dl'=>$dl)));
	}

	public function cekPresensi(){
		$id_pegawai = session('id_pegawai');
		$tgl_absen = date('Y-m-d');
		$request = array(
			'id_pegawai'=>$id_pegawai,
			'tgl_absen'=>$tgl_absen
		);
		return json_encode($this->m_user->cekPresensi($request));
	}
}
