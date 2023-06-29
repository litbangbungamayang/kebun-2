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
            <h2 class="page-title">
              Overview
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          <!-- Luas TS -->
          <div class="col-sm-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Luas Tebu Sendiri (TS)</h3>
                <div class="row row-cards">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">Bungamayang</div>
                        </div>
                        <div class="h1 mb-3" id="luas_ts_buma">[luas_ts_buma]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">Cinta Manis</div>
                        </div>
                        <div class="h1 mb-3" id="luas_ts_cima">[luas_ts_cima]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">BCN</div>
                        </div>
                        <div class="h1 mb-3" id="luas_ts_bcn">[luas_ts_cima]</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Luas TR -->
          <div class="col-sm-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Luas Tebu Rakyat (TR)</h3>
                <div class="row row-cards">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">Bungamayang</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tr_buma">[luas_tr_buma]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">Cinta Manis</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tr_cima">[luas_tr_cima]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">BCN</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tr_bcn">[luas_tr_bcn]</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Luas TSI -->
          <div class="col-sm-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Luas Tebu Seinduk (TSI)</h3>
                <div class="row row-cards">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">Bungamayang</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tsi_buma">[luas_tsi_buma]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">Cinta Manis</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tsi_cima">[luas_tsi_cima]</div>
                        <div class="d-flex align-items-center">
                          <div class="subheader">BCN</div>
                        </div>
                        <div class="h1 mb-3" id="luas_tsi_bcn">[luas_tsi_bcn]</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Luas Total -->
          <div class="col-sm-6 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Luas Total</h3>
                <div class="row row-cards">
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">Bungamayang</div>
                        </div>
                        <div class="h1 mb-3" id="luas_total_buma">[luas_total_buma]</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">Cinta Manis</div>
                        </div>
                        <div class="h1 mb-3" id="luas_total_cima">[luas_total_cima]</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="subheader">BCN</div>
                        </div>
                        <div class="h1 mb-3" id="luas_total_bcn">[luas_total_bcn]</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_onfarm_overview'); ?>

<?= $this->endSection(); ?>
