
/**
 * Referencia a la modal
 * @type {bootstrap}
 */
const editRoleModal = new bootstrap.Modal(document.getElementById('editRoleModal'));

/**
 * Id de los menus seleccionados
 * @type {Array}
 */
let selectedIdMenuItemsEdit = [];

/**
 * [selectedId description]
 * @type {[type]}
 */
let selectedId = null;

/**
 * Función que carga la modal
 * @param  {[type]} role_id [description]
 * @return {[type]}         [description]
 */
async function showEditModal(role_id) {    
    editRoleModal.show();

    const form = document.getElementById('editRoleForm');
    const btnSubmit = document.getElementById("editRoleFormBtnSubmit");
    const init = btnSubmit.innerHTML;
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Cargando rol, por favor espera...';

    document.getElementById('role_name_edit').disabled = true;
    document.getElementById('floatingViewAdminInfoEdit').disabled = true;            

    const bodyFormData = new FormData();
    bodyFormData.append('role_id', role_id);

    try {

        const response = await axios(
            {
                method : 'post', 
                url : baseUrl('app/roles/get_role'), 
                data : bodyFormData, 
                headers: { 
                    "Content-Type": "multipart/form-data" 
                }
            }
        );
        
        if (response.data.response_code === 200) {            
            const role_data = response.data.role_data;
            const menu_items_data = response.data.menuitems_data;

            selectedIdMenuItemsEdit = [];
            selectedId = role_data.role_id;

            document.getElementById('role_name_edit').value = role_data.role_name;
            document.getElementById('floatingViewAdminInfoEdit').value = role_data.show_admin_info;            

            menu_items_data.forEach((item) => {
                selectedIdMenuItemsEdit.push(item.menuitem_id);                
                document.getElementById(`switch-edit-${item.menuitem_id}`).checked = true;
            });

            document.getElementById('role_name_edit').disabled = false;
            document.getElementById('floatingViewAdminInfoEdit').disabled = false;            

            btnSubmit.innerHTML = init;
            btnSubmit.disabled = false;
        }

        else {
            notifier.alert(
                'Por favor vuelve a intentarlo',
                {
                    labels : {
                        success : 'Ocurrió un error'
                    }
                }
            );                
        }
        
    }

    catch(exception) {
        notifier.alert(
            'Por favor vuelve a intentarlo',
            {
                labels : {
                    success : 'Ocurrió un error'
                }
            }
        );
    }
}

/**
 * En el submit validamos los checkboxes
 * @param  {[type]} 'editRoleForm').addEventListener('submit', (event        [description]
 * @return {[type]}                                           [description]
 */
document.getElementById('editRoleForm').addEventListener('submit', async (event) => {
    event.preventDefault();    
    if (validateSelecttionMenuItemsEdit()) {
        const form = document.getElementById('editRoleForm');
        const btnSubmit = document.getElementById("editRoleFormBtnSubmit");
        const init = btnSubmit.innerHTML;
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Editando rol, por favor espera...';

        try {            

            const bodyFormData = new FormData();
            bodyFormData.append('role_id', selectedId);
            bodyFormData.append('role_name_edit', document.getElementById('role_name_edit').value);
            bodyFormData.append('show_admin_edit', document.getElementById('floatingViewAdminInfoEdit').value);
            bodyFormData.append('menu_items_edit', selectedIdMenuItemsEdit);

            const response = await axios(
                {
                    method : 'post', 
                    url : baseUrl('app/roles/edit'), 
                    data : bodyFormData, 
                    headers: { 
                        "Content-Type": "multipart/form-data" 
                    }
                }
            );

            if (response.data.response_code === 200) {
                notifier.success(
                    'Rol editado',
                    {
                        labels : {
                            success : '¡Hecho!'
                        }
                    }
                );

            }

            else {
                notifier.alert(
                    'Por favor vuelve a intentarlo',
                    {
                        labels : {
                            success : 'Ocurrió un error'
                        }
                    }
                );                
            }

            loadRoleList();
            editRoleModal.hide();
        }

        catch(exception) {
            notifier.alert(
                'Por favor vuelve a intentarlo',
                {
                    labels : {
                        success : 'Ocurrió un error'
                    }
                }
            );
        }
        
    }
});

/**
 * Limpiamos la ventana modal cada que la cerramos
 * @param  {[type]} 'hidden.bs.modal' [description]
 * @param  {[type]} (                 [description]
 * @return {[type]}                   [description]
 */
document.getElementById('editRoleModal').addEventListener('hidden.bs.modal', () => {

    selectedIdMenuItemsEdit = [];
    document.getElementById('role_name_edit').value = '';
    document.getElementById('floatingViewAdminInfoEdit').value = '';

    const btnSubmit = document.getElementById("editRoleFormBtnSubmit");    
    btnSubmit.disabled = false;
    btnSubmit.innerHTML = '<i class="fas fa-save"></i> Guardar cambios';

    document.getElementById('form-control-menu-items-edit').classList.remove('is-valid');
    document.getElementById('form-control-menu-items-edit').classList.remove('is-invalid');

    document.querySelectorAll('.validate').forEach((element) => {
        element.classList.remove('is-valid');
        element.classList.remove('is-invalid');
    });

    document.querySelectorAll('.form-check-input-edit').forEach((element) => {
        element.checked = false;
    });  

});

/**
 * Validación para seleccionr como mínimo un menú
 * @return {[type]} [description]
 */
function validateSelecttionMenuItemsEdit() {
    let selectedItems = 0;
    document.querySelectorAll('.form-check-input-edit').forEach((element) => {
        if(element.checked) {
            selectedItems ++;
            if (selectedIdMenuItemsEdit.indexOf(element.value) === -1) {
                selectedIdMenuItemsEdit.push(element.value);                
            }            
        }

        else {
            selectedIdMenuItemsEdit = selectedIdMenuItemsEdit.filter((index)  => index !== element.value);
        }
    });  

    if (selectedItems > 0) {
        document.getElementById('form-control-menu-items-edit').classList.add('is-valid');
        document.getElementById('form-control-menu-items-edit').classList.remove('is-invalid');
    }

    else {
        document.getElementById('form-control-menu-items-edit').classList.add('is-invalid');
        document.getElementById('form-control-menu-items-edit').classList.remove('is-valid');
    }

    return selectedItems > 0 ? true : false;
}
