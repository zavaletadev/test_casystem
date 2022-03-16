/**
 * [description]
 * @param  {[type]} 'load' [description]
 * @param  {[type]} (      [description]
 * @return {[type]}        [description]
 */
window.addEventListener('load', () => {    
    loadUserList();
});

/**
 * Referencia a la modal
 * @type {bootstrap}
 */
const newUserModal = new bootstrap.Modal(document.getElementById('newUserModal'));

/**
 * [description]
 * @param  {[type]} 'newUserModalBtn').addEventListener('click', (event        [description]
 * @return {[type]}                                              [description]
 */
document.getElementById('newUserModalBtn').addEventListener('click', (event) => {
    newUserModal.show()
});

/**
 * [description]
 * @param  {Function} '.validate').forEach((element) [description]
 * @return {[type]}                                  [description]
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

document.getElementById('newUserForm').addEventListener('submit', async (event) => {
    event.preventDefault();    
    
    const form = document.getElementById('newUserForm');
    const btnSubmit = document.getElementById("newUserFormBtnSubmit");
    const init = btnSubmit.innerHTML;
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Registrando usuario, por favor espera...';

    try {
        const bodyFormData = new FormData();
        bodyFormData.append('first_name', document.getElementById('first_name').value);
        bodyFormData.append('last_name', document.getElementById('last_name').value);
        bodyFormData.append('email_auth', document.getElementById('email_auth').value);
        bodyFormData.append('telefono_auth', document.getElementById('telefono_auth').value);
        bodyFormData.append('password', document.getElementById('password').value);
        bodyFormData.append('role_id', document.getElementById('role_id').value);
        bodyFormData.append('bio', document.getElementById('bio').value);

        const response = await axios(
            {
                method : 'post', 
                url : baseUrl('app/users/create'), 
                data : bodyFormData, 
                headers: { 
                    "Content-Type": "multipart/form-data" 
                }
            }
        );
    
        if (response.data.response_code === 200) {
            notifier.success(
                'Usuario agregado',
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

    loadUserList();
    newUserModal.hide();
    
});

/**
 * [description]
 * @param  {Function} 'newUserModal').addEventListener('hidden.bs.modal', ()            [description]
 * @return {[type]}                                                       [description]
 */
document.getElementById('newUserModal').addEventListener('hidden.bs.modal', () => {

    document.getElementById('first_name').value = '';
    document.getElementById('last_name').value = '';
    document.getElementById('email_auth').value = '';
    document.getElementById('telefono_auth').value = '';
    document.getElementById('password').value = '';
    document.getElementById('role_id').value = '';
    document.getElementById('bio').value = '';

    const btnSubmit = document.getElementById("newUserFormBtnSubmit");    
    btnSubmit.disabled = false;
    btnSubmit.innerHTML = '<i class="fas fa-save"></i> Guardar';

    document.querySelectorAll('.validate').forEach((element) => {
        element.classList.remove('is-valid');
        element.classList.remove('is-invalid');
    });    

});


/**
 * [loadUserList description]
 * @return {[type]} [description]
 */
async function loadUserList() {

    showLoader();    

    try {        

        const response = await axios(
            {
                method : 'get', 
                url : baseUrl('app/users/get_user_list')
            }
        );

        if (response.data.response_code === 200) {
            document.getElementById('userListTableContainer').innerHTML = response.data.html_user_list;        
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
 * [showLoader description]
 * @return {[type]} [description]
 */
function showLoader() {
    document.getElementById('userListTableContainer').innerHTML = `
    <p class="text-center p-5">
        <i class="fas fa-spinner fa-spin fa-5x text-primary"></i>
        <br>
        <br>
        Cargando, por favor espera...
    </p>
    `;
}

/**
 * [deleteUser description]
 * @param  {[type]} user_id [description]
 * @return {[type]}         [description]
 */
async function deleteUser(user_id) {
    if (confirm('¿Realmente deseas eliminar este usuario?\n\nEsta opción no puede deshacerse')) {

        showLoader();        

        try {

            const bodyFormData = new FormData();
            bodyFormData.append('user_id', user_id);
            const response = await axios(
                {
                    method : 'post', 
                    url : baseUrl('app/users/delete'), 
                    data : bodyFormData, 
                    headers: { 
                        "Content-Type": "multipart/form-data" 
                    }
                }
            );

            if (response.data.response_code === 200) {
                notifier.success(
                    'Usuario eliminado',
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

        loadUserList();
    }
}

