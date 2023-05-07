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
    $file_uploaded = $request->getFiles();
    $file_surat = $file_uploaded['file_surat'];
    $file_lampiran = $file_uploaded['file_lampiran'];
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
    $query_entri_baru = 'insert into tbl_kantor_dokumen_masuk (
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
      upload_by) values (
        :jns_dokumen:, :id_sub_asal_dokumen:, :tujuan_dokumen:, :nomor_dokumen:, :perihal:, :tgl_dokumen:, :tgl_diterima:, :status_dokumen:, :kategori_dokumen:, :sifat_dokumen:, :upload_by:)';
    $msg = ($this->db->query($query_entri_baru, $entri_baru));
    $id_dokumen_masuk = ($this->db->insertID());

    /*-------- ENTRI FILE SURAT -----------*/
    $path_surat = [];
    $entri_surat = [];
    foreach ($file_surat as $surat) {
      if ($surat->isValid() && !$surat->hasMoved()){
        $nama_awal = $surat->getClientName();
        $nama_baru = $surat->store();
        //$path_surat[] = array('nama_awal'=>$nama_awal, 'nama_baru'=>$nama_baru);
        $entri_surat = array(
          'id_surat'=>$id_dokumen_masuk,
          'jenis'=>"surat",
          'path_surat'=>$nama_baru,
          'nama_awal'=>$nama_awal
        );
        $query_entri_file = 'insert into tbl_kantor_file_surat (id_surat,jenis,path_surat,nama_awal) values(:id_surat:,:jenis:,:path_surat:,:nama_awal:)';
        $msg_file = ($this->db->query($query_entri_file, $entri_surat));
      }
    }
    /*--------------------------------------*/
    /*-------- ENTRI FILE LAMPIRAN -----------*/
    $path_surat = [];
    $entri_lampiran = [];
    foreach ($file_lampiran as $surat) {
      if ($surat->isValid() && !$surat->hasMoved()){
        $nama_awal = $surat->getClientName();
        $nama_baru = $surat->store();
        //$path_surat[] = array('nama_awal'=>$nama_awal, 'nama_baru'=>$nama_baru);
        $entri_lampiran = array(
          'id_surat'=>$id_dokumen_masuk,
          'jenis'=>"lampiran",
          'path_surat'=>$nama_baru,
          'nama_awal'=>$nama_awal
        );
        $query_entri_lampiran = 'insert into tbl_kantor_file_surat (id_surat,jenis,path_surat,nama_awal) values(:id_surat:,:jenis:,:path_surat:,:nama_awal:)';
        $msg_lampiran = ($this->db->query($query_entri_lampiran, $entri_lampiran));
      }
    }
    /*----------------------------------------------------*/
    if ($this->db->transStatus() === false){
      session()->setFlashdata('entri_error', 'Entri gagal');
      return redirect()->route('upload_surat');
    } else {
      $this->db->transCommit();
      session()->setFlashdata('entri_msg', 'Entri sukses');
      return redirect()->route('upload_surat');
    }
    /*----------------------------------------------------*/
  }

  public function cek_inbox(){
    $id_pegawai = session('id_pegawai');
    $sql = "select * from tbl_kantor_dokumen_masuk smasuk 
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = smasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen 
      where smasuk.tujuan_dokumen = ? order by smasuk.status_dokumen asc, smasuk.tgl_diterima asc";
    return $this->db->query($sql, array($id_pegawai))->getResultArray();
  }

  public function cek_disposisi(){
    $id_pegawai = session('id_pegawai');
    $sql = "select * from tbl_kantor_disposisi dispo
      join tbl_kantor_dokumen_masuk dmasuk on dmasuk.id_surat = dispo.id_surat
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = dmasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen
      where id_pegawai_tujuan = ? order by status_disposisi, tgl_kirim_disposisi";
    return ($this->db->query($sql, array($id_pegawai))->getResultArray());
  }

  public function cek_unread(){
    $id_pegawai = session('id_pegawai');
    $sql = "select count(*) as jml from tbl_kantor_dokumen_masuk smasuk 
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = smasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen 
      where smasuk.tujuan_dokumen = ? and smasuk.status_dokumen = 1";
    $surat_unread = $this->db->query($sql, array($id_pegawai))->getResultArray();
    $sql_dispo = "select count(*) as jml from tbl_kantor_disposisi dispo
      join tbl_kantor_dokumen_masuk dmasuk on dmasuk.id_surat = dispo.id_surat
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = dmasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen
      where id_pegawai_tujuan = ? and dispo.status_disposisi = 1 order by status_disposisi, tgl_kirim_disposisi";
    $dispo_unread = $this->db->query($sql_dispo, array($id_pegawai))->getResultArray();
    $surat_unread = (int)$surat_unread[0]['jml'];
    $dispo_unread = (int)$dispo_unread[0]['jml'];
    return $surat_unread + $dispo_unread;
  }

  public function baca_surat($id_surat){
    $sql = "select * from tbl_kantor_dokumen_masuk smasuk 
      join tbl_kantor_sub_asal_dokumen subasal on subasal.id_sub_asal = smasuk.id_sub_asal_dokumen 
      join tbl_kantor_asal_dokumen asal on asal.id_asal_dokumen = subasal.id_asal_dokumen 
      join tbl_kantor_file_surat file_surat on file_surat.id_surat = smasuk.id_surat
      where smasuk.id_surat = ?";
    return ($this->db->query($sql, array($id_surat))->getResultArray());
  }

  public function get_disposisi($id_surat){
    $sql = "select * from tbl_kantor_dokumen_masuk dokmasuk join tbl_kantor_disposisi dispo on dokmasuk.id_surat = dispo.id_surat where dokmasuk.id_surat = ?";
    return $this->db->query($sql, [$id_surat])->getResultArray();
  }

  public function tujuan_disposisi($request){
    $sql = "select *, upper(concat(peg.nm_pegawai,'-',jab.nm_jabatan,' ',divisi.nm_divisi)) as label_opsi from tbl_kantor_pegawai peg join tbl_kantor_jabatan jab on peg.id_jabatan = jab.id_jabatan join tbl_sub_divisi subdiv on subdiv.id_sub_divisi = peg.id_sub_divisi join tbl_divisi divisi on divisi.id_divisi = subdiv.id_divisi join tbl_unit unit_kerja on unit_kerja.no = divisi.id_unit where jab.level_jabatan = :level_jabatan: and unit_kerja.no = :unit:";
    return($this->db->query($sql, $request)->getResultArray());
  }

  public function list_disposisi(){
    $sql = "select * from tbl_kantor_list_disposisi";
    return ($this->db->query($sql)->getResultArray());
  }

  public function tambah_disposisi($request){
    $this->db->transBegin();
    $id_surat = 0;
    foreach($request as $key => $itemReq){
      $query_dispo = "insert into tbl_kantor_disposisi (id_surat, id_pegawai, id_pegawai_tujuan, status_disposisi, disposisi_surat, catatan_disposisi) values(:id_surat:, :id_pegawai:, :id_pegawai_tujuan:, :status_disposisi:, :disposisi_surat:, :catatan_disposisi:)";
      $entri_dispo = array(
        "id_surat" => $itemReq->id_surat,
        "id_pegawai" => session("id_pegawai"),
        "id_pegawai_tujuan" => $itemReq->tujuan_dispo,
        "status_disposisi" => 1,
        "disposisi_surat" => $itemReq->dispo,
        "catatan_disposisi" => $itemReq->catatan_dispo
      );
      $id_surat = $itemReq->id_surat;
      $this->db->query($query_dispo, $entri_dispo);
    }   
    if ($this->db->transStatus() === false){
      session()->setFlashdata('entri_error', 'Entri gagal');
      return "FAILED";
    } else {
      $this->db->transCommit();
      session()->setFlashdata('entri_msg', 'Entri sukses');
      $status_dispo = array(
        "id_surat" => $id_surat,
        "status" => 3
      );
      $this->set_mail_status($status_dispo);
      return "SUCCESS";
    }
  }

  public function set_mail_status($request){
    //parameter : [id_surat][status]
    $status_query = "update tbl_kantor_dokumen_masuk set status_dokumen = :status: where id_surat = :id_surat:";
    return ($this->db->query($status_query, $request));
  }

}
