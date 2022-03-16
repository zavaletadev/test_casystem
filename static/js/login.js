 /**
  * Notificaciones
  * @type {AWN}
  */
 const globalAwnOptions = {
    labels : {
        success : ''
    }, 
    durations : {
        success : 2000
    }
 };
 let notifier = new AWN(globalAwnOptions);

/**
 * Referencia a la modal
 * @type {bootstrap}
 */
const fakerecoverModal = new bootstrap.Modal(document.getElementById('fakerecoverModal'));

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
});

/**
 * Autenticación del usuario
 * @param  {[type]} 'authForm').addEventListener('submit', (event        [description]
 * @return {[type]}                                        [description]
 */
document.getElementById('authForm').addEventListener('submit', async (event) => {    
    event.preventDefault();
    const authFormSubmitBtn = document.getElementById('authFormSubmitBtn');
    const initText = authFormSubmitBtn.innerHTML;
    authFormSubmitBtn.disabled = true;
    authFormSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;Autenticando, por favor espera...';

    try {

        const bodyFormData = new FormData();
        bodyFormData.append('username', document.getElementById('floatingUsername').value);
        bodyFormData.append('password', document.getElementById('floatingPassword').value);


        const response = await axios(
            {
                method : 'post', 
                url : baseUrl('login/auth'), 
                data : bodyFormData, 
                headers: { 
                    "Content-Type": "multipart/form-data" 
                }
            }
        );

        if (response.data.response_code === 200) {
            notifier.success(
                'Redirigiendo al panel...',
                {
                    labels : {
                        success : `Hola ${response.data.first_name} ¡bienvenido de nuevo!`
                    }
                }
            );
            window.location.href = baseUrl('app/dashboard');

        }

        else {
            notifier.alert(
                'Por favor vuelve a intentarlo',
                {
                    labels : {
                        alert : 'Usuario / contraseña incorrectos'
                    }
                }
            );                

            authFormSubmitBtn.disabled = false;
            authFormSubmitBtn.innerHTML = initText;
        }    
        
    }

    catch(exception) {
        notifier.alert(
            'Por favor vuelve a intentarlo',
            {
                labels : {
                    alert : 'Ocurrió un error'
                }
            }
        );
    }
    
});

/**
 * Llamado a la modal de recovery
 * @param  {[type]} '.fakerecoverModalLink').forEach((link) [description]
 * @return {[type]}                                         [description]
 */
document.querySelectorAll('.fakerecoverModalLink').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();        
        fakerecoverModal.show();
    });
});
        
