<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

// Load the Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Attendance_api extends REST_Controller {

    /** Add Attendance
     * 
    * @return response scan time
    */
    public function add_attendance_post()
    {
        $qr_code = $this->post('qr_code');
        $status = $this->post('status');
        $remarks = $this->post('remarks');

        //Check if $qrcode is not empty
        if (!empty($qr_code)) {
            //Continue
            $this->load->model('attendance_model'); //Load Attendance Model
            date_default_timezone_set('Asia/Manila');
            $insert_result = $this->attendance_model->insert(
                array(
                    'qr_code' => $qr_code,
                    'date' => date("Y-m-d H:i:s"),
                    'status' => $status,
                    'remarks' => $remarks
                )
            );
            $attendance_data = $this->attendance_model->get(
                array(
                'id' => $insert_result
                )
            );
            $this->response(array(
                "scan_time" => $attendance_data['date']
            ), REST_Controller::HTTP_OK);
            
        } else {
            //Show Response Bad Request
            $this->response("No QR Code found.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /** Check the student qrcode if active
     * 
     * @param qr_code student qr code
    * @return response qrcode status
    */
    public function check_qrcode_status_get($qr_code)
    {
        //Check if $qrcode is not empty
        if (!empty($qr_code)) {
            //Continue
            $this->load->model('qrcode_model'); //Load Qrcode model
            
            $is_active = $this->qrcode_model->get(
                array(
                    'id' => $qr_code
                )
            );
            
            if($is_active) {
                //Show Response OK
                $this->response(
                    array(
                        'qrcode_status' => $is_active[0]['status']
                    ), REST_Controller::HTTP_OK
                );
            }
        } else {
            //Show Response Bad Request
            $this->response("No QR Code found.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}