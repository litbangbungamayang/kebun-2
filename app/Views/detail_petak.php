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
              Detail Petak Kebun
            </h2>
          </div>
        </div>
      </div>
      <!-- ===================== -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card" id="top_card">
                <div class="card-header">
                  <h3 class="card-title"><?= esc($deskripsi_blok) ?></h3>
                </div>
                <div class="card-body">
                  <div class="row row-cards">
                    <div class="col-lg-4">
                      <div style="display:none" id="kode_blok"><?= esc($kode_blok) ?></div>
                      <div>Unit <b><?= esc($nama_unit) ?></b></div>
                      <div>Kode Petak <b><?= esc($kode_blok) ?></b></div>
                      <div>Wilayah <b><?= esc($wilayah) ?></b> Afdeling <b><?= substr(esc($divisi),-2) ?></b></div>
                      <div>Status <b><?= esc($kepemilikan) ?></b></div>
                      <div>Tahun Giling <b><?= esc($mature) ?></b></div>
                    </div>
                    <div class="col-lg-4">
                      <div>Kategori <b><?= esc($status_blok) ?></b></div>
                      <div>Varietas <b><?= esc($nama_varietas) ?></b></div>
                      <div>Masa Tanam <b><?= esc($periode) ?></b></div>
                      <div>Luas <b><?= number_format(esc($luas_tanam),2,'.',',') ?> Ha</b></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ACCORDION - SEMENTARA BELUM TERPAKAI ==============================
          <div class="row row-cards" style="display:none">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="accordion" id="accordion-example">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false">
                        Data Taksasi
                      </button>
                    </h2>
                    <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                      <div class="accordion-body pt-0">
                        Berikut adalah data taksasi yang telah dilaksanakan pada petak ini:
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false">
                        Data Analisa
                      </button>
                    </h2>
                    <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                      <div class="accordion-body pt-0">
                        Berikut adalah data analisa yang telah dilaksanakan pada petak ini:
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-3">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false">
                        Data Pekerjaan Kebun
                      </button>
                    </h2>
                    <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                      <div class="accordion-body pt-0">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-4">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false">
                        Data Produksi
                      </button>
                    </h2>
                    <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                      <div class="accordion-body pt-0">
                        <strong>This is the fourth item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ======================================================================== -->

          <!-- TABEL DATA TAKSASI ================================================= -->
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="card-status-top bg-green"></div>
                <div class="card-header" href="#card_taksasi" data-bs-toggle="collapse" style="cursor: pointer">
                  <div class="card-title">Taksasi Produksi</div>
                  <div class="card-options">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="5" cy="12" r="1" />
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="19" cy="12" r="1" />
                    </svg>
                  </div>
                </div>
                <div id="card_taksasi" class="collapse">
                  <div class="card card-body">
                      <div class="table-responsive">
                        <table style="font-size: 1em; width: 100%" id="dataTaksasi" class="table card-table table-vcenter text-nowrap datatable">
                          <thead>
                            <tr>
                              <th class="w-1">No.</th>
                              <th>Jenis Taksasi</th>
                              <th>Tgl. Taksasi</th>
                              <th>Ton Tebu</th>
                              <th>Ton/Ha</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- TABEL DATA ANALISA ================================================= -->
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="card-status-top bg-orange"></div>
                <div class="card-header" href="#card_analisa" data-bs-toggle="collapse" style="cursor: pointer">
                  <div class="card-title">Data Analisa</div>
                  <div class="card-options">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="5" cy="12" r="1" />
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="19" cy="12" r="1" />
                    </svg>
                  </div>
                </div>
                <div id="card_analisa" class="collapse">
                  <div class="card-body">
                    <div class="col-md-12 col-lg-12">
                      <div class="row row-cards">
                        <div class="card-header">
                          <div class="card-title">Analisa Kemasakan</div>
                        </div>
                        <div class="card card-body">
                          <div class="table-responsive">
                            <table style="font-size: 1em; width: 100%" id="dataAnalisaKemasakan" class="table card-table table-vcenter text-nowrap datatable">
                              <thead>
                                <tr>
                                  <th class="w-1">No.</th>
                                  <th>Ronde</th>
                                  <th>Tgl Analisa</th>
                                  <th>Panjang batang (meter)</th>
                                  <th>Ruas</th>
                                  <th>Diameter (cm)</th>
                                  <th>Kg/meter</th>
                                  <th>FK</th>
                                  <th>KP</th>
                                  <th>KDT</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- TABEL DATA PEKERJAAN ================================================= -->
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="card-status-top bg-purple"></div>
                <div class="card-header" href="#card_pekerjaan" data-bs-toggle="collapse" style="cursor: pointer">
                  <div class="card-title">Pekerjaan Kebun</div>
                  <div class="card-options">
                  	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="5" cy="12" r="1" />
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="19" cy="12" r="1" />
                    </svg>
                  </div>
                </div>
                <div id="card_pekerjaan" class="collapse">
                  <div class="card card-body">
                      <div class="table-responsive">
                        <table style="font-size: 1em; width: 100%" id="dataPekerjaan" class="table card-table table-vcenter text-nowrap datatable">
                          <thead>
                            <tr>
                              <th class="w-1">No.</th>
                              <th>Nama Aktivitas</th>
                              <th>Luas (ha)</th>
                              <th>Tanggal Aktivitas</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- TABEL DATA PRODUKSI ================================================= -->
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="card-status-top bg-blue"></div>
                <div class="card-header" href="#card_produksi" data-bs-toggle="collapse" style="cursor: pointer">
                  <div class="card-title">Produksi Kebun</div>
                  <div class="card-options">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="5" cy="12" r="1" />
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="19" cy="12" r="1" />
                    </svg>
                  </div>
                </div>
                <div id="card_produksi" class="collapse">
                  <div class="card-body">
                    <div class="col-md-12 col-lg-12">
                      <p>AFF KEBUN : <span class="badge bg-red" id="txtAffKebun"></span></p>
                      <p>TON TEBU DITEBANG (TON) : <span id="txtTonTebang"></span></p>
                      <p>PRODUKTIVITAS (TON/HA) : <span id="txtProtas"></span></p>
                      <p>AWAL TEBANG : <span id="txtAwalTebang"></span></p>
                      <p>AKHIR TEBANG : <span id="txtAkhirTebang"></span></p>
                      <p>LAMA TEBANG (HARI) : <span id="txtLamaTebang"></span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- PETA AREAL ================================================= -->
          <div class="row row-cards">
            <div class="col-sm-12 col-lg-12">
              <div class="card card-body">
                <div class="card-status-top bg-green"></div>
                <div class="card-header" href="#card_peta" data-bs-toggle="collapse" style="cursor: pointer">
                  <div class="card-title">Peta Areal</div>
                  <div class="card-options">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <circle cx="5" cy="12" r="1" />
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="19" cy="12" r="1" />
                    </svg>
                  </div>
                </div>
                <div id="card_peta" class="collapse">
                  <div class="card-body">
                    <div class="col-md-12 col-lg-12">
                      <div id="map" style="height: 500px">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--===================-->
        </div>
      </div>
      <!--=======================-->
    </div>
  </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<?= $this->include ("Scripts/script_loadLeaflet"); ?>
<?= $this->include('Scripts/script_detail_petak'); ?>

<?= $this->endSection(); ?>
