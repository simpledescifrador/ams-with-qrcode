<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
        
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); //Initialize Database
        
    }

    /** 
     * Delete user Record
    * 
    * @param  int user id
    * @return boolean delete result
    */
    public function delete($id)
    {
        //update user from tbl_users table

        $delete = $this->db->delete('tbl_users', array('user_id' => $id));
        //return the status
        return $delete ? true : false;
    }

    /** 
     * Update user Record
    * 
    * @param array fields and user_id
    * @return boolean update result
    */
    public function update($data, $id)
    {
        //update user data in tbl_users table
        $update_result = $this->db->update('tbl_users', $data, array('user_id' => $id));

        //return the status
        return $update_result ? true : false;
    }

    /** 
     * Add New user
    * 
    * @param array fields 
    * @return int_or_boolean if successful insert return insert id otherwise false
    */
    function insert($data) {
        $insert_result = $this->db->insert('tbl_users', $data);

        //return the status
        return $insert_result ? $this->db->insert_id() : false;
    }

    /** 
     * Get/Fetch users data
    * 
    * @param array conditions 
    * @return array fetched data from table tbl_users
    */
    function get($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        //fetch data by conditions
        if (array_key_exists('conditions', $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('user_id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            //set start and limit
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $this->db->count_all_results();
            } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->row_array() : false;
            } else {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : false;
            }
        }

        //return fetched data
        return $result;
    }

        /* --------------- CUSTOM MODEL FUNCTION STARTS HERE ------------------ */


    /** 
     * Validate Login/User Data
    * 
    * @param mixed conditions 
    * @return boolean fetched data from table tbl_users
    */
    function login_validation($username, $password)
    {
        $user_data = array(
            'username' => $username,
            'password' => md5($password)
        );

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($user_data);
        $this->db->limit(1);
        
        $query = $this->db->get();

        return $query->num_rows() == 1? true : false;
    }

}