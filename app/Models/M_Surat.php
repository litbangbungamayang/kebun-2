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
    $id_module = $request('id_module');
  }

  public function getAsalDokumen(){
    $sql = 'select * from tbl_kantor_asal_dokumen';
    return ($this->db->query($sql)->getResultArray());
  }

}
