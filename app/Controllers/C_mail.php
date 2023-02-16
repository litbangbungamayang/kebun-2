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

	public function getSubAsalDokumen(){
		$id_asal = $this->request->getGet('id_asal');
		$request = array('id_asal'=>$id_asal);
		return json_encode($this->m_surat->getSubAsalDokumen($request));
	}

	public function getTujuanDokumen(){
		return json_encode($this->m_surat->getTujuanDokumen());
	}

	public function new_mail(){
		$validation_rules = [
			'file_surat' => [
				'label' => 'Document',
				'rules' => [
					'uploaded[file_surat]',
					'max_size[file_surat,10240]',
					'mime_in[file_surat,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
				],
				'errors' => [
					'max_size' => 'Ukuran file melebihi batas yang diperbolehkan (Maks. 10 MB)',
					'mime_in' => 'Jenis file tidak valid!'
				]
			]
		];
		
		if (!$this->validate($validation_rules)){
			$data = ['errors' => $this->validator->getErrors()];
			return view('upload_mail', $data);
		} else {
			return $this->m_surat->new_mail($this->request);
		}
	}

}
