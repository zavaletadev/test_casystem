<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless">
        <caption><?=!is_null($roles_list) ? sizeof($roles_list).' rol(es) registrado(s)' : NULL?> </caption>        
        <thead>
            <tr>
                <th>
                    Rol<i class="fas fa-hashtag"></i>
                </th>
                <th>
                    Nombre 
                </th>
                <th>
                    ¿Mostrar indicadores? 
                </th>
                <th>
                    Fecha de registro
                </th>
                <th>
                    Ajustes
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (!is_null($roles_list)) :
                foreach($roles_list as $role) : ?>
                    <tr>
                        <td>
                            <?=$role->role_id?>
                        </td>
                        <td>
                            <?=$role->role_name?>
                        </td>
                        <td>
                            <?=$role->show_admin_info == 1 ? 
                            '<i class="fas fa-2x fa-toggle-on text-success"></i>' : 
                            '<i class="fas fa-2x fa-toggle-off text-danger"></i>'?>
                        </td>
                        <td>
                            <small class="fw-light"><?=fancy_date($role->date_added, 'w-m-y')?></small>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Roles actions">
                                <button type="button" class="btn btn-dark" onclick="javascript:showEditModal(<?=$role->role_id?>)">
                                    <i class="fas fa-edit"></i> 
                                    <small>Editar</small>
                                </button>
                                <button type="button" class="btn btn-danger" onclick="javascript:deleteRole(<?=$role->role_id?>)">
                                    <i class="fas fa-trash"></i> 
                                    <small>Eliminar</small>
                                </button>

                            </div>
                        </td>
                    </tr>
                <?php endforeach;
            else: ?>
               <tr>
                <td colspan="5">
                    <p class="text-center p-5">
                        <i class="fas fa-xmark fa-3x text-muted"></i>
                        
                        <br>
                        Sin datos que mostrar
                    </p>
                </td>
            </tr>
        <?php endif; ?>    
    </tbody>
</table>
</div>
