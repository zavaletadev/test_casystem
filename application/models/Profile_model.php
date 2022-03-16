<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    /**
     * Retornamos la información del usuario
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    function get_profile_data($user_id)
    {
        $this->db->where('user_id', $user_id);        
        $query = $this->db->get('user');

        return $query->num_rows() === 1 ? $query->row() : NULL;
    }

}

/* End of file Profile_model.php */
/* Location: ./application/models/Profile_model.php */
