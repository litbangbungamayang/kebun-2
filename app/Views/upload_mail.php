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
              <? echo form_open('new_mail'); ?>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Dokumen</label>
                <div class="col-sm-4">
                  <select class="" name="jns_dokumen" id="jns_dokumen">
                  </select>
                </div>
              </div>
              <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">Nomor Dokumen</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" style="text-transform:uppercase" oninput="this.value = this.value.toUpperCase()" name="no_dokumen" id="no_dokumen" placeholder="Nomor dokumen">
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
              <? echo form_close();?>
            </div>
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
