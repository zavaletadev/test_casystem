<div id="newRoleModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="newRoleForm" class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title"> 
                    <i class="fas fa-plus-square"></i> 
                    Agregar Rol
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control validate" id="role_name" name="role_name" required placeholder="Nombre del rol" maxlength="64" minlength="4" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$" title="Mínimo 4 caracteres, sólo letras">
                            <label for="role_name" class="text-muted">
                                <i class="fas fa-pen-clip"></i> 
                                &nbsp;
                                Nombre del rol
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Nombre con el que se definirán la serie de permisos del usuario (mínimo 4 caracteres, números y puntos no válidos)
                            </small>
                        </div>

                        <div class="form-floating mb-4">
                            <select class="form-select validate" id="floatingViewAdminInfo" name="view_admin" required placeholder="¿Mostrar indicadores?">
                                <option value> </option>
                                <option value="1"> Si </option>
                                <option value="0"> No </option>
                            </select>
                            <label for="floatingViewAdminInfo" class="text-muted">
                                <i class="fas fa-pen-clip"></i> 
                                &nbsp;
                                ¿Mostrar indicadores?
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        
                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Indica si los usuarios asignados a este rol pueden visualizar el tablero de indicadores
                            </small>
                        </div>

                        <div id="form-control-menu-items" class="form-control mb-4">

                            <label for="floatingViewAdminInfo" class="text-muted">
                                <i class="fas fa-pen-clip"></i> 
                                &nbsp;
                                Secciones autorizadas
                                &nbsp;
                                <i class="fas fa-asterisk text-danger"></i>
                            </label>                        

                            <?php if (!is_null($menuitems_list)) : ?>              
                                <div class="row">
                                    <?php foreach($menuitems_list as $menu_item) : ?>
                                        <div class="col-12" style="margin-left: 30px !important;">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="switch-<?=$menu_item->menuitem_id?>" name="menuitem_id[]" value="<?=$menu_item->menuitem_id?>">
                                                <label class="form-check-label" for="switch-<?=$menu_item->menuitem_id?>">
                                                    <?=$menu_item->icon?>
                                                    &nbsp;
                                                    <?=$menu_item->label?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>                  
                            <?php endif; ?>

                            <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                <i class="fas fa-info-circle"></i> Selecciona los memús asignados a este rol
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="newRoleFormBtnSubmit" type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>        

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>        
            </div>
        </form>
    </div>
</div>
