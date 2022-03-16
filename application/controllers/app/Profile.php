<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    private $role_id;
    private $user_id;

    function __construct()
    {
        parent::__construct();
        is_user_logged_in();        
        $this->role_id = $this->session->userdata('role_id');        
        $this->user_id = $this->session->userdata('user_id');        
        validate_role_access($this->role_id, $menuitem_id = 4);
        $this->load->model('profile_model');
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
            'profile_data' => $this->profile_model->get_profile_data($this->user_id)
        );

        /**
         * Personalizamos el MainView y los componentes
         * del fragment agregandolos a middleware
         */
        $data['_APP_COMPONENTS']  = array(
            'title'    => 'Mi Perfíl', 
            'nav'      => $this->load->view('private/components/app_nav', $data, TRUE),
            'fragment' => $this->load->view('private/components/fragments/profile_f', $data, TRUE)
        );        
        $this->load->view('private/main_v', $data, FALSE);
    }

}

/* End of file Profile.php */
/* Location: ./application/controllers/app/Profile.php */
