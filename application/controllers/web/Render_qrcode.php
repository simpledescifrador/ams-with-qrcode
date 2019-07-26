<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Render_qrcode extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ciqrcode');
        
    }

    public function generate_student_qrcode($student_id)
    {
        if (!isset($student_id)) {
            echo "Error";
        } else {
            if (!is_dir('uploads/students/qrcode/')) {
                mkdir('uploads/students/qrcode/', 0777, TRUE);
            }
            $this->load->model('student_model');
            $student_con['returnType'] = 'single';
            $student_con['conditions'] = array(
                'student_id' => $student_id
            );

            $student_details = $this->student_model->get($student_con);

            $this->load->model('section_model');
            $section_con['returnType'] = 'single';
            $section_con['conditions'] = array(
                'section_id' => $student_details['section_id']
            );

            $section_details = $this->section_model->get($section_con);

            $this->load->helper('string');
            $data = array(
                'qr_code' => random_string('alnum', 16),
                'name' => $student_details['first_name'] . " " . $student_details['last_name'],
                'section' => $section_details['name'],
                'student_image' => $student_details['profile_image_url']
            );


            $this->load->model('qrcode_model');
            $qrcode_con['returnType'] = 'single';
            $qrcode_con['conditions'] = array(
                'student_id' => $student_id
            ); 

            $exist = $this->qrcode_model->get($qrcode_con);

            if (!$exist) {
                //Insert New
                $qrcode_data = array(
                    'qr_code' => $data['qr_code'],
                    'student_id' => $student_id,
                    'status' => 1
                );
                $insert_result = $this->qrcode_model->insert($qrcode_data);
    
                if ($insert_result) {
                    $params['data'] = json_encode($data);
                    $params['level'] = 'S';
                    $params['size'] = 3;
                    $params['savename'] = FCPATH . 'uploads/students/qrcode/'. $data['qr_code'] . '.png';
                    $this->ciqrcode->generate($params);
                    $qrcode_url = base_url('uploads/students/qrcode/'. $data['qr_code'] . '.png');
                    $output = array(
                        'qrCode' => $data['qr_code'],
                        'qrCodeUrl' => $qrcode_url
                    );
                    echo json_encode($output);
    
                } else {
                    echo "error";
                }
            } else {    
                //Use Existing QRcode
                $qrcode_url = base_url('uploads/students/qrcode/'. $exist['qr_code'] . '.png');
                $output = array(
                    'qrCode' => $exist['qr_code'],
                    'qrCodeUrl' => $qrcode_url
                );
                echo json_encode($output);
            }
            
            
            
        }
        
    }
}