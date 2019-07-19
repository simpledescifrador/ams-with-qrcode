<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model {
        
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); //Initialize Database
        
    }

    /** 
     * Delete student Record
    * 
    * @param  int student id
    * @return boolean delete result
    */
    public function delete($id)
    {
        //update student from tbl_students table

        $delete = $this->db->delete('tbl_students', array('student_id' => $id));
        //return the status
        return $delete ? true : false;
    }

    /** 
     * Update student Record
    * 
    * @param array fields and student_id
    * @return boolean update result
    */
    public function update($data, $id)
    {
        //update student data in tbl_students table
        $update_result = $this->db->update('tbl_students', $data, array('student_id' => $id));

        //return the status
        return $update_result ? true : false;
    }

    /** 
     * Add New student
    * 
    * @param array fields 
    * @return int_or_boolean if successful insert return insert id otherwise false
    */
    function insert($data) {
        $insert_result = $this->db->insert('tbl_students', $data);

        //return the status
        return $insert_result ? $this->db->insert_id() : false;
    }

    /** 
     * Get/Fetch Students data
    * 
    * @param array conditions 
    * @return array fetched data from table tbl_students
    */
    function get($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_students');
        //fetch data by conditions
        if (array_key_exists('conditions', $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('student_id', $params['id']);
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

    function remove_section_ids($section_id)
    {
        //update student data in tbl_students table
        $update_result = $this->db->update('tbl_students', array('section_id' => null), array('section_id' => $section_id));

        //return the status
        return $update_result ? true : false;
    }
}