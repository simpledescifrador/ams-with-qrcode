<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('attendance_model'); //Load Attendance Model
        date_default_timezone_set('Asia/Manila');
    }

    public function new_attendance()
    {

        $student_id = $this->input->post('student_id');
        $remark = $this->input->post('remark');
        

        //Get Qrcode
        $qrcode_con['returnType'] = 'single';
        $qrcode_con['conditions'] = array(
            'student_id' => $student_id
        );

        $this->load->model('qrcode_model');
        $qrcode_data = $this->qrcode_model->get($qrcode_con);
    
        $insert_result = $this->attendance_model->insert(
            array(
                'qr_code' => $qrcode_data['qr_code'],
                'date' => date("Y-m-d H:i:s"),
                'status' => "",
                'remarks' => $remark
            )
        );

        if ($insert_result) {
            echo "Success";
        } else {
            echo "Error";
        }
    }

    public function edit_attendance($attendance_id)
    {
        $date = $this->input->post('date');
        $remark = $this->input->post('remark');

        $update_result = $this->attendance_model->update(
            array(
                'date' => date('Y-m-d H:i:s', strtotime($date)),
                'remarks' => $remark
            ),
            $attendance_id
        );

        if ($update_result) {
            echo "Success";
        } else {
            echo "Error";
        }

    }

    public function remove_attendance($attendance_id)
    {
        $result = $this->attendance_model->delete($attendance_id);

        if ($result) {
            echo 'Success';
        } else {
            echo 'Error';
        }
        
    }
}