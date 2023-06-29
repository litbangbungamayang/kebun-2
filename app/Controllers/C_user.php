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

	public function inbox(){
		if ($this->session->has('username') == true){
			$unread = $this->m_surat->cek_unread();
			$this->session->set('inbox_count', $unread);
			return view('inbox');
		} else {
			return redirect('login');
		}
	}

	public function inbox_list(){
		if ($this->session->has('username') == true){
			return view('inbox_list');
		} else {
			return redirect('login');
		}
	}

	public function upload_mail(){
		if ($this->session->has('username') == true){
			return view('upload_mail');
		} else {
			return redirect('login');
		}
	}

	public function profil(){
		if($this->session->has('username') == true){
			return view('profil');
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
?>