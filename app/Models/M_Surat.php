<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Surat extends Model{

  public function __construct(){
    $this->db = db_connect();
    $this->builder = $this->db->table('tbl_kantor_user');
  }

  public function cekRole($request){
    $username = session('username');
    $id_module = $request['id_module'];
  }

  public function getAsalDokumen(){
    $sql = 'select * from tbl_kantor_asal_dokumen';
    return ($this->db->query($sql)->getResultArray());
  }

  public function getSubAsalDokumen($request){
    $sql = 'select * from tbl_kantor_sub_asal_dokumen where id_asal_dokumen = ?';
    return ($this->db->query($sql, array($request['id_asal']))->getResultArray());
  }

  public function getTujuanDokumen(){
    $kode_unit = session('kd_unit');
    $req_probis = 'tujuan_surat_'.$kode_unit;
    $sql = "select *, concat(nm_pegawai, ' - ', nm_jabatan) as opsi 
      from tbl_kantor_pegawai peg
      join tbl_kantor_jabatan jab on jab.id_jabatan = peg.id_jabatan 
      join tbl_sub_divisi subdiv on subdiv.id_sub_divisi = peg.id_sub_divisi
      join tbl_divisi divi on divi.id_divisi = subdiv.id_divisi
      join tbl_kantor_probis probis on jab.level_jabatan = probis.nilai 
      where probis.nm_probis = ?";
    return ($this->db->query($sql, array($req_probis))->getResultArray());
  }

  public function new_mail($request){
    $jns_dokumen = $request->getVar('jns_dokumen');
    $sub_asal_dokumen = $request->getVar('sub_asal_dokumen');
    $tujuan_dokumen = $request->getVar('tujuan_dokumen');
    $nomor_dokumen = $request->getVar('nomor_dokumen');
    $perihal = $request->getVar('perihal');
    $tgl_dokumen = $request->getVar('tgl_dokumen');
    $tgl_diterima = $request->getVar('tgl_diterima');
    $status_dokumen = '1';
    $sifat_dokumen = 'BIASA'; //BIASA-SEGERA-PENTING
    $kategori_dokumen = 'UMUM'; //UMUM-RAHASIA
    $file_surat = $request->getFiles();
    $file_surat = $file_surat['file_surat'];
    $id_pegawai = session('id_pegawai');
    $entri_baru = array(
      'jns_dokumen'=>$jns_dokumen,
      'id_sub_asal_dokumen'=>$sub_asal_dokumen,
      'tujuan_dokumen'=>$tujuan_dokumen,
      'nomor_dokumen'=>$nomor_dokumen,
      'perihal'=>$perihal,
      'tgl_dokumen'=>$tgl_dokumen,
      'tgl_diterima'=>$tgl_diterima,
      'status_dokumen'=>$status_dokumen,
      'kategori_dokumen'=>$kategori_dokumen,
      'sifat_dokumen'=>$sifat_dokumen,
      'upload_by'=>$id_pegawai
    );
    /*--------------- DB TRANSACTIONS --------------------*/
    $this->db->transBegin();
    $query_entri_baru = 'insert into tbl_kantor_surat_masuk (
      jenis_dokumen,
      id_sub_asal_dokumen,
      tujuan_dokumen,
      nomor_dokumen,
      perihal_dokumen,
      tgl_dokumen,
      tgl_diterima,
      status_dokumen,
      kategori_dokumen,
      sifat_dokumen,
      upload_by) values (?,?,?,?,?,?,?,?,?,?,?)';
    //var_dump($entri_baru);
    //nggak tau kenapa kok nggak bisa di-insert langsung pake array $entri_baru, bangke!
    $msg = ($this->db->query($query_entri_baru, array(
      $entri_baru['jns_dokumen'],
      $entri_baru['id_sub_asal_dokumen'],
      $entri_baru['tujuan_dokumen'],
      $entri_baru['nomor_dokumen'],
      $entri_baru['perihal'],
      $entri_baru['tgl_dokumen'],
      $entri_baru['tgl_diterima'],
      $entri_baru['status_dokumen'],
      $entri_baru['kategori_dokumen'],
      $entri_baru['sifat_dokumen'],
      $entri_baru['upload_by']
    )));
    $id_dokumen_masuk = ($this->db->insertID());

    /*-------- ENTRI FILE SURAT -----------*/
    $path_surat = [];
    foreach ($file_surat as $surat) {
      if ($surat->isValid() && !$surat->hasMoved()){
        $nama_awal = $surat->getClientName();
        $nama_baru = $surat->store();
        //$path_surat[] = array('nama_awal'=>$nama_awal, 'nama_baru'=>$nama_baru);
        $entri_surat = array(
          'id_surat'=>$id_dokumen_masuk,
          'path_surat'=>$nama_baru,
          'nama_awal'=>$nama_awal
        );
        $query_entri_file = 'insert into tbl_kantor_file_surat (id_surat,path_surat,nama_awal) values(?,?,?)';
        $msg_file = ($this->db->query($query_entri_file, array(
          $entri_surat['id_surat'],
          $entri_surat['path_surat'],
          $entri_surat['nama_awal']
        )));
      }
    }
    /*--------------------------------------*/
    if ($this->db->transStatus() === false){
      echo 'Eror entri data!';
      var_dump($msg);
      var_dump($msg_file);
    } else {
      $this->db->transCommit();
      session()->setFlashdata('entri_msg','Entri sukses');
      return redirect()->route('upload_surat');
    }
    /*----------------------------------------------------*/
  }

  public function cek_inbox(){
    $id_pegawai = session('id_pegawai');
    $sql = "select * from tbl_kantor_surat_masuk smasuk 
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = smasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen 
      where smasuk.tujuan_dokumen = ? order by smasuk.status_dokumen asc, smasuk.tgl_diterima asc";
    return $this->db->query($sql, array($id_pegawai))->getResultArray();
  }

  public function cek_unread(){
    $id_pegawai = session('id_pegawai');
    $sql = "select * from tbl_kantor_surat_masuk smasuk 
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = smasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen 
      where smasuk.tujuan_dokumen = ? and smasuk.status_dokumen = 1";
    return $this->db->query($sql, array($id_pegawai))->getResultArray();
  }

}
