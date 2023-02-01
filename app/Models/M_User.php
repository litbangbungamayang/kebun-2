<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model{

  public function __construct(){
    $this->db = db_connect();
    $this->builder = $this->db->table('tbl_kantor_user');
  }

  public function testing($posisi){
    //var_dump($posisi); die();
    return $posisi['kdunit'];
  }

  public function verify($request){
    $uname = $request->getVar('uname');
		$pwd = md5($request->getVar('pwd'));
		$salted = $uname.$pwd;
		$hashed = hash('sha256', $salted);
    $sql = 'select * from tbl_kantor_user usr 
      join tbl_kantor_pegawai peg on usr.id_pegawai = peg.id_pegawai 
      join tbl_kantor_jabatan jab on jab.id_jabatan = peg.id_jabatan 
      join tbl_sub_divisi subdiv on peg.id_sub_divisi = subdiv.id_sub_divisi 
      join tbl_divisi divi on divi.id_divisi = subdiv.id_divisi 
      join tbl_unit unit on unit.no = divi.id_unit
    where username = ? and password = ?';
    return $this->db->query($sql,[$uname, $hashed])->getRowArray();
  }

  public function cekPresensi($request){
    $sql = 'select * from tbl_kantor_presensi where id_pegawai = ? and tgl_presensi = ?';
    return $this->db->query($sql, [$request['id_pegawai'], $request['tgl_absen']])->getRowArray();
  }

  public function submitPresensi($posisi){
    $id_pegawai = session('id_pegawai');
    $tgl_absen = date('Y-m-d');
    $jam_skrg = date('H:i:s');
    $dl = $posisi['dl'];
    $presensi_result = $this->cekPresensi(array('id_pegawai'=>$id_pegawai, 'tgl_absen'=>$tgl_absen));
    if ($presensi_result === NULL){
      $sql = 'insert into tbl_kantor_presensi(id_pegawai, tgl_presensi, cek_in, actual_lat_in, actual_lon_in, gps_accuracy_in, status_dl) values(?,?,?,?,?,?,?)';
      return $this->db->query($sql, [$id_pegawai, $tgl_absen, $jam_skrg, $posisi['lat'], $posisi['lon'], $posisi['acc'], $dl]);
    } else {
      if($presensi_result !== NULL && $presensi_result['cek_in'] !== NULL && $presensi_result['cek_out'] === NULL){
        $sql = 'update tbl_kantor_presensi set cek_out = ?, actual_lat_out = ?, actual_lon_out = ?, gps_accuracy_out = ? 
          where id_pegawai = ? and tgl_presensi = ?';
        return $this->db->query($sql, [$jam_skrg, $posisi['lat'], $posisi['lon'], $posisi['acc'], $id_pegawai, $tgl_absen]);
      }
    }
  }

  public function getUnit($kdUnit){
    $sql = 'select * from tbl_lokasi_kantor where kd_unit = ?';
    return $this->db->query($sql, [$kdUnit])->getRowArray();
  }

  public function cekLokasi($posisi){
    $id_pegawai = session('id_pegawai');
    $tgl_absen = date('Y-m-d');
    $presensi_result = $this->cekPresensi(array('id_pegawai'=>$id_pegawai, 'tgl_absen'=>$tgl_absen));
    $distance = 0;
    $lat1 = $posisi['lat'];
    $lon1 = $posisi['lon'];
    $dl = $posisi['dl'];
    $dataUnit = $this->getUnit($posisi['kdunit']);
    $lat2 = $dataUnit['latitude'];
    $lon2 = $dataUnit['longitude'];
    $unit = "K";
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
    if ($unit == "K") {
        $distance = ($miles * 1.609344);
    } else if ($unit == "N") {
        $distance = ($miles * 0.8684);
    } else {
        $distance = $miles;
    }
    if($presensi_result === NULL){
      if ($distance > 1 && $dl == 'false'){
        return array('status'=>'fail', 'msg'=>'Anda belum bisa submit presensi, lokasi Anda > 1 km dari lokasi kerja. (Jarak aktual = '.round($distance,2).' km)');
      } else {
        $response = $this->submitPresensi($posisi);
        if ($response){
          return array('status'=>'success', 'msg'=>'Anda berhasil melakukan presensi.');
        }
      }
    } else {
        $response = $this->submitPresensi($posisi);
        if ($response){
          return array('status'=>'success', 'msg'=>'Anda berhasil melakukan presensi.');
        }
    }
  }

}
