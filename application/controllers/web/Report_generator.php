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
        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        );
        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        );
        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        );
        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        );
        $data['qrcode_details'][] = array(
            'qrcode_path' => $qrcode_path,
            'name' => $student_details['first_name'] . ' ' . $student_details['middle_name'] . ' ' . $student_details['last_name']
        );
        $this->load->view('report_templates/students_qrcode', $data);
        $html_content = $this->output->get_output();
        // $this->render_to_pdf($html_content, 'student' . $qrcode_details['student_id']);
    }

    public function render_to_pdf($html_content, $file_name)
    {
        $this->pdf->loadHtml($html_content);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->setCss(new Stylesheet($this->pdf));

        $this->pdf->render();
        $this->pdf->stream($file_name.".pdf", array("Attachment"=>0));
    }
}