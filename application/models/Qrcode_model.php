<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Qrcode_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
    }

    /** 
     * Delete qrcode Record
    * 
    * @param  int qrcode id
    * @return boolean delete result
    */
    public function delete($id)
    {
        //update qrcode from tbl_qrcodes table

        $delete = $this->db->delete('tbl_qrcodes', array('qrcode' => $id));
        //return the status
        return $delete ? true : false;
    }

    /** 
     * Update Qrcode Record
    * 
    * @param array fields and qrcode_id
    * @return boolean update result
    */
    public function update($data, $id)
    {
        //update qrcode data in tbl_qrcodes table
        $update_result = $this->db->update('tbl_qrcodes', $data, array('qrcode' => $id));

        //return the status
        return $update_result ? true : false;
    }

    /** 
     * Add New QR Codes
    * 
    * @param array fields 
    * @return int_or_boolean if successful insert return insert id otherwise false
    */
    function insert($data) {
        $insert_result = $this->db->insert('tbl_qrcodes', $data);

        //return the status
        return $insert_result ? true : false;
    }

    /** 
     * Get/Fetch Qrcodes data
    * 
    * @param array conditions 
    * @return array fetched data from table tbl_qrcodes
    */
    function get($params = array())
    {
        $this->db->select('*');
        $this->db->from('tbl_qrcodes');
        //fetch data by conditions
        if (array_key_exists('conditions', $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('qr_code', $params['id']);
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


}