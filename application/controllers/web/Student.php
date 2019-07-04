<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model'); //Load Student Model
    }

    public function new_student()
    {
        $this->load->library('form_validation'); //Load Form Validation
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('mname', 'Middle Name', 'trim');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');

        $fname = $this->input->post('fname');
        $mname = $this->input->post('mname');
        $lname = $this->input->post('lname');
        $section_id = $this->input->post('section_id');
        
        if ($this->form_validation->run() == FALSE) {
            /* Failed Form Validation */
            echo validation_errors();
        } else if ($section_id == 0) {
            echo "Please select the section!";
        } else {

            if(isset($_FILES['profile-image']['name'])) {

                if (!is_dir('uploads/students/profile/')) {
                    mkdir("uploads/students/profile/", 0777);
                }

                $config['upload_path'] = './uploads/students/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('profile-image')) {
                    echo $this->upload->display_errors();
                } else {
                    $data = $this->upload->data();
                    //Prepare the student data
                    $student_data = array(
                        'first_name' => $fname,
                        'middle_name' => $mname,
                        'last_name' => $lname,
                        'section_id' => $section_id,
                        'profile_image_url' => base_url() . 'uploads/students/profile/' . $data['file_name']
                    );
                    //Insert new Student
                    $result = $this->student_model->insert($student_data);

                    if (!$result) {
                        echo 'Error';
                    } else {
                        echo 'Success';
                    }
                }
                
            }

            
        }
    }

    public function view_student_profile($student_id)
    {
        $data['title'] = ucfirst('Student Profile | Attendance Monitoring System');
        $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);

        $this->load->model('section_model');
        $student_con['returnType'] = 'single';
        $student_con['conditions'] = array(
            'student_id' => $student_id
        );
        
        $student_details = $this->student_model->get($student_con);
        $section_con['returnType'] = 'single';
        $section_con['conditions'] = array(
            'section_id' => $student_details['section_id']
        );
        $section = $this->section_model->get($section_con);
        $data['student_details'] = array(
            'student_id' => $student_details['student_id'],
            'student_name' => $student_details['first_name'] . " " . $student_details['middle_name'] . " " . $student_details['last_name'],
            'section' => $section['name'],
            'profile_image_url' => $student_details['profile_image_url']
        );

        //Get Sections for Edit Profile Modal
        $sections = $this->section_model->get();
        $data['sections'] = $sections;

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/student_profile', $data);   
        $this->load->view('dashboard/footer', $data);
    }


}