<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    public function page($slug = 'dashboard') 
    {

        date_default_timezone_set("Asia/Manila");

        if (isset($this->session->userdata['logged_in'])) {

            //Load Login View
            $data['title'] = ucfirst($slug .' | Attendance Monitoring System');
            $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);
            
            $slug = $slug == 'dashboard' ? 'home' : $slug;

            //Load Data to views
            switch ($slug) {
                case 'home':
                    $this->load->model('section_model');
                    $this->load->model('student_model');

                    //get overview
                    $section_con['returnType'] = 'count';
                    $section_count = $this->section_model->get($section_con); // Get Section Count
                    $data['section_count'] = $section_count;

                    $student_con['returnType'] = 'count';
                    $student_count = $this->student_model->get($student_con); //Get Student
                    $data['student_count'] = $student_count;
                    
                    $this->load->model('attendance_model');
                    
                    $late = array();
                    $absent = array();
                    
                    for ($i=0; $i < 10; $i++) {
                        $date = Date('Y-m-d', strtotime("-" . $i . " days"));
                        
                        $late_count = $this->attendance_model->get_late_count($date);
                        $absent_count = $this->attendance_model->get_absent_count($date);

                        $late[] = array(
                            't' => $date,
                            'y' => $late_count
                        );
                    
                        $absent[] = array(
                            't' => $date,
                            'y' => $absent_count
                        );
                    }
                    
                    $data['late'] = json_encode($late);
                    $data['absent'] = json_encode($absent);


                    //Get Most Punctual Students
                    

                    // //Show dashboard View
                    $this->load->view('dashboard/header', $data);
                    $this->load->view('dashboard/home', $data);
                    $this->load->view('dashboard/footers/dashboard_footer');
                    $this->load->view('dashboard/footers/home_footer', $data);
                    break;
                case 'section':
                    $this->load->model('student_model');
                    $this->load->model('school_year_model');
                    $this->load->model('section_model');
                    $sections = $this->section_model->get();
                    if ($sections) {
                        foreach ($sections as $key => $value) {
                            $data['section_data'][$key]['section_id'] = $value['section_id']; 
                            $sy_conditions['conditions'] = array(
                                'sy_id' => $value['sy_id']
                            );
                            $sy_conditions['returnType'] = 'single';
                            $sy = $this->school_year_model->get($sy_conditions);
                            $data['section_data'][$key]['school_year'] = $sy['school_year'];
                            $data['section_data'][$key]['section_name'] = $value['name'];
    
                            $student_con['returnType'] = 'count';
                            $student_con['conditions'] = array(
                                'section_id' => $value['section_id']
                            );
                            $total_student = $this->student_model->get($student_con);
                            $data['section_data'][$key]['total_students'] = $total_student;
                        }
                    } else {
                        //No Section Available
                        $data['section_data'] = array();
                    }
                    //Show dashboard View
                    $this->load->view('dashboard/header', $data);
                    $this->load->view('dashboard/section', $data);   
                    $this->load->view('dashboard/footers/dashboard_footer');
                    $this->load->view('dashboard/footers/section_footer', $data);
                    
                    break;
                case 'student':
                    $this->load->model('section_model');
                    $this->load->model('student_model');
                    $this->load->model('school_year_model');
                    $sections = $this->section_model->get();
                    $data['sections'] = $sections;
                    
                    $students = $this->student_model->get();
                    if ($students) {
                        foreach ($students as $key => $value) {
                            $data['student_data'][$key]['student_id'] = $value['student_id'];
                            $data['student_data'][$key]['name'] = $value['first_name'] . " " . $value['middle_name'] . " " . $value['last_name'];
                            $section_con['returnType'] = 'single';
                            $section_con['conditions'] = array(
                                'section_id' => $value['section_id']
                            );
                            $section = $this->section_model->get($section_con);
                            $data['student_data'][$key]['section'] = $section['name'];
    
                            $sy_conditions['returnType'] = 'single';
                            $sy_conditions['conditions'] = array(
                                'sy_id' => $section['sy_id']
                            );
                            $sy = $this->school_year_model->get($sy_conditions);
    
                            $data['student_data'][$key]['school_year'] = $sy['school_year'];
                        }
                    } else {
                        //No Students Available
                        $data['student_data'] = array();
                    }
                    
                    //Show dashboard View
                    $this->load->view('dashboard/header', $data);
                    $this->load->view('dashboard/student', $data);   
                    $this->load->view('dashboard/footers/dashboard_footer');
                    $this->load->view('dashboard/footers/student_footer', $data);

                    break;
                case 'attendance':
                    $this->load->model('section_model');
                    $this->load->model('student_model');
                    $this->load->model('attendance_model');
                    $this->load->model('qrcode_model');
                    $sections = $this->section_model->get();
                    $data['sections'] = $sections;
                    

                    $attendance_records = $this->attendance_model->get();
                    $recent_attendance = $this->attendance_model->recent_attendance();
                    if ($recent_attendance) {
                        foreach ($recent_attendance as $key => $value) {
                            $data['recent_attendance_records'][$key]['id'] = $value['attendance_id'];
                            $data['recent_attendance_records'][$key]['date'] = $value['date'];
                            $data['recent_attendance_records'][$key]['remarks'] = $value['remarks'];

                            $qrcode_details = $this->qrcode_model->get(array('id' => $value['qr_code']));
                            $student_details = $this->student_model->get(array('id' => $qrcode_details['student_id']));
                            $section_details = $this->section_model->get(array('id' => $student_details['section_id']));

                            $data['recent_attendance_records'][$key]['student_id'] = $qrcode_details['student_id'];
                            $data['recent_attendance_records'][$key]['name'] = $student_details['first_name'] . " " . $student_details['middle_name'] . " " . $student_details['last_name'];
                            $data['recent_attendance_records'][$key]['section'] = $section_details['name'];
                        }
                    } else {
                        $data['recent_attendance_records'] = array();
                    }
                    
                    if ($attendance_records) {
                        foreach ($attendance_records as $key => $value) {
                            $data['attendance_records'][$key]['id'] = $value['attendance_id'];
                            $data['attendance_records'][$key]['date'] = $value['date'];
                            $data['attendance_records'][$key]['remarks'] = $value['remarks'];

                            $qrcode_details = $this->qrcode_model->get(array('id' => $value['qr_code']));
                            $student_details = $this->student_model->get(array('id' => $qrcode_details['student_id']));
                            $section_details = $this->section_model->get(array('id' => $student_details['section_id']));

                            $data['attendance_records'][$key]['student_id'] = $qrcode_details['student_id'];
                            $data['attendance_records'][$key]['name'] = $student_details['first_name'] . " " . $student_details['middle_name'] . " " . $student_details['last_name'];
                            $data['attendance_records'][$key]['section'] = $section_details['name'];
                        }
                    } else {
                        $data['attendance_records'] = array();

                    }
                    
                    //Show dashboard View
                    $this->load->view('dashboard/header', $data);
                    $this->load->view('dashboard/attendance', $data);   
                    $this->load->view('dashboard/footers/dashboard_footer');
                    $this->load->view('dashboard/footers/attendance_footer', $data);
                    break;
                case 'recitation':
                    //Show dashboard View
                    $this->load->view('dashboard/header', $data);
                    $this->load->view('dashboard/recitation', $data);   
                    $this->load->view('dashboard/footers/dashboard_footer');
                    $this->load->view('dashboard/footers/recitation_footer', $data);
                    break;
            }

            
        } else {
            redirect('login', 'refresh'); // Login First
        }  
    }

}