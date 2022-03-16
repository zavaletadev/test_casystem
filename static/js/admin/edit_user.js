/**
 * Referencia a la modal
 * @type {bootstrap}
 */
const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));

/**
 * [selectedId description]
 * @type {[type]}
 */
let selectedId = null;

/**
 * [showEditModal description]
 * @param  {[type]} user_id [description]
 * @return {[type]}         [description]
 */
async function showEditModal(user_id) {    
    editUserModal.show();

    const form = document.getElementById('editUserForm');
    const btnSubmit = document.getElementById("editUserFormBtnSubmit");
    const init = btnSubmit.innerHTML;
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Cargando usuario, por favor espera...';

    document.getElementById('first_name_edit').disabled = true;
    document.getElementById('last_name_edit').disabled = true;
    document.getElementById('email_auth_edit').disabled = true;
    document.getElementById('telefono_auth_edit').disabled = true;
    document.getElementById('password_edit').disabled = true;
    document.getElementById('role_id_edit').disabled = true;
    document.getElementById('bio_edit').disabled = true;

    const bodyFormData = new FormData();
    bodyFormData.append('user_id', user_id);

    try {
        const response = await axios(
            {
                method : 'post', 
                url : baseUrl('app/users/get_user'), 
                data : bodyFormData, 
                headers: { 
                    "Content-Type": "multipart/form-data" 
                }
            }
        );

        if (response.data.response_code === 200) {            
            const user_data = response.data.user_data;

            document.getElementById('first_name_edit').value = user_data.first_name;
            document.getElementById('last_name_edit').value = user_data.last_name;
            document.getElementById('email_auth_edit').value = user_data.auth_email;
            document.getElementById('telefono_auth_edit').value = user_data.auth_phone;
            document.getElementById('role_id_edit').value = user_data.role_id;
            document.getElementById('bio_edit').value = user_data.bio;

            document.getElementById('first_name_edit').disabled = false;
            document.getElementById('last_name_edit').disabled = false;
            document.getElementById('email_auth_edit').disabled = false;
            document.getElementById('telefono_auth_edit').disabled = false;
            document.getElementById('password_edit').disabled = false;
            document.getElementById('role_id_edit').disabled = false;
            document.getElementById('bio_edit').disabled = false;

            selectedId = user_data.user_id;

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

document.getElementById('editUserForm').addEventListener('submit', async (event) => {
    event.preventDefault();        

    const form = document.getElementById('editUserForm');
    const btnSubmit = document.getElementById("editUserFormBtnSubmit");
    const init = btnSubmit.innerHTML;
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Editando usuario, por favor espera...';

    try {            

        const bodyFormData = new FormData();
        bodyFormData.append('user_id', selectedId);
        bodyFormData.append('first_name', document.getElementById('first_name_edit').value);
        bodyFormData.append('last_name', document.getElementById('last_name_edit').value);
        bodyFormData.append('email_auth', document.getElementById('email_auth_edit').value);
        bodyFormData.append('telefono_auth', document.getElementById('telefono_auth_edit').value);
        bodyFormData.append('password', document.getElementById('password_edit').value);
        bodyFormData.append('role_id', document.getElementById('role_id_edit').value);
        bodyFormData.append('bio', document.getElementById('bio_edit').value);

        const response = await axios(
            {
                method : 'post', 
                url : baseUrl('app/users/edit'), 
                data : bodyFormData, 
                headers: { 
                    "Content-Type": "multipart/form-data" 
                }
            }
        );

        if (response.data.response_code === 200) {
            notifier.success(
                'Usuario editado',
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
    editUserModal.hide();        
    
});

/**
 * [description]
 * @param  {Function} 'editUserModal').addEventListener('hidden.bs.modal', ()            [description]
 * @return {[type]}                                                        [description]
 */
document.getElementById('editUserModal').addEventListener('hidden.bs.modal', () => {

    document.getElementById('first_name_edit').value = '';
    document.getElementById('last_name_edit').value = '';
    document.getElementById('email_auth_edit').value = '';
    document.getElementById('telefono_auth_edit').value = '';
    document.getElementById('password_edit').value = '';
    document.getElementById('role_id_edit').value = '';
    document.getElementById('bio_edit').value = '';

    const btnSubmit = document.getElementById("editUserFormBtnSubmit");    
    btnSubmit.disabled = false;
    btnSubmit.innerHTML = '<i class="fas fa-save"></i> Guardar cambios';

    document.querySelectorAll('.validate').forEach((element) => {
        element.classList.remove('is-valid');
        element.classList.remove('is-invalid');
    });

});
