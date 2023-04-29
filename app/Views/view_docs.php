<?= $this->extend('Templates/app_layout'); ?>

<?= $this->section('header'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="wrapper">
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
              <h3 class="card-title">Lihat Dokumen Masuk</h3>
            </div>
            <div class="card-body">
              <div class="form-group row mb-3">
                <iframe src=<? echo $path_surat."#view=fitH"; ?> title="Dokumen" style="border:none; display:block;" height="600px" width="100%" ></iframe>
              </div>
              <?php
                /*
                $content = file_get_contents($path_surat);
                header($path_surat);
                header('Content-Type: application/pdf');
                header('Content-Length: ' . strlen($content));
                header('Content-Disposition: inline; filename="YourFileName.pdf"');
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                ini_set('zlib.output_compression','0');
                die($content);
                */
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL -->
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_read_mail'); ?>

<?= $this->endSection(); ?>
