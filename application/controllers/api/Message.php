<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

    /**
     * [index description]
     * @return [type] [description]
     * @example [GET] https://test-cas.zavaletazea.dev/api/message
     */
    function index()
    {
        json_header();

        echo json_encode(
            array(
                'response_code' => 200, 
                'message' => get_global_setting('rest_message')
            )
        );        
    }

}

/* End of file Message.php */
/* Location: ./application/controllers/api/Message.php */
