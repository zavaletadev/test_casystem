<?php if($this->session->userdata('show_admin_info') == 1) : ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body text-center">
                    <h3>6</h3>
                    Usuarios registrados 
                </div>                                
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-center">
                    <h3>2</h3>
                    <i class="fas fa-user-check"></i> Usuarios activos
                </div>                                
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body text-center">
                    <h3>9</h3>
                    <i class="fas fa-users"></i> Roles registrados 
                </div>                                
            </div>
        </div>
    </div>                    
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <h3>Información estática, meramente de ejemplo</h3>
        <p class="text-left">
            <em>En caso de contar con los permisos necesarios, visualizarás tres indicadores en esta sección, de lo contrario, solo verás este texto</em>
            <br>
            <h4>
                <a href="https://github.com/zavaletadev/test_casystem/tree/web_test" target="_new">
                    Repositorio de este demo (aplicación web y servicio REST)
                </a>
            </h4>

            <h4>
                <a href="https://github.com/zavaletadev/test_casystem/tree/mobile_test" target="_new">
                    Repositorio de este demo (App Android)
                </a>
            </h4>
            
        </p>

    </div>
</div>
