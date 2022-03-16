<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless align-middle">
        <caption><?=!is_null($users_list) ? sizeof($users_list).' usuario(s) registrado(s)' : NULL?> </caption>        
        <thead>
            <tr>
                <th>
                    <i class="fas fa-hashtag"></i>Usuario
                </th>
                <th>
                    Datos personales
                </th>
                <th>
                    Rol
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
            if (!is_null($users_list)) :
                foreach($users_list as $user) : ?>
                    <tr>
                        <td>
                            <?=$user->user_id?>
                        </td>
                        <td>
                            <i class="text-primary fas fa-user"></i> 
                            <?=$user->first_name?>
                            <?=$user->last_name?>

                            <hr class="my-2">

                            <i class="text-primary fas fa-envelope"></i> 
                            <?=$user->auth_email?>

                            <hr class="my-2">

                            <i class="text-primary fas fa-phone"></i> 
                            <?=$user->auth_phone?>
                            
                        </td>
                        <td>                            
                            <strong>
                                <i class="fas fa-tag"></i> 
                                <?=$user->role_name?>
                            </strong>
                        </td>
                        <td>
                            <small class="fw-light"><?=fancy_date($user->date_added, 'w-m-y')?></small>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Users actions">
                                <button type="button" class="btn btn-dark" onclick="javascript:showEditModal(<?=$user->user_id?>)">
                                    <i class="fas fa-edit"></i> 
                                    <small>Editar</small>
                                </button>
                                <button type="button" class="btn btn-danger" onclick="javascript:deleteUser(<?=$user->user_id?>)">
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
