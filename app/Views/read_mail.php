<?= $this->extend('Templates/app_layout'); ?>

<?= $this->section('header'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
  <?= $this->include('Templates/sidemenu') ?>
  <div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
          </div>
        </div>
        <div class="row">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Dokumen Masuk</h3>
            </div>
            <div class="card-body">
              <? echo form_open("dispo_baru", 'id="form_dispo" onsubmit="return true;"'); ?>
              <div class="form-group row mb-3">
              </div>
              <!-- HIDDEN FIELD -->
              <? 
                $id_surat = $result_surat[0]['id_surat'];
                $status_dokumen = $result_surat[0]['status_dokumen'];
                $jenis_dokumen = $result_surat[0]['jenis_dokumen'];
                $nm_asal_dokumen = $result_surat[0]['nm_asal_dokumen'];
                $nm_sub_asal_dokumen = $result_surat[0]['nm_sub_asal_dokumen'];
                $nomor_dokumen = $result_surat[0]['nomor_dokumen'];
                $perihal_dokumen = $result_surat[0]['perihal_dokumen'];
                $tgl_dokumen = $result_surat[0]['tgl_dokumen'];
                $tgl_diterima = $result_surat[0]['tgl_diterima'];
                $arr_tujuan_disposisi = [];
                $result_disposisi = $disposisi[0]['disposisi_surat'];
                $result_catatan_dispo = $disposisi[0]['catatan_disposisi'];
                foreach($disposisi as $item_dispo){
                  array_push($arr_tujuan_disposisi,$item_dispo['id_pegawai_tujuan']);
                }
                $path_surat = "";
                $path_lampiran = [];
                foreach($result_surat as $dokumen){
                  if($dokumen['jenis'] == "surat"){
                    $path_surat = $dokumen['path_surat'];
                  } else {
                    if($dokumen['jenis'] == "lampiran"){
                      array_push($path_lampiran, array("path"=>$dokumen['path_surat'], "nama"=>$dokumen['nama_awal']));
                    }
                  }
                }
              ?>
              <div hidden id="val_jenis_dokumen"><?php echo $jenis_dokumen;?></div>
              <div hidden id="val_asal_dokumen"><?php echo $nm_asal_dokumen;?></div>
              <div hidden id="val_sub_asal_dokumen"><?php echo $nm_sub_asal_dokumen;?></div>
              <input hidden id="id_surat" name="id_surat" value=<? echo $id_surat; ?>>
              <input hidden id="status_dokumen" name="status_dokumen" value=<? echo $status_dokumen; ?>>
              <input hidden id="arr_tujuan_dispo" value=<? echo json_encode($arr_tujuan_disposisi); ?>>
              <input hidden id="res_dispo_surat" value=<? echo $result_disposisi; ?>>
              <!------------------>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Dokumen</label>
                <div class="col-sm-4">
                  <select disabled class="" name="jns_dokumen" id="jns_dokumen">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Nomor Dokumen</label>
                <div class="col-sm-4">
                  <input disabled type="text" class="form-control" style="" oninput="this.value = this.value.toUpperCase()" value=<? echo $nomor_dokumen; ?> name="nomor_dokumen" id="nomor_dokumen" placeholder="Nomor dokumen">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-4">
                  <textarea disabled class="form-control" name="perihal" id="perihal" placeholder="Perihal dokumen"><? echo $perihal_dokumen; ?></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Dari</label>
                <div class="col-sm-4">
                  <select disabled class="" name="asal_dokumen" id="asal_dokumen"></select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                  <select disabled class="" name="sub_asal_dokumen" id="sub_asal_dokumen"></select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal dokumen</label>
                <div class="col-sm-2">
                  <input disabled type="date" class="form-control" name="tgl_dokumen" id="tgl_dokumen" placeholder="Tanggal dokumen" value=<? echo $tgl_dokumen; ?>>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal diterima</label>
                <div class="col-sm-2">
                  <input disabled type="date" class="form-control" name="tgl_diterima" id="tgl_diterima" placeholder="Tanggal diterima" value=<? echo $tgl_diterima; ?>>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">File surat</label>
                <div class="col-sm-2">
                  <a  href=<? echo base_url("lihat_dokumen/?path=".$path_surat); ?> class="btn btn-primary w-100" target="_blank" >Lihat dokumen </a>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">File lampiran</label>
                <div class="col-sm-6">
                  <div class="list-group">
                  <?
                    foreach($path_lampiran as $lampiran){
                      echo '<a href='.base_url("writable/uploads/".$lampiran['path']).' class="list-group-item" target="_blank">'.$lampiran['nama'].'</a>';
                    }
                  ?>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Disposisi kepada</label>
                <div class="col-sm-6">
                  <select <? echo (sizeof($disposisi)>0) ? "disabled" : ""; ?> class="" name="tujuan_dispo" id="tujuan_dispo">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Disposisi</label>
                <div class="col-sm-6">
                  <select <? echo (sizeof($disposisi)>0) ? "disabled" : ""; ?> class="" name="dispo_surat" id="dispo_surat">
                  </select>
                </div>
              </div>
               <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Catatan disposisi</label>
                <div class="col-sm-6">
                  <textarea <? echo (sizeof($disposisi)>0) ? "disabled" : ""; ?> class="form-control" rows="8" name="catatan_dispo" id="catatan_dispo" placeholder="Catatan disposisi"><? echo $result_catatan_dispo; ?></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <div id="form_err_msg" class="col-sm-6 alert alert-danger" style="<? echo $errors == NULL ? "display:none" : "" ?>">
                  <?
                    if(isset($errors)){
                      //$errors = $errors['errors'];
                      foreach ($errors as $error):
                        echo '<li>'.esc($error).'</li>';
                      endforeach;
                    }
                  ?>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">
                  <button <? echo (sizeof($disposisi)>0) ? "hidden" : ""; ?> type="" id="btnSubmit" class="btn btn-primary w-100">Simpan Disposisi</button>
                </div>
                <div class="col-sm-2">
                  <a href="<? echo site_url("/surat_masuk");?>" <? echo (sizeof($disposisi)>0) ? "" : "hidden"; ?> type="" id="btnKembali" class="btn btn-primary w-100">Kembali</a>
                </div>
              </div>
              <? echo form_close();?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL -->
  <div class="modal-dialog modal-sm fade" role="dialog" id="modal_sukses">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-status bg-success"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
        <!-- SVG icon code with class="mb-2 text-green icon-lg" -->
        <svg xmlns="http://www.w3.org/2000/svg" class="mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
          <path d="M9 12l2 2l4 -4"></path>
        </svg>
        <h3>Data berhasil disimpan</h3>
        <div class="text-muted">Entri surat masuk berhasil dilakukan.</div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <a href="#" class="btn btn-success w-100" data-bs-dismiss="modal">Kembali</a>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_read_mail'); ?>

<?= $this->endSection(); ?>
