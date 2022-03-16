<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

    private $role_id;

    function __construct()
    {
        parent::__construct();        
        is_user_logged_in();                
        $this->role_id = $this->session->userdata('role_id');        
        validate_role_access($this->role_id, $menuitem_id = 3);
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
            'menuitems_list' => $this->role_model->get_menu_items(), 
            //Agregamos los scripst al middleware
            //indicamos la ruta relativa partiendo de static/js/admin
            'js_scripts' => [
                'roles.js', 
                'edit_role.js'                
            ]            
        );

        /*
        Añadimos los componentes visuales 
        que se renderizan en ventanas modales
         */
        $data['modals'] = [
            $this->load->view(
                'private/components/modals/newrol_m', 
                $data, 
                TRUE
            ), 
            $this->load->view(
                'private/components/modals/editrol_m', 
                $data, 
                TRUE
            )
        ];

        /**
         * Personalizamos el MainView y los componentes
         * del fragment agregandolos a middleware
         */
        $data['_APP_COMPONENTS']  = array(
            'title'    => 'Administración de roles', 
            'nav'      => $this->load->view('private/components/app_nav', $data, TRUE),
            'fragment' => $this->load->view('private/components/fragments/rolelist_f', $data, TRUE)
        );        
        $this->load->view('private/main_v', $data, FALSE);
    }

    /**
     * Creación de roles y menú
     * @return [type] [description]
     */
    function create()
    {
        json_header();
        
        $this->form_validation->set_rules('role_name', 'role_name', 'trim|required');
        $this->form_validation->set_rules('show_admin', 'show_admin', 'trim|required');
        $this->form_validation->set_rules('menu_items', 'menu_items', 'trim|required');

        if ($this->form_validation->run()) {

            $role_name = $this->input->post('role_name');
            $show_admin = $this->input->post('show_admin'); 
            $menu_items = explode(",", $this->input->post('menu_items'));

            $arr_create_role = array(
                'role_name' => $role_name, 
                'show_admin_info' => $show_admin, 
                'date_added' => date('Y-m-d H:i:s'), 
                'status' =>'ACTIVE'
            );

            $new_rol_id = $this->role_model->create_role($arr_create_role);

            $arr_batch_menu_items = array();

            foreach($menu_items as $menu_item) {
                $arr_batch_menu_items[] = array(
                    'role_id' => $new_rol_id, 
                    'menuitem_id' => $menu_item, 
                    'date_added' => date('Y-m-d H:i:s')
                );
            }

            $this->role_model->add_menu_role($arr_batch_menu_items);

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
     * Lista de tablas de roles
     * @return [type] [description]
     */
    function get_role_list()
    {
        $data = array(
            'roles_list' => $this->role_model->get_role_list(),       
        );

        echo json_encode(
            array(
                'response_code' => 200, 
                'html_role_list' => $this->load->view('private/components/fragments/rolelisttable_f', $data, TRUE)
            )
        );
    }

    /**
     * [delete description]
     * @return [type] [description]
     */
    function delete()
    {
        json_header();

        $this->form_validation->set_rules('role_id', 'role_id', 'trim|required');

        if ($this->form_validation->run()) {

            $role_id = $this->input->post('role_id');

            $this->role_model->edit_role(
                $role_id, 
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
     * [get_role description]
     * @return [type] [description]
     */
    function get_role()
    {
        json_header();

        $this->form_validation->set_rules('role_id', 'role_id', 'trim|required');

        if ($this->form_validation->run()) {

            $role_id = $this->input->post('role_id');

            $role_data = $this->role_model->get_role($role_id);

            echo json_encode(                    
                array(
                    "response_code" => !is_null($role_data) ? 200 : 404,
                    "role_data" => $role_data,
                    "menuitems_data" => !is_null($role_data) ? $this->role_model->get_role_items($role_id) : NULL,
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
        
        $this->form_validation->set_rules('role_id', 'role_id', 'trim|required');
        $this->form_validation->set_rules('role_name_edit', 'role_name_edit', 'trim|required');
        $this->form_validation->set_rules('show_admin_edit', 'show_admin_edit', 'trim|required');
        $this->form_validation->set_rules('menu_items_edit', 'menu_items_edit', 'trim|required');

        if ($this->form_validation->run()) {

            $role_id = $this->input->post('role_id');
            $role_name = $this->input->post('role_name_edit');
            $show_admin = $this->input->post('show_admin_edit'); 
            $menu_items = explode(",", $this->input->post('menu_items_edit'));

            $arr_update_role = array(
                'role_name' => $role_name, 
                'show_admin_info' => $show_admin, 
                'date_added' => date('Y-m-d H:i:s'), 
                'status' =>'ACTIVE'
            );

            $this->role_model->edit_role(
                $role_id, 
                $arr_update_role
            );

            $this->role_model->clear_menuitems($role_id);

            $arr_batch_menu_items = array();

            foreach($menu_items as $menu_item) {
                $arr_batch_menu_items[] = array(
                    'role_id' => $role_id, 
                    'menuitem_id' => $menu_item, 
                    'date_added' => date('Y-m-d H:i:s')
                );
            }

            $this->role_model->add_menu_role($arr_batch_menu_items);

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

/* End of file Roles.php */
/* Location: ./application/controllers/app/Roles.php */
