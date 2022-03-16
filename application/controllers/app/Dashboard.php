<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $role_id;

    function __construct()
    {
        parent::__construct();

        is_user_logged_in();        
        $this->role_id = $this->session->userdata('role_id');
    }

    function index()
    {
        /*
        Inicializamos el data middleware con las 
        secciones de menú autorizadas al usuario 
        con base en su rol
         */
        $data = array(
            'html_nav' => get_role_nav($this->role_id)
        );

        /**
         * Personalizamos el MainView y los componentes
         * del fragment
         */
        $data['_APP_COMPONENTS']  = array(
            'title'    => 'Dashboard', 
            'nav'      => $this->load->view('private/components/app_nav', $data, TRUE),
            'fragment' => $this->load->view('private/components/fragments/dashboard_f', $data, TRUE)
        );        
        $this->load->view('private/main_v', $data, FALSE);
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/app/Dashboard.php */
