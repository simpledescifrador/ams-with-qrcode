<?php
use Dompdf\Css\Stylesheet;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_generator extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        
    }

    public function student_qrcode_to_pdf($qr_code)
    {

        $this->load->model('student_model');
        $this->load->model('qrcode_model');

        $qrcode_path = base_url('uploads/students/qrcode/' . $qr_code . '.png');

        $qrcode_con['returnType'] = 'single';
        $qrcode_con['conditions'] = array(
            'qr_code' => $qr_code
        );

        $qrcode_details = $this->qrcode_model->get($qrcode_con);

        $student_con['returnType'] = 'single';
        $student_con['conditions'] = array(
            'student_id' => $qrcode_details['student_id']
        );

        $student_details = $this->student_model->get($student_con);

        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        ); 
        $data['title'] = ucfirst("QR Code");
        $html_content = $this->load->view('report_templates/students_qrcode', $data, true);
        $this->render_to_pdf($html_content,"QRCODE_" . time() . ".pdf" );
    }

    public function section_qrcode_to_pdf($section_id)
    {
        $this->load->model('student_model');
        $this->load->model('qrcode_model');
        $this->load->model('section_model');

        $qrcodes = array();

        $student_con['conditions'] = array(
            'section_id' => $section_id
        );

        $student_data = $this->student_model->get($student_con);

        foreach ($student_data as $key => $value) {
            //Check if student qrcode exist
            $is_exist = $this->qrcode_model->is_student_qrcode_exist($value['student_id']);
            
            if($is_exist) {
                //Get Qrcode
                $qrcodes[$key] = $is_exist;
            } else {
                //Generate for qrcode
                $this->load->library('ciqrcode');
                if (!is_dir('uploads/students/qrcode/')) {
                    mkdir('uploads/students/qrcode/', 0777, TRUE);
                }
                $student_con['returnType'] = 'single';
                $student_con['conditions'] = array(
                    'student_id' => $value['student_id']
                );
    
                $student_details = $this->student_model->get($student_con);
    
                $section_con['returnType'] = 'single';
                $section_con['conditions'] = array(
                    'section_id' => $student_details['section_id']
                );
    
                $section_details = $this->section_model->get($section_con);
    
                $this->load->helper('string');
                $data = array(
                    'qr_code' => random_string('alnum', 16),
                    'name' => $student_details['first_name'] . " " . $student_details['last_name'],
                    'section' => $section_details['name']
                );
                
                //Insert New
                $qrcode_data = array(
                    'qr_code' => $data['qr_code'],
                    'student_id' => $value['student_id'],
                    'status' => 1
                );
                $insert_result = $this->qrcode_model->insert($qrcode_data);

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

                $qrcodes[$key] = $output['qrCode'];
            }
        }

        $qrcode_paths = array();
        foreach ($qrcodes as $key => $value) {
            $qrcode_paths[$key] = base_url('uploads/students/qrcode/' . $value . '.png');
        }

        foreach ($qrcode_paths as $key => $value) {
            $qrcode_con['returnType'] = 'single';
            $qrcode_con['conditions'] = array(
                'qr_code' => $qrcodes[$key]
            );
    
            $qrcode_details = $this->qrcode_model->get($qrcode_con);
    
            $student_con['returnType'] = 'single';
            $student_con['conditions'] = array(
                'student_id' => $qrcode_details['student_id']
            );
    
            $student_details = $this->student_model->get($student_con);
    
            $data['qrcode_details'][] = array(
                'qrcode_path' => $qrcode_paths[$key],
                'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
            ); 

        }
        $section_data = $this->section_model->get(array('id' => $section_id));

        $data['title'] = ucfirst("Section " . $section_data['name'] . " QR Code");
        $html_content = $this->load->view('report_templates/students_qrcode', $data, true);
        $this->render_to_pdf($html_content,"QRCODE_" . time() . ".pdf" );
    }

    public function render_to_pdf($html_content, $filename)
    {
        $mpdf = new \Mpdf\Mpdf(array(
            'tempDir' => 'vendor/mpdf/mpdf/tmp'
        ));
        $mpdf->SetHTMLHeader('This pdf is generated on ' . date("Y-m-d h:i:sa"));
        $mpdf->WriteHTML($html_content);

        $mpdf->Output($filename, 'I');
    }
}