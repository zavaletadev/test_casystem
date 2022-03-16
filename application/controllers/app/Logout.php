<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index()
    {        
        $this->session->sess_destroy();        
        redirect(base_url('login'), 'refresh');    
    }

}

/* End of file Logout.php */
/* Location: ./application/controllers/app/Logout.php */
