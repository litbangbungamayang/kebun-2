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
              <h3 class="card-title">Detail Disposisi Masuk</h3>
            </div>
            <div class="card-body">
              <? echo form_open("dispo_baru", 'id="form_dispo" onsubmit="return true;"'); ?>
              <div class="form-group row mb-3">
              </div>
              <!-- HIDDEN FIELD -->
              <? 
                $id_surat = $result_dispo[0]['id_surat'];
                $id_disposisi = $result_dispo[0]['id_disposisi'];
                $status_disposisi = $result_dispo[0]['status_disposisi'];
                $jenis_dokumen = $result_dispo[0]['jenis_dokumen'];
                $nm_asal_dokumen = $result_dispo[0]['nm_asal_dokumen'];
                $nm_sub_asal_dokumen = $result_dispo[0]['nm_sub_asal_dokumen'];
                $nomor_dokumen = $result_dispo[0]['nomor_dokumen'];
                $perihal_dokumen = $result_dispo[0]['perihal_dokumen'];
                $tgl_dokumen = $result_dispo[0]['tgl_dokumen'];
                $date_tglDokumen = date_create($tgl_dokumen);
                $tgl_dokumen = date_format($date_tglDokumen, "d-M-Y");
                $tgl_kirim_disposisi = $result_dispo[0]['tgl_kirim_disposisi'];
                $date_tglDisposisi = date_create($tgl_kirim_disposisi);
                $tgl_kirim_disposisi = date_format($date_tglDisposisi, "d-M-Y");
                $nm_pendisposisi = $result_dispo[0]['nm_pendisposisi'];
                $catatan_dispo = $result_dispo[0]['catatan_disposisi'];
                $disposisi_surat = $result_dispo[0]['disposisi_surat'];
                $path_surat = "";
                $path_lampiran = [];
                foreach($result_dispo as $dokumen){
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
              <input hidden id="res_dispo_surat" value=<? echo $disposisi_surat; ?>>
              <!------------------>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Dokumen</label>
                <div class="col-sm-4">             
                  <input type="text" class="form-control"  value="<? echo strtoupper($jenis_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Nomor Dokumen</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control"  value="<? echo ($nomor_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control"  value="<? echo ($perihal_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Dari</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control"  value="<? echo ($nm_asal_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                  <input type="text" class="form-control"  value="<? echo ($nm_sub_asal_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal dokumen</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control"  value="<? echo ($tgl_dokumen); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal disposisi</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control"  value="<? echo ($tgl_kirim_disposisi); ?>" readonly>
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
                  <select  class="" name="tujuan_dispo" id="tujuan_dispo">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Disposisi dari</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control"  value="<? echo ($nm_pendisposisi); ?>" readonly>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Disposisi masuk</label>
                <div class="col-sm-6">
                  <select disabled class="" name="dispo_surat" id="dispo_surat">
                  </select>
                </div>
              </div>
               <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Catatan disposisi masuk</label>
                <div class="col-sm-6">
                  <textarea readonly class="form-control" rows="6" name="catatan_dispo" id="catatan_dispo" placeholder="Catatan disposisi"><? echo $catatan_dispo; ?></textarea>
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
                  <button type="" id="btnSubmit" class="btn btn-primary w-100">Simpan Disposisi</button>
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

<?= $this->include('Scripts/script_read_disposisi'); ?>

<?= $this->endSection(); ?>
