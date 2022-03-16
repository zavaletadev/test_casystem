<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    private $role_id;

    function __construct()
    {
        parent::__construct();
        
        is_user_logged_in();        
        $this->role_id = $this->session->userdata('role_id');        
        validate_role_access($this->role_id, $menuitem_id = 2);
        $this->load->model('user_model');
        $this->load->model('role_model');
    }

    function index()
    {        
        /*
        Inicializamos el data middleware con las 
        secciones de menú autorizadas al usuario 
        con base en su rol
         */
        $data = array(
            'html_nav' => get_role_nav($this->role_id),                         
            'roles_list' => $this->role_model->get_role_list(),
            //Agregamos los scripst al middleware
            //indicamos la ruta relativa partiendo de static/js/admin
            'js_scripts' => [
                'users.js', 
                'edit_user.js'                
            ]            
        );

        /*
        Añadimos los componentes visuales 
        que se renderizan en ventanas modales
         */
        $data['modals'] = [
            $this->load->view(
                'private/components/modals/newuser_m', 
                $data, 
                TRUE
            ), 
            $this->load->view(
                'private/components/modals/edituser_m', 
                $data, 
                TRUE
            )
        ];

         /**
         * Personalizamos el MainView y los componentes
         * del fragment agregandolos a middleware
         */
         $data['_APP_COMPONENTS']  = array(
            'title'    => 'Administración de usuarios', 
            'nav'      => $this->load->view('private/components/app_nav', $data, TRUE),
            'fragment' => $this->load->view('private/components/fragments/userlist_f', $data, TRUE)
        );        
         $this->load->view('private/main_v', $data, FALSE);

     }

     /**
     * Lista de tabla usuarios
     * @return [type] [description]
     */
     function get_user_list()
     {
        $data = array(
            'users_list' => $this->user_model->get_user_list(),       
        );

        echo json_encode(
            array(
                'response_code' => 200, 
                'html_user_list' => $this->load->view('private/components/fragments/userlisttable_f', $data, TRUE)
            )
        );
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    function create()
    {
        json_header();

        $this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
        $this->form_validation->set_rules('email_auth', 'email_auth', 'trim|required');
        $this->form_validation->set_rules('telefono_auth', 'telefono_auth', 'trim|required');        
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role_id', 'trim|required');
        $this->form_validation->set_rules('bio', 'bio', 'trim');

        if ($this->form_validation->run()) {
            $first_name    = $this->input->post('first_name');
            $last_name     = $this->input->post('last_name');
            $email_auth    = $this->input->post('email_auth');
            $telefono_auth = $this->input->post('telefono_auth');            
            $password      = $this->input->post('password');
            $role_id       = $this->input->post('role_id');
            $bio           = $this->input->post('bio');

            $arr_insert_user = array(
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'auth_email'    => $email_auth,
                'auth_phone'    => $telefono_auth,                
                'password'      => md5($password),
                'role_id'       => $role_id,
                'bio'           => $bio, 
                'date_added'    => date('Y-m-d'), 
                'status'        => 'ACTIVE'
            );



            $this->user_model->create($arr_insert_user);

            echo json_encode(                    
                array(
                    "response_code" => 200,
                )
            );

        }

        else {
            echo json_encode(                    
                array(
                    "response_code" => 400,
                )
            );
        }
    }

    /**
     * [delete description]
     * @return [type] [description]
     */
    function delete()
    {
        json_header();

        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');

        if ($this->form_validation->run()) {

            $user_id = $this->input->post('user_id');

            $this->user_model->edit(
                $user_id, 
                array(
                    'status' => 'DELETED'
                )
            );

            echo json_encode(                    
                array(
                    "response_code" => 200,
                )
            );
        }

        else {
            echo json_encode(                    
                array(
                    "response_code" => 400,
                )
            );
        }        
    }

    /**
     * [get_user description]
     * @return [type] [description]
     */
    function get_user()
    {
        json_header();

        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');

        if ($this->form_validation->run()) {

            $user_id = $this->input->post('user_id');

            $user_data = $this->user_model->get_user($user_id);

            echo json_encode(                    
                array(
                    "response_code" => !is_null($user_data) ? 200 : 404,
                    "user_data" => $user_data                    
                )
            );
        }

        else {
            echo json_encode(                    
                array(
                    "response_code" => 400,
                )
            );
        }        
    }

    /**
     * [edit description]
     * @return [type] [description]
     */
    function edit()
    {
        json_header();

        $this->form_validation->set_rules('first_name', 'first_name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last_name', 'trim|required');
        $this->form_validation->set_rules('email_auth', 'email_auth', 'trim|required');
        $this->form_validation->set_rules('telefono_auth', 'telefono_auth', 'trim|required');        
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('role_id', 'role_id', 'trim|required');
        $this->form_validation->set_rules('bio', 'bio', 'trim');

        if ($this->form_validation->run()) {
            $user_id       = $this->input->post('user_id');
            $first_name    = $this->input->post('first_name');
            $last_name     = $this->input->post('last_name');
            $email_auth    = $this->input->post('email_auth');
            $telefono_auth = $this->input->post('telefono_auth');            
            $password      = $this->input->post('password');
            $role_id       = $this->input->post('role_id');
            $bio           = $this->input->post('bio');

            $arr_update_user = array(
                'first_name'      => $first_name,
                'last_name'       => $last_name,
                'auth_email'      => $email_auth,
                'auth_phone'      => $telefono_auth,                
                'password'        => md5($password),
                'role_id'         => $role_id,
                'bio'             => $bio, 
                'date_lastupdate' => date('Y-m-d'), 
                'status'          => 'ACTIVE'
            );



            $this->user_model->edit(
                $user_id, 
                $arr_update_user
            );

            echo json_encode(                    
                array(
                    "response_code" => 200,
                )
            );

        }

        else {
            echo json_encode(                    
                array(
                    "response_code" => 400,
                )
            );
        }
    }    

}

/* End of file Users.php */
/* Location: ./application/controllers/app/Users.php */
