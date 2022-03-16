<?php 
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * [__construct description]
     */
    function __construct()
    {
        parent::__construct();     
        is_user_logged_in($login = TRUE);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    function index()
    {
        $data = array();
        $data['modals'] = array(
            $this->load->view('public/components/fakerecover_modal', $data, TRUE)
        );
        $this->load->view('public/login_v', $data, FALSE);
    }

    /**
     * [auth description]
     * @return [type] [description]
     */
    function auth()
    {
        json_header();

        $this->form_validation->set_rules('username', 'username', 'trim|required|max_length[70]');        
        $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[12]');

        if ($this->form_validation->run()) {
            $this->load->model('auth_model');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $password = md5($password);

            $user_data = $this->auth_model->login($username);

            if (!is_null($user_data)) {
                if($user_data->password === $password) {                    

                    // Convertimos el objeto a arreglo
                    $user_data = (array) $user_data;                    
                    $user_data['signin'] = TRUE;                                        
                    $this->session->sess_expiration = (int) get_global_setting('session_timeout');
                    $this->session->set_userdata( $user_data );
                    $json["response_code"] = 200;
                    $json['first_name'] = $user_data['first_name'];
                } else {
                    $json["response_code"] = 404;
                }
            } else {                
                $json["response_code"] = 404;
            }
            echo json_encode($json);
        }

        else {
            http_error(400);
        }


    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
