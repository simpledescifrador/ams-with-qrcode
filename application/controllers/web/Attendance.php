<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('attendance_model'); //Load Attendance Model
        date_default_timezone_set('Asia/Manila');
    }

    public function view_attendance()
    {
        $section_id = $this->input->get('section-id');
        $date = $this->input->get('date');

        if (!isset($section_id, $date)) {
            show_404();
        } else {
            $this->load->model('section_model');
            $section_data = $this->section_model->get(array('id' => $section_id));
            

            $data['title'] = ucfirst('View Attendance | Attendance Monitoring System');
            $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);
            $data['panel_title'] = "Section " . $section_data['name'] . " Attendance";
            $data['attendance_date'] = $date;
            // $data['date'] = date_format(date_create($date), "D, M d, Y");


            $this->load->model('student_model');
            $this->load->model('qrcode_model');
            $this->load->model('attendance_model');
            
            
            $student_con['conditions'] = array(
                'section_id' => $section_id
            );
            $student_data = $this->student_model->get($student_con);
            
            if ($student_data) {
                foreach ($student_data as $key => $value) {
                    $student_id = $value['student_id'];
    
                    $data['attendance'][$key]['student_id'] = $student_id;
                    $data['attendance'][$key]['student_name'] = $value['last_name'] . ", " . $value['first_name'] . " " . $value['middle_name'] . " ";
    
                    //Get Qrcode
                    $qrcode_con['returnType'] = 'single';
                    $qrcode_con['conditions'] = array(
                        'student_id' => $student_id
                    );
    
                    $qrcode_data = $this->qrcode_model->get($qrcode_con);
    
                    $start_date = $date . " 00:00:00";
                    $end_date = date('Y-m-d', strtotime('+1 day', strtotime($date))) . " 00:00:00";
                    
    
                    //Get Attendance
                    $attendance_con['returnType'] = 'single';
                    $attendance_con['conditions'] = array(
                        'qr_code' => $qrcode_data['qr_code'],
                        'date >=' => $start_date,
                        'date <' => $end_date
                    );
    
                    $attendance_data = $this->attendance_model->get($attendance_con);
    
                    if ($attendance_data) {
                        //True
                        $data['attendance'][$key]['attendance_id'] = $attendance_data['attendance_id'];
                        $data['attendance'][$key]['remark'] = $attendance_data['remarks'];
                    } else {
                        //false 
                        $data['attendance'][$key]['remark'] = null;
                        $data['attendance'][$key]['attendance_id'] = null;
                    }
                }
            } else {
                $data['attendance'] = array();
            }
            

            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/attendance_view', $data);
            $this->load->view('dashboard/footers/dashboard_footer');
            $this->load->view('dashboard/footers/attendance_view_footer', $data);
        }
        


    }

    public function mark_attendance()
    {
        $student_ids = $this->input->post('student_ids');
        $remark = $this->input->post('remark');
        $date = $this->input->post('date');
        
        if (!isset($student_ids, $remark, $date)) {
            echo "Error";
        } else {
            for ($i=0; $i < count($student_ids); $i++) {
                $student_id = $student_ids[$i];
                $this->load->model('student_model');
                $student_data = $this->student_model->get(array('id' => $student_id));

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
                        'date' => date('Y-m-d H:i:s', strtotime($date)),
                        'status' => "",
                        'remarks' => $remark
                    )
                );
                if (!$insert_result) {
                    echo "Error";
                    break;
                }
            }
            //No Error
            echo "Success";
        }
    
    }

    public function new_attendance()
    {

        $student_id = $this->input->post('student_id');
        $remark = $this->input->post('remark');
        $date = $this->input->post('date');
        
        
        $this->load->model('student_model');
        $student_data = $this->student_model->get(array('id' => $student_id));

        if (empty($student_id)) {
            echo "Please enter the student id";
        } else if (!$student_data) {
            echo "Invalid student id";
        } else {
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
                    'date' => date('Y-m-d H:i:s', strtotime($date)),
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