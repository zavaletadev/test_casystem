<?php
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalsettings_model extends CI_Model {

    /**
     * [get_item description]
     * @param  [type] $prop [description]
     * @return [type]       [description]
     */
    function get_item($prop)
    {
        $this->db->where('prop', $prop);        
        $query = $this->db->get('global_settings');

        return $query->num_rows() === 1 ? $query->row()->value : NULL;
    }   

}

/* End of file Globalsettings_model.php */
/* Location: ./application/models/Globalsettings_model.php */
