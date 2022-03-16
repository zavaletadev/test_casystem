
/**
 * Referencia a la modal
 * @type {bootstrap}
 */
const newRoleModal = new bootstrap.Modal(document.getElementById('newRoleModal'));

/**
 * Id de los menus seleccionados
 * @type {Array}
 */
let selectedIdMenuItems = [];

/**
 * Cargamos la lista de roles
 * @param  {[type]} 'load' [description]
 * @param  {[type]} (      [description]
 * @return {[type]}        [description]
 */
window.addEventListener('load', () => {    
    loadRoleList();
});

/**
 * Render modal add role
 * @param  {[type]} 'newRoleModalBtn').addEventListener('cliick', (event        [description]
 * @return {[type]}                                               [description]
 */
document.getElementById('newRoleModalBtn').addEventListener('click', (event) => {
    newRoleModal.show()
});

/**
 * Agregamos la clase de error de boostrap en el evento de validación de Submit
 * @param  {[type]} '.validate').forEach((element) [description]
 * @return {[type]}                                [description]
 */
document.querySelectorAll('.validate').forEach((element) => {
    element.addEventListener('invalid', (event) => {
        element.classList.remove('is-valid');
        element.classList.add('is-invalid');
    });    

    /**
     * Para todos los campos con la clase validate, evaluamos 
     * si tienen error o no para indicar su clase contextual 
     * @param  {[type]} 'keyup' [description]
     * @param  {[type]} (event  [description]
     * @return {[type]}         [description]
     */
    element.addEventListener('keyup', (event) => {
        const input = event.target;

        //Campoos válidos
        if(input.validity.valid) {
            element.classList.remove('is-invalid');
            element.classList.add('is-valid');
        }

        // Campos inválidos 
        else {
            element.classList.remove('is-valid');
            element.classList.add('is-invalid');        
        }
    });  

    element.addEventListener('change', (event) => {
        const input = event.target;

        //Campoos válidos
        if(input.validity.valid) {
            element.classList.remove('is-invalid');
            element.classList.add('is-valid');
        }

        // Campos inválidos 
        else {
            element.classList.remove('is-valid');
            element.classList.add('is-invalid');        
        }
    });  
});

/**
 * Validamos la selección
 * @param  {[type]} '.form-check-input').forEach((element) [description]
 * @return {[type]}                                        [description]
 */
document.querySelectorAll('.form-check-input').forEach((element) => {
    element.addEventListener('change', (event) => {
        validateSelecttionMenuItems();
    });
});

/**
 * En el submit validamos los checkboxes
 * @param  {[type]} 'newRoleForm').addEventListener('submit', (event        [description]
 * @return {[type]}                                           [description]
 */
document.getElementById('newRoleForm').addEventListener('submit', async (event) => {
    event.preventDefault();    
    if (validateSelecttionMenuItems()) {
        const form = document.getElementById('newRoleForm');
        const btnSubmit = document.getElementById("newRoleFormBtnSubmit");
        const init = btnSubmit.innerHTML;
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Registrando rol, por favor espera...';

        try {
            const bodyFormData = new FormData();
            bodyFormData.append('role_name', document.getElementById('role_name').value);
            bodyFormData.append('show_admin', document.getElementById('floatingViewAdminInfo').value);
            bodyFormData.append('menu_items', selectedIdMenuItems);

            const response = await axios(
                {
                    method : 'post', 
                    url : baseUrl('app/roles/create'), 
                    data : bodyFormData, 
                    headers: { 
                        "Content-Type": "multipart/form-data" 
                    }
                }
            );
        
            if (response.data.response_code === 200) {
                notifier.success(
                    'Rol agregado',
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
            newRoleModal.hide();
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
document.getElementById('newRoleModal').addEventListener('hidden.bs.modal', () => {

    selectedIdMenuItems = [];
    document.getElementById('role_name').value = '';
    document.getElementById('floatingViewAdminInfo').value = '';


    const btnSubmit = document.getElementById("newRoleFormBtnSubmit");    
    btnSubmit.disabled = false;
    btnSubmit.innerHTML = '<i class="fas fa-save"></i> Guardar';

    document.getElementById('form-control-menu-items').classList.remove('is-valid');
    document.getElementById('form-control-menu-items').classList.remove('is-invalid');

    document.querySelectorAll('.validate').forEach((element) => {
        element.classList.remove('is-valid');
        element.classList.remove('is-invalid');
    });

    document.querySelectorAll('.form-check-input').forEach((element) => {
        element.checked = false;
    });  

});

/**
 * Validación para seleccionr como mínimo un menú
 * @return {[type]} [description]
 */
function validateSelecttionMenuItems() {   
    let selectedItems = 0;
    document.querySelectorAll('.form-check-input').forEach((element) => {
        if(element.checked) {
            selectedItems ++;
            if (selectedIdMenuItems.indexOf(element.value) === -1) {
                selectedIdMenuItems.push(element.value);                
            }            
        }

        else {
            selectedIdMenuItems = selectedIdMenuItems.filter((index)  => index !== element.value);
        }
    });  

    if (selectedItems > 0) {
        document.getElementById('form-control-menu-items').classList.add('is-valid');
        document.getElementById('form-control-menu-items').classList.remove('is-invalid');
    }

    else {
        document.getElementById('form-control-menu-items').classList.add('is-invalid');
        document.getElementById('form-control-menu-items').classList.remove('is-valid');
    }

    return selectedItems > 0 ? true : false;
}

/**
 * [load_role_list description]
 * @return {[type]} [description]
 */
async function loadRoleList() {

    showLoader();    

    try {        

        const response = await axios(
            {
                method : 'get', 
                url : baseUrl('app/roles/get_role_list')
            }
        );

        if (response.data.response_code === 200) {
            document.getElementById('roleListTableContainer').innerHTML = response.data.html_role_list;        
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

function showLoader() {
    document.getElementById('roleListTableContainer').innerHTML = `
    <p class="text-center p-5">
        <i class="fas fa-spinner fa-spin fa-5x text-primary"></i>
        <br>
        <br>
        Cargando, por favor espera...
    </p>
    `;
}

/**
 * Eliminamos (lógicamente) el rol (no los menus asignados)
 * @param  {[type]} role_id [description]
 * @return {[type]}         [description]
 */
async function deleteRole(role_id) {
    if (confirm('¿Realmente deseas eliminar este rol?\n\nEsta opción no puede deshacerse')) {

        showLoader();        

        try {

            const bodyFormData = new FormData();
            bodyFormData.append('role_id', role_id);
            const response = await axios(
                {
                    method : 'post', 
                    url : baseUrl('app/roles/delete'), 
                    data : bodyFormData, 
                    headers: { 
                        "Content-Type": "multipart/form-data" 
                    }
                }
            );

            if (response.data.response_code === 200) {
                notifier.success(
                    'Rol eliminado',
                    {
                        labels : {
                            success : '¡Hecho!'
                        }
                    }
                );

            }
        }

        catch (exception) {
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
    }
}
