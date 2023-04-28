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
				'label' => 'File surat',
				'rules' => [
					'uploaded[file_surat]',
					'max_size[file_surat,10240]',
					'mime_in[file_surat,application/pdf]'
				],
				'errors' => [
					'max_size' => 'Ukuran file melebihi batas yang diperbolehkan (Maks. 10 MB)',
					'mime_in' => 'Jenis file surat tidak valid!',
					'uploaded' => 'File dokumen harus ada!'
				]
			],
			'file_lampiran' => [
				'label' => 'File lampiran',
				'rules' => [
					'max_size[file_lampiran,10240]',
					'mime_in[file_lampiran,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
				],
				'errors' => [
					'max_size' => 'Ukuran file melebihi batas yang diperbolehkan (Maks. 10 MB)',
					'mime_in' => 'Jenis file tidak valid!'
				]
			],
			'tujuan_dokumen' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Tujuan dokumen harus ada!'
				]
			],
			'nomor_dokumen' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nomor dokumen harus ada!'
				]
			],
			'perihal' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Perihal dokumen harus ada!'
				]
			],
			'sub_asal_dokumen' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Asal dokumen harus ada!'
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

	public function cek_inbox(){
		$list = $this->m_surat->cek_inbox();
		return json_encode($list);
	}

	public function cek_disposisi(){
		$list = $this->m_surat->cek_disposisi();
		return json_encode($this->m_surat->cek_disposisi());
	}		//var_dump($data[0]); die();

	public function cek_unread(){
		return (count($this->m_surat->cek_unread()));
	}

	public function baca_surat($id_surat){
		$data = ($this->m_surat->baca_surat($id_surat));
		//var_dump($data); die();
		return view('read_mail', $data);
	}

}
