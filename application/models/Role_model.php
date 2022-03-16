<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

    /**
     * Consulta para obtener todos los roles de la tabla role, 
     * por defecto, todos los activos
     * @param  string $status ENUM['ACTIVE', 'DELETED', 'ALL']
     * @return [type]         [description]
     */
    function get_role_list($status = 'ACTIVE')
    {
        if ($status !== 'ALL') {
            $this->db->where('status', $status);        
        }

        $query = $this->db->get('role');

        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

    /**
     * Consulta para obtener todos los items de menu activos
     * @param  string $status [description]
     * @return [type]         [description]
     */
    function get_menu_items($status = 'ACTIVE')
    {
        if ($status !== 'ALL') {
            $this->db->where('status', $status);        
        }

        $query = $this->db->get('menu_item');

        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

    /**
     * [create_role description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function create_role($data)
    {
        $this->db->insert('role', $data);        

        return $this->db->insert_id();
    }

    /**
     * [add_menu_role description]
     * @param [type] $data [description]
     */
    function add_menu_role($data)
    {
        $this->db->insert_batch('role_menu_item', $data);

        return TRUE;
    }

    /**
     * [edit_role description]
     * @param  [type] $role_id [description]
     * @param  [type] $data    [description]
     * @return [type]          [description]
     */
    function edit_role($role_id, $data)
    {
        $this->db->where('role_id', $role_id);        
        $this->db->update('role', $data);

        return TRUE;
    }

    /**
     * [get_role description]
     * @param  [type] $role_id [description]
     * @return [type]          [description]
     */
    function get_role($role_id)
    {
        $this->db->where('role_id', $role_id);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get('role');

        return $query->num_rows() === 1 ? $query->row() : NULL;
    }

    /**
     * [get_role_items description]
     * @param  [type] $role_id [description]
     * @return [type]          [description]
     */
    function get_role_items($role_id)
    {
        $this->db->where('role_id', $role_id);        
        $query = $this->db->get('role_menu_item');
        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

    /**
     * [clear_menuitems description]
     * @return [type] [description]
     */
    function clear_menuitems($role_id)
    {
        $this->db->where('role_id', $role_id);
        $this->db->delete('role_menu_item');

        return TRUE;
    }

}

/* End of file Role_model.php */
/* Location: ./application/models/Role_model.php */
