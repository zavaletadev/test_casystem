<div class="row">
    <div class="col-12">
        <div class="card mt-3 mb-5">
            <div class="card-header p-3">                
                <h3>Mis datos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-3">                        
                        <img src="<?=base_url('static/images/profile_pic.jpg')?>" class="img-fluid rounded-circle mx-auto d-block mt-xl-5" style="max-height: 192px;">
                    </div>
                    <div class="col-12 col-xl-9">
                        <dl class="row">
                            <dt class="col-sm-3 mb-md-3 text-secondary text-secondary">
                                <i class="fas fa-user"></i> Nombre
                            </dt>
                            <dd class="col-sm-9 mb-3"> 
                                <?=$profile_data->first_name?> <?=$profile_data->last_name?> 
                            </dd>

                            <dt class="col-sm-3 mb-md-3 text-secondary"> 
                                <i class="fas fa-envelope"></i> Correo electrónico 
                            </dt>
                            <dd class="col-sm-9 mb-3"> 
                                <a href="mailto:<?=$profile_data->auth_email?>"><?=$profile_data->auth_email?></a> 
                            </dd>

                            <dt class="col-sm-3 mb-md-3 text-secondary">
                                <i class="fas fa-phone"></i> Teléfono
                            </dt>
                            <dd class="col-sm-9 mb-3"> 
                                <a href="tel:+52<?=$profile_data->auth_phone?>"> <?=fancy_phone($profile_data->auth_phone)?></a> 
                            </dd>

                            <dt class="col-sm-3 mb-md-3 text-secondary">
                                <i class="fas fa-marker"></i> Acerca de mí
                            </dt>

                            <dd class="col-sm-9 mb-3"> <p class="fw-light"><?=$profile_data->bio?></p> </dd>

                            <div class="col-12"> <hr /> </div>

                            <dt class="col-sm-3 mb-md-3">&nbsp;</dt>
                            <dd class="col-sm-9">
                                <button class="btn btn-link p-0" onclick="javascript:alert('Funcionalidad no disponible\nTe notificaremos en cuanto esté lista')">
                                    <i class="fas fa-edit"></i> Editar información personal 
                                </button>
                            </dd>

                            <dt class="col-sm-3 mb-md-3">&nbsp;</dt>
                            <dd class="col-sm-9">
                                <button class="btn btn-link p-0" onclick="javascript:alert('Funcionalidad no disponible\nTe notificaremos en cuanto esté lista')">
                                    <i class="fas fa-lock"></i> Actualizar contraseña
                                </button>
                            </dd>

                            <dt class="col-sm-3 mb-md-3">&nbsp;</dt>
                            <dd class="col-sm-9">
                                <button class="btn btn-link p-0" onclick="javascript:alert('Funcionalidad no disponible\nTe notificaremos en cuanto esté lista')">
                                    <i class="fas fa-camera"></i> Cambiar foto de perfil
                                </button>
                            </dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
