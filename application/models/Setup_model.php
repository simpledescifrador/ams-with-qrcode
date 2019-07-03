<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); //Initialize Database
        
    }

    function is_complete_registered()
    {
        $this->db->select('*');
        $this->db->from('tbl_setup');
        $this->db->where('setup_register', TRUE);
        $this->db->limit(1);
        
        $query = $this->db->get();

        return $query->num_rows() == 1? true : false;
    }

    function set_completed_register($is_completed)
    {
    
        //update setup data in tbl_setup table
        $update_result = $this->db->update('tbl_setup', array('setup_register' => $is_completed));

        //return the status
        return $update_result ? true : false;
    }
}