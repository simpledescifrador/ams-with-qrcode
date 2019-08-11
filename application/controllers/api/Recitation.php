<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

// Load the Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';

class Recitation extends REST_Controller
{
    
    public function add_recitation_post()
    {
        $qr_code = $this->post('qr_code');

        if (!empty($qr_code)) {
            $this->load->model('recitation_model');

            $insert_result = $this->recitation_model->insert(
                array(
                    'qr_code' => $qr_code,
                    'date' => date('Y-m-d H:i:s')
                )
            );

            $recitation_data = $this->recitation_model->get(array(
                'id' => $insert_result
            ));
            
            $this->response(array(
                "scan_time" => $recitation_data['date']
            ), REST_Controller::HTTP_OK);

        } else {
            //Show Response Bad Request
            $this->response("No QR Code found.", REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
}