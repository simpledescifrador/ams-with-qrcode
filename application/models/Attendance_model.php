<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /** 
     * Delete Attendance Record
    * 
    * @param  int attendance id
    * @return boolean delete result
    */
    public function delete($id)
    {
        //update user from account table

        $delete = $this->db->delete('tbl_attendance', array('attendance_id' => $id));
        //return the status
        return $delete ? true : false;
    }

    /** 
     * Update Attendance Record
    * 
    * @param array fields and attendance_id
    * @return boolean update result
    */
    public function update($data, $id)
    {
        //update attendance data in tbl_attendance table
        $update_result = $this->db->update('tbl_attendance', $data, array('attendance_id' => $id));

        //return the status
        return $update_result ? true : false;
    }

    /** 
     * Add New Attendance Record
    * 
    * @param array fields 
    * @return int_or_boolean if successful insert return insert id otherwise false
    */
    function insert($data) {
        $insert_result = $this->db->insert('tbl_attendance', $data);

        //return the status
        return $insert_result ? $this->db->insert_id() : false;
    }

    /** 
     * Get/Fetch Attendance data
     * 
     * @param array conditions 
     * @return array fetched data from table tbl_attendance
     */
    function get($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_attendance');
        //fetch data by conditions
        if (array_key_exists('conditions', $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('attendance_id', $params['id']);
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

    function recent_attendance()
    {
        $this->db->select('*');
        $this->db->from('tbl_attendance');
        $this->db->limit(5);
        $this->db->order_by('date', 'desc');
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : false;
    }
}