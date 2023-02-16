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
              <h3 class="card-title">Form Dokumen Masuk</h3>
            </div>
            <div class="card-body">
              <? echo form_open_multipart('new_mail'); ?>
              <div class="form-group row mb-3">
                <div class="col-sm-4 alert alert-success alert-dismissible" role="alert">
                  <div class="d-flex">
                    <div>
                      <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                      <!-- SVG icon code with class="alert-icon" -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                      </svg>
                    </div>
                    <div>
                      <h4 class="alert-title">Entri berhasil!</h4>
                      <div class="text-muted">Data dokumen masuk telah tersimpan. </div>
                    </div>
                  </div>
                  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Dokumen</label>
                <div class="col-sm-4">
                  <select class="" name="jns_dokumen" id="jns_dokumen">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tujuan Dokumen</label>
                <div class="col-sm-4">
                  <select class="" name="tujuan_dokumen" id="tujuan_dokumen">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Nomor Dokumen</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" style="" oninput="this.value = this.value.toUpperCase()" name="nomor_dokumen" id="nomor_dokumen" placeholder="Nomor dokumen">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-4">
                  <textarea  class="form-control" name="perihal" id="perihal" placeholder="Perihal dokumen"></textarea>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Dari</label>
                <div class="col-sm-4">
                  <select class="" name="asal_dokumen" id="asal_dokumen"></select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                  <select class="" name="sub_asal_dokumen" id="sub_asal_dokumen"></select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal dokumen</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" name="tgl_dokumen" id="tgl_dokumen" placeholder="Tanggal dokumen">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal diterima</label>
                <div class="col-sm-2">
                  <input type="date" class="form-control" name="tgl_diterima" id="tgl_diterima" placeholder="Tanggal diterima">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">File surat</label>
                <div class="col-sm-4">
                  <input type="file" class="form-control" name="file_surat[]" id="file_surat" placeholder="File surat" multiple>
                  <div class="text-muted">(file pdf, excel, atau word)</div>
                </div>
              </div>
              <div class="form-group row mb-3">
                <div class="col-sm-6 alert alert-danger" style="<? echo $errors == NULL ? "display:none" : "" ?>">
                  <?
                    if(isset($errors)){
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
                  <button type="submit" class="btn btn-primary w-100">Simpan</button>
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
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_upload_mail'); ?>

<?= $this->endSection(); ?>
