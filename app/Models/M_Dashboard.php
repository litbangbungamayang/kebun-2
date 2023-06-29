<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dashboard extends Model{

  private $buma_env = "http://simpgbuma.ptpn7.com/index.php/api_bcn/";
  private $cima_env = "http://simpgcima.ptpn7.com/index.php/api_bcn/";
  private $lokal = "http://localhost/simpgbuma/api_bcn/";


  public function getServer($pg){
    $server_pg = null;
    switch($pg){
      case "buma":
        $server_pg = $this->buma_env;
        break;
      case "cima":
        $server_pg = $this->cima_env;
        break;
      case "lokal":
        $server_pg = $this->lokal;
        break;
    }
    return $server_pg;
  }

  public function getDataGrafik1($postData){
    $server_pg = null;
    $pg = $postData['pg'];
    switch($pg){
      case "buma":
        $server_pg = $this->buma_env;
        break;
      case "cima":
        $server_pg = $this->cima_env;
        break;
      case "lokal":
        $server_pg = $this->lokal;
        break;
    }
    $req_fields = array(
      'jenis_data' => ($postData['field']),
      'tgl_awal' => $postData['tgl_awal'],
      'tgl_akhir' => $postData['tgl_akhir']
    );
    $req_fields_string = http_build_query($req_fields);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $server_pg."getDataTimeSeries",
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $req_fields_string,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => array(
        'cache-control: no-cache'
      )
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  public function getDataDashboard($pg){
    $server_pg = null;
    switch($pg){
      case "buma":
        $server_pg = $this->buma_env;
        break;
      case "cima":
        $server_pg = $this->cima_env;
        break;
      case "lokal":
        $server_pg = $this->lokal;
        break;
    }
    $request = array("db_server"=>$server_pg, "url"=>"getDataDashboard");
    return ($this->getCurl($request));
  }

  public function getMulaiGiling($pg){
    $request = array("db_server"=>$this->getServer($pg), "url"=>"getTbSetting");
    return ($this->getCurl($request));
  }

  public function getGilingSeinduk($pg, $tgl_last_lhp){
    return ($this->getCurl(array("db_server"=>$this->getServer($pg), "url"=>"getGilingSeinduk?tgl_last_lhp=".$tgl_last_lhp)));
  }

  function getCurl($request){
    $db_server = $request["db_server"];
    $url = str_replace(" ", "", $request["url"]);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $db_server.$url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);
    return $response; // output as json encoded
  }

  function serverRequest($pg,$req){
    $server_pg = null;
    switch($pg){
      case "buma":
        $server_pg = $this->buma_env;
        break;
      case "cima":
        $server_pg = $this->cima_env;
        break;
      case "lokal":
        $server_pg = $this->lokal;
        break;
    }
    if(is_array($req)){
      $request = $req["request"];
      switch($request){
        case "getLhpByDate":
          $tgl_lhp = $req["tgl_lhp"];
          $req = $request."?tgl_lhp=".$tgl_lhp;
          break;
      }
    }
    $request = array("db_server"=>$server_pg, "url"=>$req,);
    return ($this->getCurl($request));
  }

  function tesDb(){
    return json_encode($this->db->query("select * from tbl_mon_target")->getResult());
  }

  function getTargetKinerja($kategori, $pg){
    $query = "select * from tbl_mon_target where kategori = ? and pg = ? and status = ?";
    $argument = [$kategori, $pg, 1];
    return json_encode($this->db->query($query, $argument)->getResult());
  }

  function getDataTarget($arg){
    $query =
    "select * from tbl_mon_target montar
      join tbl_mon_tsi tsi on tsi.id_target = montar.id
    where montar.pg = ? and montar.kategori = ? and montar.revisi = ? and montar.status = ? order by nama_unit_seinduk";
    return json_encode($this->db->query($query, $arg)->getResult());
  }

}
