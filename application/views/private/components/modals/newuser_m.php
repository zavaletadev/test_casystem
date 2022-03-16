<div id="newUserModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="newUserForm" class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title"> 
                    <i class="fas fa-plus-square"></i> 
                    Agregar usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control validate" id="first_name" name="first_name" required placeholder="Nombre" maxlength="32" minlength="3" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Mínimo 3 caracteres, sólo letras">
                            <label for="first_name" class="text-muted">
                                <i class="fas fa-pen-clip"></i> 
                                &nbsp;
                                Nombre
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Nombre del usuario (mínimo 3 caracteres, números y puntos no válidos)
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control validate" id="last_name" name="last_name" required placeholder="Apellidos" maxlength="64" minlength="6" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Mínimo 6 caracteres, sólo letras">
                            <label for="last_name" class="text-muted">
                                <i class="fas fa-pen-clip"></i> 
                                &nbsp;
                                Apellidos
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Apellidos (mínimo 6 caracteres, números y puntos no válidos)
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="email" class="form-control validate" id="email_auth" name="email_auth" required placeholder="Correo electrónico" maxlength="128" minlength="5">
                            <label for="email_auth" class="text-muted">
                                <i class="fas fa-at"></i> 
                                &nbsp;
                                Correo electrónico
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Correo electrónico (mínimo 5 caracteres)
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="phone" class="form-control validate" id="telefono_auth" name="telefono_auth" required placeholder="Teléfono (10 dígitos)" maxlength="10" minlength="10" pattern="^\d+$" title="Teléfono a 10 dígitos">
                            <label for="telefono_auth" class="text-muted">
                                <i class="fas fa-phone"></i> 
                                &nbsp;
                                Teléfono a 10 dígitos
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Teléfono a 10 dígitos (solo números)
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control validate" id="password" name="password" required placeholder="Contraseña" maxlength="16" minlength="8" title="Contraseña">
                            <label for="password" class="text-muted">
                                <i class="fas fa-lock"></i> 
                                &nbsp;
                                Contraseña
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Contraseña
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <select class="form-select validate" id="role_id" name="view_admin" required placeholder="Rol">
                                <option value> </option>
                                <?php if(!is_null($roles_list)) : 
                                    foreach($roles_list as $role) : ?>
                                        <option value="<?=$role->role_id?>">
                                            <?=$role->role_name?>
                                        </option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="role_id" class="text-muted">
                                <i class="fas fa-list-check"></i> 
                                &nbsp;
                                Rol asignado
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Seleccione el rol del usuario en el sistema
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea class="form-control" placeholder="Acerca del usuario" id="bio" name="bio"></textarea>
                            <label for="bio">
                                <i class="fas fa-user text-muted"></i> 
                                &nbsp;
                                Acerca del usuario                                
                            </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="newUserFormBtnSubmit" type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>        

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>        
            </div>
        </form>
    </div>
</div>
