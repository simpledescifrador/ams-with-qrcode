<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    public function page($slug = 'dashboard') 
    {
        if (isset($this->session->userdata['logged_in'])) {

            //Load Login View
            $data['title'] = ucfirst($slug .' | Attendance Monitoring System');
            $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);
            
            $slug = $slug == 'dashboard' ? 'home' : $slug;

            //Load Data to views
            switch ($slug) {
                case 'dashboard':
                    break;
                case 'section':
                    $this->load->model('student_model');
                    $this->load->model('school_year_model');
                    $sy_list = $this->school_year_model->get();
                    foreach ($sy_list as $value) {
                        $data['sy_list'][] = $value['school_year'];
                    }
                    $this->load->model('section_model');
                    $sections = $this->section_model->get();
                    foreach ($sections as $key => $value) {
                        $data['section_data'][$key]['section_id'] = $value['section_id']; 
                        $sy_conditions['conditions'] = array(
                            'sy_id' => $value['section_id']
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
                    break;
                case 'student':
                    $this->load->model('section_model');
                    $this->load->model('student_model');
                    $this->load->model('school_year_model');
                    $sections = $this->section_model->get();
                    $data['sections'] = $sections;
                    
                    $students = $this->student_model->get();
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
                            'sy_id' => $value['section_id']
                        );
                        $sy = $this->school_year_model->get($sy_conditions);

                        $data['student_data'][$key]['school_year'] = $sy['school_year'];
                    }

                    break;
                case 'attendance':
                    break;
                case 'recitation':
                    break;
                case 'qrcodes':
                    break;
            }

            //Show Login View
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/' . $slug, $data);   
            $this->load->view('dashboard/footer', $data);
            
        } else {
            redirect('login','refresh'); // Login First
        }  
    }

}