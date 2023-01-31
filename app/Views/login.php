<?= $this->extend('Templates/app_layout'); ?>

<?= $this->section('header'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class='wrapper'>
    <body class="border-top-wide border-primary d-flex flex-column theme-light" style="background:url(<? echo base_url('/public/assets/sugarcane_blur.png')?>); background-repeat: no-repeat; background-size: cover; background-position: center; overflow: hidden;">
        <div class="page page-center">
            <div class="container-tight py-4">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img src=<? echo base_url("/public/assets/logo_only.png") ?> height="36" alt=""></a>
                </div>
                <div class="card card-md" style="opacity:0.75">
                    <? echo form_open('login_process'); ?>
                    <div class="card-body p-6">
                        <div class="mb-3">
                            <label class="form-label">NIK SAP</label>
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" id='pwd' name='pwd' placeholder="Password" autocomplete="off">
                            </div>
                        </div>
                        <div class="alert alert-danger" style="<? echo (session()->getFlashdata('msg') == NULL ? "display:none" : ""); ?>"><? echo session()->getFlashdata('msg'); ?></div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </div>
                    <? echo form_close(); ?>                    
                </div>
            </div>
        </div>
    </body>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->include('Scripts/script_login'); ?>

<?= $this->endSection(); ?>