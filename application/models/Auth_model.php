<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    /**
     * [login description]
     * @param  [type] $username [description]
     * @return [type]           [description]
     */
    public function login($username)
    {
        $cmd = "SELECT user.*, (select show_admin_info from role WHERE role_id = user.role_id) as show_admin_info FROM user WHERE (auth_email LIKE BINARY '$username' OR auth_phone LIKE BINARY '$username') AND status = 'ACTIVE'";

        $query = $this->db->query($cmd);
        return ($query->num_rows() === 1) ? $query->row() : NULL;
    }

    /**
     * Verificamos que un rol tenga acceso a un item de menu 
     * @param  [type] $role_id     [description]
     * @param  [type] $menuitem_id [description]
     * @return [type]              [description]
     */
    function validate_role_access($role_id, $menuitem_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('menuitem_id', $menuitem_id);

        $query = $this->db->get('role_menu_item');

        return ($query->num_rows() === 1) ? $query->row()->menuitem_id : NULL;
    }

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */
