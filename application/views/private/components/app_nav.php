<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">                        
                <a class="nav-link" href="<?=base_url('app/dashboard')?>">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-fw fa-dashboard" aria-hidden="true"></i>
                    </div>
                    Tablero
                </a>
            </div>
            <?=$html_nav?>
            <div class="nav">                        
                <a class="nav-link" href="<?=base_url('app/logout')?>">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-power-off"></i>
                    </div>
                    Cerrar sesión
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Firmado como:</div>
            <i class="fas fa-user"></i> 
            <?=$this->session->userdata('first_name');?> 
            <?=$this->session->userdata('last_name');?>
        </div>
    </nav>
</div>
