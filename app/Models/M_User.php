<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model{

  public function __construct(){
    $this->db = db_connect();
    $this->builder = $this->db->table('tbl_kantor_user');
  }

  public function tes(){
    echo "OK";
  }

  public function verify($request){
    $uname = $request->getVar('uname');
		$pwd = md5($request->getVar('pwd'));
		$salted = $uname.$pwd;
		$hashed = hash('sha256', $salted);
    //return $this->builder->getWhere(['username'=>$uname,'password'=>$hashed])->getRowArray();
    $sql = 'select * from tbl_kantor_user usr 
      join tbl_kantor_pegawai peg on usr.id_pegawai = peg.id_pegawai 
      join tbl_kantor_jabatan jab on jab.id_jabatan = peg.id_jabatan 
      join tbl_sub_divisi subdiv on peg.id_sub_divisi = subdiv.id_sub_divisi 
      join tbl_divisi divi on divi.id_divisi = subdiv.id_divisi 
      join tbl_unit unit on unit.no = divi.id_unit
    where username = ? and password = ?';
    return $this->db->query($sql,[$uname, $hashed])->getRowArray();
  }

}
