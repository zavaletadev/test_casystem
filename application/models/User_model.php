<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * [get_role_list description]
     * @param  string $status [description]
     * @return [type]         [description]
     */
    function get_user_list($status = 'ACTIVE')
    {
        $cmd = "SELECT u.*, (SELECT role_name FROM role WHERE role.role_id = u.role_id) AS role_name FROM user u ";
        if ($status !== 'ALL') {
            $cmd .= " WHERE status = '$status' ";            
        }

        $query = $this->db->query($cmd);

        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

    /**
     * [create description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function create($data)
    {
        $this->db->insert('user', $data);        

        return TRUE;
    }

    /**
     * [edit description]
     * @param  [type] $user_id [description]
     * @param  [type] $data    [description]
     * @return [type]          [description]
     */
    function edit($user_id, $data)
    {
        $this->db->where('user_id', $user_id);        
        $this->db->update('user', $data);

        return TRUE;
    }

    /**
     * [get_user description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    function get_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'ACTIVE');
        $query = $this->db->get('user');

        return $query->num_rows() === 1 ? $query->row() : NULL;
    }

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
