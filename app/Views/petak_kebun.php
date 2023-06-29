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
              Petak Kebun
            </h2>
          </div>
        </div>
      </div>
      <!-- ===================== -->
      <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
            <!-- PREVIEW -->
            <div class="col-sm-4 col-lg-4">
                <div class="card card-body sticky-top"> <!-- NOTES: sticky-top supaya kotak preview tetap diatas! -->
                    <h3 class="card-title">Detail Petak</h3>
                    <div class="card-img-top img-responsive img-responsive-16by9" style="background-image: url(./public/assets/profil_petak.jpg)"></div>
                    <div class="subheader">kepemilikan</div>
                    <div class="h4 mb-3" id="lbl_kepemilikan">-</div>
                    <div class="subheader">Deskripsi</div>
                    <div class="h4 mb-3" id="lbl_deskripsi_blok">-</div>
                    <div class="subheader">Kategori</div>
                    <div class="h4 mb-3" id="lbl_kategori">-</div>
                    <div class="subheader">Varietas</div>
                    <div class="h4 mb-3" id="lbl_varietas">-</div>
                    <div id="kode_blok" style="display:none"></div>
                    <div class="card-text">
                      <a href="#" class="btn btn-primary" id="btn_detail_petak">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- =========================== -->
            <!-- TABEL -->
            <button
                    type="button"
                    class="btn btn-danger btn-floating"
                    id="btn_backToTop"
                    style="position: fixed; bottom: 20px; right: 20px; display: none"
                    >
              <i class="fas fa-arrow-up"></i>
            </button>
            <div class="col-sm-12 col-lg-8">
              <div class="row row-cards">
                <div class="card card-body">
                  <div class="row row-cards">
                    <div class="col-sm-8 col-lg-4">
                      <div class="page-pretitle">Tahun Giling</div>
                      <select class="custom-control custom-select" id="sel_tahunGiling"></select>
                    </div>
                    <div class="col-sm-8 col-lg-4">
                      <div class="page-pretitle">Kebun</div>
                      <select class="custom-control custom-select" id="sel_kebun"></select>
                    </div>
                    <div class="col-sm-8 col-lg-4">
                      <div class="page-pretitle">Cari</div>
                      <input class="form-control" id="txt_cari">
                    </div>
                  </div>
                  <div class="row row-cards">
                    <div class="table-responsive mb-2">
                    <table style="font-size: 1em" id="tblPetak" class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th>Deskripsi Petak Kebun</th>
                          <th>Tahun Giling</th>
                          <th>Luas Tanam</th>
                        </tr>
                      </thead>
                      <tbody id="dataPetak">
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- =========================== -->
          </div>
        </div>
      </div>
      <!--=======================-->
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_petak_kebun'); ?>

<?= $this->endSection(); ?>
