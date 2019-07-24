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

    public function render_to_pdf($html_content, $filename)
    {
        $mpdf = new \Mpdf\Mpdf(array(
            'tempDir' => __DIR__ . '/tmp'
        ));
        $mpdf->SetHTMLHeader('This pdf is generated on ' . date("Y-m-d h:i:sa"));
        $mpdf->WriteHTML($html_content);

        $mpdf->Output($filename, 'I');
    }
}