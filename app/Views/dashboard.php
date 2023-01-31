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
              Monitoring Giling
            </h2>
            <div class="page-pretitle" id="tgl_giling"></div>
            <div class="page-pretitle" id="tgl_aktual"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <!-- Baris data utama -->
        <div class="row row-deck row-cards">
          <!-- Kolom Bungamayang -->
          <div class="col-lg-6">
            <div class="row row-cards">
              <!-- Panel grafik -->
              <div class="col-12">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body">
                    <h3 class="card-title">Bungamayang</h3>
                    <div id="hourly-buma" class="chart-lg"></div>
                  </div>
                </div>
              </div>
              <!-- Panel tebu masuk -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="tebu_masuk_hi_buma">0</div>
                    <div class="text-muted mb-3">tebu masuk h.i. (ton)</div>
                    <div class="h1 m-0" id="tebu_masuk_sd_buma">0</div>
                    <div class="text-muted mb-3">tebu masuk s.d. (ton)</div>
                  </div>
                </div>
              </div>
              <!-- Panel tebu digiling -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="tebu_giling_hi_buma">0</div>
                    <div class="text-muted mb-3">tebu digiling h.i. (ton)</div>
                    <div class="h1 m-0" id="tebu_giling_sd_buma">0</div>
                    <div class="text-muted mb-3">tebu digiling s.d. (ton)</div>
                  </div>
                </div>
              </div>
              <!-- Panel sisa tebu -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="stok_buma">0</div>
                    <div class="text-muted mb-3">sisa tebu (ton)</div>
                    <div class="h1 m-0" id="hargil_buma">0</div>
                    <div class="text-muted mb-3">hari giling</div>
                  </div>
                </div>
              </div>
              <!-- Panel hektar tertebang -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="protas_hi_buma">0</div>
                    <div class="text-muted mb-3">protas TS (ton/ha)</div>
                    <div class="h1 m-0" id="protas_sd_buma">0</div>
                    <div class="text-muted mb-3">protas TS s.d. (ton/ha)</div>
                  </div>
                </div>
              </div>
              <!-- Panel produksi gula -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-status-top bg-lime"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="gula_hi_buma">0</div>
                    <div class="text-muted mb-3">produksi gula (ton)</div>
                    <div class="h1 m-0" id="gula_sd_buma">0</div>
                    <div class="text-muted mb-3">produksi gula s.d. (ton)</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Kolom Cinta Manis -->
          <div class="col-lg-6">
            <div class="row row-cards">
              <!-- Panel grafik -->
              <div class="col-12">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body">
                    <h3 class="card-title">Cinta Manis</h3>
                    <div id="hourly-cima" class="chart-lg"></div>
                  </div>
                </div>
              </div>
              <!-- Panel tebu masuk -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="tebu_masuk_hi_cima">0</div>
                    <div class="text-muted mb-3">tebu masuk h.i. (ton)</div>
                    <div class="h1 m-0" id="tebu_masuk_sd_cima">0</div>
                    <div class="text-muted mb-3">tebu masuk s.d. (ton)</div>
                  </div>
                </div>
              </div>
              <!-- Panel tebu digiling -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="tebu_giling_hi_cima">0</div>
                    <div class="text-muted mb-3">tebu digiling h.i. (ton)</div>
                    <div class="h1 m-0" id="tebu_giling_sd_cima">0</div>
                    <div class="text-muted mb-3">tebu digiling s.d. (ton)</div>
                  </div>
                </div>
              </div>
              <!-- Panel sisa tebu -->
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="stok_cima">0</div>
                    <div class="text-muted mb-3">sisa tebu (ton)</div>
                    <div class="h1 m-0" id="hargil_cima">0</div>
                    <div class="text-muted mb-3">hari giling</div>
                  </div>
                </div>
              </div>

              <!-- Panel hektar tertebang -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="protas_hi_cima">0</div>
                    <div class="text-muted mb-3">protas TS (ton/ha)</div>
                    <div class="h1 m-0" id="protas_sd_cima">0</div>
                    <div class="text-muted mb-3">protas TS s.d. (ton/ha)</div>
                  </div>
                </div>
              </div>
              <!-- Panel produksi gula -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-status-top bg-danger"></div>
                  <div class="card-body p-2 text-center">
                    <div class="h1 m-0" id="gula_hi_cima">0</div>
                    <div class="text-muted mb-3">produksi gula (ton)</div>
                    <div class="h1 m-0" id="gula_sd_cima">0</div>
                    <div class="text-muted mb-3">produksi gula s.d. (ton)</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Data Konsolidasi -->
          <div class="col-lg-12">
            <div class="row row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">BCN</h3>
                    <div id="hourly-bcn" class="chart-lg"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Panel tebu masuk -->
          <div class="col-sm-3">
            <div class="card">
              <div class="card-status-top bg-cyan"></div>
              <div class="card-body p-2 text-center">
                <div class="h1 m-0" id="tebu_masuk_hi_bcn">0</div>
                <div class="text-muted mb-3">tebu masuk h.i. (ton)</div>
                <div class="h1 m-0" id="tebu_masuk_sd_bcn">0</div>
                <div class="text-muted mb-3">tebu masuk s.d. (ton)</div>
              </div>
            </div>
          </div>
          <!-- Panel tebu giling -->
          <div class="col-sm-3">
            <div class="card">
              <div class="card-status-top bg-cyan"></div>
              <div class="card-body p-2 text-center">
                <div class="h1 m-0" id="tebu_giling_hi_bcn">0</div>
                <div class="text-muted mb-3">tebu digiling h.i. (ton)</div>
                <div class="h1 m-0" id="tebu_giling_sd_bcn">0</div>
                <div class="text-muted mb-3">tebu digiling s.d. (ton)</div>
              </div>
            </div>
          </div>
          <!-- Panel protas TS -->
          <div class="col-sm-3">
            <div class="card">
              <div class="card-status-top bg-cyan"></div>
              <div class="card-body p-2 text-center">
                <div class="h1 m-0" id="protas_hi_bcn">0</div>
                <div class="text-muted mb-3">protas TS h.i. (ton/ha)</div>
                <div class="h1 m-0" id="protas_sd_bcn">0</div>
                <div class="text-muted mb-3">protas TS s.d. (ton/ha)</div>
              </div>
            </div>
          </div>
          <!-- Panel produksi gula -->
          <div class="col-sm-3">
            <div class="card">
              <div class="card-status-top bg-cyan"></div>
              <div class="card-body p-2 text-center">
                <div class="h1 m-0" id="gula_hi_bcn">0</div>
                <div class="text-muted mb-3">produksi gula (ton)</div>
                <div class="h1 m-0" id="gula_sd_bcn">0</div>
                <div class="text-muted mb-3">produksi gula s.d. (ton)</div>
              </div>
            </div>
          </div>
          <!-- Testing panel -->
          <div class="col-sm-4">

          </div>
        </div>
      </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_dashboard'); ?>

<?= $this->endSection(); ?>
