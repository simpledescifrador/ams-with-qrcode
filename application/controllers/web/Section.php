<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('section_model'); //Load Section Model
    }

    public function new_section()
    {
        $this->load->library('form_validation'); //Load Form Validation
        $this->form_validation->set_rules('section', 'Section', 'trim|required|min_length[5]');

        $section_name = $this->input->post('section');
        $sy = $this->input->post('school_year');

        if ($this->form_validation->run() == FALSE) {
            /* Failed Form Validation */
            echo validation_errors();
            
        } else if ($sy == "Select School Year") {
            echo "Please select the school year!";
        } else {

            $sy_id = null;

            //Get School Year ID 
            //Check if school year exist in the database
            $this->load->model('school_year_model'); //Load School Year Model

            $is_exist = $this->school_year_model->sy_exist($sy);

            if ($is_exist == false) {
                //School Year Not Found. Insert New School Year
                $sy_id = $this->school_year_model->insert(array('school_year' => $sy));
            } else {
                $sy_id = $is_exist['sy_id'];
            }

            //Prepare the Data to be inserted
            $section_data = array(
                'name' => $section_name,
                'sy_id' => $sy_id
            );
            //Insert/Add the new section
            $result = $this->section_model->insert($section_data);
            
            if (!$result) {
                //Failed
                echo 'Failed';
            } else {
                //Successful
                echo 'Success';
            }
            
        }

    } //End of new_section


    public function view_section_details($section_id)
    {
        $data['title'] = ucfirst('Section Details | Attendance Monitoring System');
        $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);

        $this->load->model('school_year_model');
        $section_details = $this->section_model->get(array('id' => $section_id));
        $sy_details = $this->school_year_model->get(array('id' => $section_details['sy_id']));
        
        $data['section_details'] = array(
            'section_id' => $section_id,
            'section' => $section_details['name'],
            'school_year' => $sy_details['school_year']
        );

        //Get Students enrolled for this section
        $this->load->model('student_model');
        $enrolled_students_con['conditions'] = array(
            'section_id' => $section_id
        );
        $enrolled_students = $this->student_model->get($enrolled_students_con);
        
        if (!$enrolled_students) {
            $data['enrolled_students'] = array();
        } else {
            $data['enrolled_students'] = $enrolled_students;
        }
        
        
        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/section_details', $data);   
        $this->load->view('dashboard/footer', $data);
    }
}