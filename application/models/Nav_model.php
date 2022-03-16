<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Nav_model extends CI_Model {

    /**
     * Retornamos los items de mení asigandos 
     * sal rol del parámetro
     * @param  [type] $rol_id [description]
     * @return [type]         [description]
     */
    function get_role_nav($role_id)
    {
        $cmd = "
        SELECT * FROM menu_item
        WHERE menuitem_id IN (
            SELECT menuitem_id FROM role_menu_item WHERE role_id = $role_id
            ) 
        ORDER BY menu_item.order ASC
        ";

        $query = $this->db->query($cmd);

        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

}

/* End of file Nav_model.php */
/* Location: ./application/models/Nav_model.php */
