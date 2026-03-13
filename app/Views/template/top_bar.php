<div class="topbar" style="background-color: #2E7D32 !important;">
   <div class="topbar-left" style="background-color: #1b5e20 !important; border: none !important;">
    <div class="text-center">
        <a href="<?= base_url('') ?>" class="logo">
            <img src="<?= base_url('assets/images/logoSococim.jpeg') ?>" alt="Logo Sococim" style="height: 40px; width: auto; margin-right: 5px; border-radius: 3px;">
            <span style="vertical-align: middle; font-weight: bold; color: white;">SOCOCIM</span>
        </a>
    </div>
</div>
    
    <div class="navbar navbar-default" role="navigation" style="background-color: #2E7D32 !important; border: none !important; background-image: none !important;">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left" style="background-color: rgba(255,255,255,0.1) !important;">
                        <i class="fa fa-bars" style="color: white !important;"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                
                <form class="navbar-form pull-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control search-bar" placeholder="Rechercher un produit..." style="border: 1px solid rgba(255,255,255,0.3) !important; background: rgba(255,255,255,0.2) !important; color: white !important;">
                    </div>
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </form>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light" style="color: white !important;">
                            <i class="md md-crop-free"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <img src="<?= base_url() ?>assets/images/avatar-1.jpg" alt="user-img" class="img-circle">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="<?= base_url('logout') ?>"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
    </div>
</div>