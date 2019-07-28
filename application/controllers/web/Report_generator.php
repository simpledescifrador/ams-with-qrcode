<?php
use Dompdf\Css\Stylesheet;

if (!defined('BASEPATH')) exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
class Report_generator extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }
    

    public function monthly_section_attendance($section_id)
    {
        $month = $this->input->get('month');
        $year = $this->input->get('year');

        $this->load->model('student_model');
        $this->load->model('section_model');
        $this->load->model('attendance_model');
        $this->load->model('qrcode_model');
        $this->load->model('school_year_model');

        // Get Section Data
        $section_data = $this->section_model->get(array('id' => $section_id));
        $sy_data = $this->school_year_model->get(array('id' => $section_data['sy_id']));

        $spreadsheet = IOFactory::load("assets/templates/monthly-class-attendance-template.xlsx");
        // Retrieve the current active worksheet
        $sheet = $spreadsheet->getActiveSheet();

        //Set attendance year & month
        $sheet->setCellValue('AD3', $year);
        $sheet->setCellValue('AD2', ucfirst($month));

        //Set Section
        $sheet->setCellValue('C2', $section_data['name']);
        //Set School Year
        $sheet->setCellValue('O2', $sy_data['school_year']);

        //Get Students
        $student_con['conditions'] = array(
            'section_id' => $section_id
        );
        $student_data = $this->student_model->get($student_con);
        
        //Sort Student Data LastName by ASC
        usort($student_data, function ($name1, $name2) {
            return $name1['last_name'] <=> $name2['last_name'];
        });

        $start_name_col = "C";
        $start_id_col = "B";


        foreach ($student_data as $key => $value) {
            $current_row = $key+8;
            $student[$key] = array(
                'student_id' => $value['student_id'],
                'student_name' => $value['last_name'] . ", " . $value['first_name'] . " " . $value['middle_name']
            );

            //Set Student ID
            $sheet->setCellValue($start_id_col . $current_row, $student[$key]['student_id']);
            //Set Student Name
            $sheet->setCellValue($start_name_col . $current_row, $student[$key]['student_name']);

            //Set Attendance
            //Get Qrcode id
            $qrcode_con['returnType'] = 'single';
            $qrcode_con['conditions'] = array(
                'student_id' =>  $value['student_id']
            );

            $qrcode_data = $this->qrcode_model->get($qrcode_con);
            $qr_code = $qrcode_data['qr_code'];

            
            $nmonth = date("n", strtotime($month));
            
            if ($nmonth != 12) {
                // Start date
                $start_date = $year . '-' . $nmonth .'-01 00:00:00';
                // End date
                $end_date = $year . '-' . ($nmonth+1) .'-01 00:00:00';
            } else {
                // Start date
                $start_date = $year . '-' . $nmonth .'-01 00:00:00';
                // End date
                $end_date = ($year+1) . '-01-01 00:00:00';
            }
            
            //Get Attendance
            $attendance_con['conditions'] = array(
                'qr_code' => $qr_code,
                'date >=' => $start_date,
                'date <' => $end_date
            );

            $attendance_data = $this->attendance_model->get($attendance_con);

            $start_attendance_col_num = 5;

            if ($attendance_data) {
                //Set Attendance
                foreach ($attendance_data as $key => $value) {
                    $day = date("j", strtotime($value['date']));
                    $remark = substr($value['remarks'], 0, 1);

                    $current_col = $day + ($start_attendance_col_num-1);

                    $sheet->getCellByColumnAndRow($current_col, $current_row)->setValue($remark);
                }
            } else {
                continue;
            }

        }

        $this->createExcel($spreadsheet, "section-" . $section_data['name'] . "-attendance" . "-of-" . $month . "-" . $year .".xlsx");
    }

    public function student_attendance($student_id)
    {

        $year = $this->input->get('year');
        
        $this->load->model('student_model');
        $this->load->model('section_model');
        $this->load->model('attendance_model');
        $this->load->model('qrcode_model');
        $this->load->model('school_year_model');
        

        $student_data = $this->student_model->get(array('id' => $student_id));
        $student_name = $student_data['first_name'] . " " . $student_data['middle_name'] . " " . $student_data['last_name'];
        $report_type =$this->input->get('report-type');
        $section_data = $this->section_model->get(array('id' => $student_data['section_id']));
        $sy_data = $this->school_year_model->get(array('id' => $section_data['sy_id']));

        $spreadsheet = IOFactory::load("assets/templates/student-attendance-template.xlsx");
        // Retrieve the current active worksheet 
        $sheet = $spreadsheet->getActiveSheet(); 
        $sheet->setAutoFilter('A1:AK1');

        //Set attendance year
        $sheet->setCellValue('N1', $year); 

        //Set Student Info
        //Set Student Name
        $sheet->setCellValue('B3', $student_name);
        //Set Student ID
        $sheet->setCellValue('K3', $student_id);
        //Set Student Section
        $sheet->setCellValue('P3', $section_data['name']);
        //Set Section School Year
        $sheet->setCellValue('W3', $sy_data['school_year']);


        //Get Qrcode id 
        $qrcode_con['returnType'] = 'single';
        $qrcode_con['conditions'] = array(
            'student_id' => $student_id
        );

        $qrcode_data = $this->qrcode_model->get($qrcode_con);
        $qr_code = $qrcode_data['qr_code'];
        // Start date
        $start_date = $year . '-01-01 00:00:00';
        // End date
        $end_date = ($year+1) . '-01-01 00:00:00';

        //Get Attendance
        $attendance_con['conditions'] = array(
            'qr_code' => $qr_code,
            'date >=' => $start_date,
            'date <' => $end_date
        ); 

        $attendance_data = $this->attendance_model->get($attendance_con);


        $startingColNum = 3;
        //Month Row Num
        $janRowNum = 17;
        $febRowNum = 19;
        $marRowNum = 21;
        $aprRowNum = 23;
        $mayRowNum = 25;
        $junRowNum = 27;
        $julRowNum = 29;
        $augRowNum = 7;
        $septRowNum = 9;
        $octRowNum = 11;
        $novRowNum = 13;
        $decRowNum = 15;


        foreach ($attendance_data as $key => $value) {
            $month = date("m",strtotime($value['date']));
            $day = date("j",strtotime($value['date']));
            $remark = substr($value['remarks'], 0, 1);



            $current_row;
            $current_col = $day + ($startingColNum-1);

            switch ($month) {
                case '01': $current_row = $janRowNum; break;
                case '02': $current_row = $febRowNum; break;
                case '03': $current_row = $marRowNum; break;
                case '04': $current_row = $aprRowNum; break;
                case '05': $current_row = $mayRowNum; break;
                case '06': $current_row = $junRowNum; break;
                case '07': $current_row = $julRowNum; break;
                case '08': $current_row = $augRowNum; break;
                case '09': $current_row = $septRowNum; break;
                case '10': $current_row = $octRowNum; break;
                case '11': $current_row = $novRowNum; break;
                case '12': $current_row = $decRowNum; break;
            }
            
            $sheet->getCellByColumnAndRow($current_col, $current_row)->setValue($remark);

        }

        $this->createExcel($spreadsheet, str_replace(' ', '', strtolower($student_name)) . "_attendance" . "_" . $year .".xlsx");
        
    }

    public function createExcel($spreadsheet, $filename)
    {
        header("Content-type: application/vnd.ms-excel");

        //make it an attachment so we can define filename
        header("Content-Disposition: attachment;filename=" . $filename);

        //create IOFactory object
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        //save into php output
        $writer->save('php://output');
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
                    'section' => $section_details['name'],
                    'student_image' => $student_details['profile_image_url']
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