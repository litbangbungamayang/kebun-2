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

	public function dispo_baru(){
		$requestData = json_decode($this->request->getPost('formData'));
		if(is_array($requestData) || is_object($requestData)){
			if($this->m_surat->tambah_disposisi($requestData) === "SUCCESS"){
				return json_encode("SUCCESS");
			}
		}
	}

	public function cek_inbox(){
		$list = $this->m_surat->cek_inbox();
		return json_encode($list);
	}

	public function cek_disposisi(){
		$list = $this->m_surat->cek_disposisi();
		return json_encode($this->m_surat->cek_disposisi());
	}		

	public function cek_unread(){
		return (count($this->m_surat->cek_unread()));
	}

	public function baca_surat($id_surat, $data = null){
		if($this->session->has('username') == true){
			$data['errors'] = $data['errors'];
			$data['result_surat'] = $this->m_surat->baca_surat($id_surat);
			$data['disposisi'] = $this->m_surat->get_disposisi($id_surat);
			return view('read_mail', $data);
		} else {
			return redirect('login');
		}
	}

	public function baca_disposisi($id_disposisi){
		if ($this->session->has('username') == true){
			$data['errors'] = $data['errors'];
			$data['result_dispo'] = $this->m_surat->get_disposisi_user($id_disposisi);
			$data_dispo_turun = array(
				"id_surat" => $data['result_dispo'][0]['id_surat'],
				"id_pegawai" => session('id_pegawai')
			);
			$data['result_dispo_turun'] = $this->m_surat->get_disposisi_turun($data_dispo_turun);
			return view('read_disposisi', $data);
		} else {
			return redirect('login');
		}
	}

	public function set_mail_status(){
		//request parameter : [id_surat][status]
		if($this->m_surat->set_mail_status($this->request->getPost())){
			$unread = $this->m_surat->cek_unread();
			$this->session->set('inbox_count', $unread);
			return json_encode($unread);
		}
	}

	public function set_dispo_status(){
		//request parameter : [id_disposisi][status]
		if($this->m_surat->set_dispo_status($this->request->getPost())){
			$unread = $this->m_surat->cek_unread();
			$this->session->set('inbox_count', $unread);
			return json_encode($unread);
		}
	}

	public function lihat_surat(){
		$path_surat = base_url("writable/uploads/".$this->request->getGet('path'));
		$data = array(
			"path_surat"=>$path_surat
		);
		return view('view_docs', $data);
	}

	public function tujuan_disposisi(){
		$request = array(
			"level_jabatan"=>$this->request->getGet("level_jabatan"),
			"unit"=>$this->request->getGet("unit"),
			"id_divisi" => $this->request->getGet("id_divisi")
		);
		$list = $this->m_surat->tujuan_disposisi($request);
		return json_encode($list);
	}

	public function list_disposisi(){
		return json_encode($this->m_surat->list_disposisi());
	}

}
