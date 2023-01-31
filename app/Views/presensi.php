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
                            PRESENSI
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row row-cards">
                    <!-- Panel grafik -->
                    <div class="col-lg-3">
                        <div class="card">
                        <div class="card-status-top bg-lime"></div>
                        <div class="card-body">
                            <h3 class="card-title" id='lblDateTime'></h3>
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

<?= $this->include('Scripts/script_presensi'); ?>

<?= $this->endSection(); ?>
