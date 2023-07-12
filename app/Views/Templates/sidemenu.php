<!-- side menu -->
<aside class="navbar navbar-vertical navbar-expand-lg " id="navbar-to-hide" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="# navbar-menu">
      <span class="navbar-toggler-icon">blala</span>
    </button>
    <!-- LOGO -->
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href=".">
        <img src="<?php echo base_url('public/assets/logo bcn lebar.png');?>"  alt="Tabler" class="navbar-brand-image">
      </a>
    </h1>
    <!---------->
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item">
          <a class="nav-link" href="<? echo site_url('/profil'); ?>" >
            <span class="nav-link-title">
              <? echo session('nm_pegawai'); ?>
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(''); ?>" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            </span>
            <span class="nav-link-title">
              Home
            </span>
          </a>
        </li>
        <li class="nav-item" style="">
          <a class="nav-link" href="<?php echo site_url('/presensi');?>" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                <rect x="9" y="3" width="6" height="4" rx="2" />
                <path d="M9 17v-5" />
                <path d="M12 17v-1" />
                <path d="M15 17v-3" />
              </svg>
            </span>
            <span class="nav-link-title">
              Presensi 
            </span>
          </a>
        </li>
        <li class="nav-item-dropdown" style="">
          <a class="nav-link dropdown-toggle" href="#navbar-base"  data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-echo none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plant" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z"></path>
                <path d="M12 9a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3"></path>
                <path d="M12 11a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3"></path>
                <path d="M12 15l0 -6"></path>
              </svg>
            </span>
            <span class="nav-link-title">
              On Farm
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="<?php echo site_url('/front');?>">
                  <span class="nav-link-icon d-md-echo none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plant-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M2 9a10 10 0 1 0 20 0"></path>
                      <path d="M12 19a10 10 0 0 1 10 -10"></path>
                      <path d="M2 9a10 10 0 0 1 10 10"></path>
                      <path d="M12 4a9.7 9.7 0 0 1 2.99 7.5"></path>
                      <path d="M9.01 11.5a9.7 9.7 0 0 1 2.99 -7.5"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Petak Kebun
                </a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="<?php echo site_url('/aff');?>">
                  <span class="nav-link-icon d-md-echo none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M15 8h.01"></path>
                      <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7"></path>
                      <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"></path>
                      <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5"></path>
                      <path d="M15 19l2 2l4 -4"></path>
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    List Petak AFF
                </a>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item" style="">
          <a class="nav-link" href="<?php echo site_url('/logout');?>" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
              </svg>
            </span>
            <span class="nav-link-title">
              Logout
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>
