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
              Laporan Harian
            </h2>
          </div>
        </div>
      </div>
      <div class="row row-deck row-cards">
        <div class="col-sm-12 col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                  <div class="col-sm-4 col-lg-4">
                    <div class="page-pretitle">Tanggal </div>
                    <div class="col-lg-6 input-group">
                      <input type="date" class="form-control" id="dtp_tgl_lhp"></input>
                    </div>
                  </div>
                  <div class="col-sm-4 col-lg-4">
                    <div class="page-pretitle">Hari giling BUMA </div>
                    <div class="col-lg-6">
                      <div class="h1">00</div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-lg-4">
                    <div class="page-pretitle">Hari giling CIMA </div>
                    <div class="col-lg-6">
                      <div class="h1">00</div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-deck row-cards">
          <div class="col-sm-6 col-lg-12">
            <div class="card">
              <div class="card-body position-relative">
                <h3 class="card-title">BCN</h3>
                <table class="h6 table table-bordered table-vcenter text-nowrap">
                  <thead class="sticky-top top-0">
                    <tr>
                      <th rowspan="2" style="text-align:center">URAIAN</th>
                      <th colspan="2" style="text-align:center">RKAP 2022</th>
                      <th colspan="2" style="text-align:center">REALISASI 2022</th>
                      <th colspan="1" style="text-align:center">REALISASI 2021</th>
                      <th colspan="1" style="text-align:center">% REAL. 2022 THD</th>
                      <th colspan="2" style="text-align:center">% REAL. 2022 THD RKAP 2022</th>
                      <th rowspan="2" style="text-align:center">REAL 2021</th>
                      <th rowspan="2" style="text-align:center">RKAP 2022</th>
                      <th rowspan="2" style="text-align:center">TAKMAR 2022</th>
                    </tr>
                    <tr>
                      <th style="text-align:center">HARI INI</th>
                      <th style="text-align:center">S.D. HARI INI</th>
                      <th style="text-align:center">HARI INI</th>
                      <th style="text-align:center">S.D. HARI INI</th>
                      <th style="text-align:center">S.D. HARI INI</th>
                      <th style="text-align:center">REAL. 2021</th>
                      <th style="text-align:center">HARI INI</th>
                      <th style="text-align:center">S.D. HARI INI</th>
                      <!-- 12 KOLOM -->
                    </tr>
                  </thead>
                  <tbody>
                    <!--<tr class="sticky-top" style="top: 60px">-->
                    <tr class="table-light">
                      <td colspan="12" class="table-dark">LUAS DIGILING (HA)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TR</td>
                    </tr>
                    <tr class="table-light">
                      <td>TOTAL LUAS</td>
                    </tr>
                    <!-- TEBU DIGILING -->
                    <tr>
                      <td colspan="12" class="table-dark">TEBU DIGILING (TON)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TR</td>
                    </tr>
                    <tr class="table-light">
                      <td>TOTAL DIGILING</td>
                    </tr>
                    <!-- TEBU PROTAS -->
                    <tr>
                      <td colspan="12" class="table-dark">PRODUKTIVITAS TEBU (TON/HA)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TR</td>
                    </tr>
                    <tr class="table-light">
                      <td>RATA2 PROTAS</td>
                    </tr>
                    <!-- HABLUR -->
                    <tr>
                      <td colspan="12" class="table-dark">HABLUR (TON)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TR</td>
                    </tr>
                    <tr class="table-light">
                      <td>TOTAL HABLUR</td>
                    </tr>
                    <!-- RENDEMEN -->
                    <tr>
                      <td colspan="12" class="table-dark">RENDEMEN (%)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TR</td>
                    </tr>
                    <tr class="table-light">
                      <td>RATA2 RENDEMEN</td>
                    </tr>
                    <!-- PRODUKSI GULA -->
                    <tr>
                      <td colspan="12" class="table-dark">PROD. GULA (TON)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TS EKS. TR</td>
                    </tr>
                    <tr>
                      <td>JUMLAH GMPG</td>
                    </tr>
                    <tr>
                      <td>JUMLAH GMTR</td>
                    </tr>
                    <tr class="table-light">
                      <td>TOTAL PRODUKSI</td>
                    </tr>
                    <!-- PRODUKSI TETES -->
                    <tr>
                      <td colspan="12" class="table-dark">PROD. TETES (TON)</td>
                    </tr>
                    <tr>
                      <td>TS</td>
                    </tr>
                    <tr>
                      <td>TS EKS. TR</td>
                    </tr>
                    <tr>
                      <td>JUMLAH TMPG</td>
                    </tr>
                    <tr>
                      <td>JUMLAH TMTR</td>
                    </tr>
                    <tr class="table-light">
                      <td>TOTAL PRODUKSI</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_daily_report'); ?>

<?= $this->endSection(); ?>
