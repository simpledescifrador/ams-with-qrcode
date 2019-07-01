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

            //Prepare the student data
            $student_data = array(
                'first_name' => $fname,
                'middle_name' => $mname,
                'last_name' => $lname,
                'section_id' => $section_id
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