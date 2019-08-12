<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model'); //Load Student Model
    }

    public function change_image($student_id)
    {
        if(isset($_FILES['change-image']['name'])) {
            if (!is_dir('uploads/students/profile/')) {
                mkdir("uploads/students/profile/", 0777);
            }

            $config['upload_path'] = './uploads/students/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->load->library('upload', $config);

            $image = "";

            if (!$this->upload->do_upload('change-image')) {
                $image = base_url() . 'assets/images/student_profile_placeholder.png';
            } else {
                $data = $this->upload->data();
                $image = base_url() . 'uploads/students/profile/' . $data['file_name'];
            }

            //Prepare the student data
            $student_data = array(
                'profile_image_url' => $image
            );
            //Insert new Student
            $result = $this->student_model->update($student_data, $student_id);

            if (!$result) {
                echo 'Error';
            } else {
                echo 'Success';
            }
        } 
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

                $image = "";

                if (!$this->upload->do_upload('profile-image')) {
                    $image = base_url() . 'assets/images/student_profile_placeholder.png';
                } else {
                    $data = $this->upload->data();
                    $image = base_url() . 'uploads/students/profile/' . $data['file_name'];
                }

                //Prepare the student data
                $student_data = array(
                    'first_name' => $fname,
                    'middle_name' => $mname,
                    'last_name' => $lname,
                    'section_id' => $section_id,
                    'profile_image_url' => $image
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
            'section' => array(
                'id' => $section['section_id'],
                'name' => $section['name']
            ),
            'profile_image_url' => $student_details['profile_image_url']
        );

        $data['student_details']['name'] = array(
            'fname' => $student_details['first_name'],
            'mname' => $student_details['middle_name'],
            'lname' => $student_details['last_name']
        );


        //Get Sections for Edit Profile Modal
        $sections = $this->section_model->get();
        $data['sections'] = $sections;

        $this->load->model('student_model');
        $this->load->model('attendance_model');
        $this->load->model('qrcode_model');
        
        $qrcode_con['returnType'] = 'single';
        $qrcode_con['conditions'] = array(
            'student_id' => $student_id
        );

        $qrcode_data = $this->qrcode_model->get($qrcode_con);

        if ($qrcode_data) {
            $attendance_con['conditions'] = array(
                'qr_code' => $qrcode_data['qr_code']
            );
    
            $attendance_data = $this->attendance_model->get($attendance_con);

            if ($attendance_data) {
                foreach ($attendance_data as $key => $value) {
                    $data['attendance_records'][$key]['id'] = $value['attendance_id'];
                    $data['attendance_records'][$key]['date'] = $value['date'];
                    $data['attendance_records'][$key]['remarks'] = $value['remarks'];
                }
            } else {
                $data['attendance_records'] = array();
            }
        } else {
            //Check if student qrcode exist
            $is_exist = $this->qrcode_model->is_student_qrcode_exist($student_id);
            if($is_exist) {
                //Get Qrcode
                $qrcode = $is_exist;
            } else {
                //Generate for qrcode
                $this->load->library('ciqrcode');
                if (!is_dir('uploads/students/qrcode/')) {
                    mkdir('uploads/students/qrcode/', 0777, TRUE);
                }
                $student_con['returnType'] = 'single';
                $student_con['conditions'] = array(
                    'student_id' => $student_id
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
                    'student_id' => $student_id,
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

                $qrcode = $output['qrCode'];

                $attendance_con['conditions'] = array(
                    'qr_code' => $qrcode
                );
        
                $attendance_data = $this->attendance_model->get($attendance_con);
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
                    'section' => array(
                        'id' => $section['section_id'],
                        'name' => $section['name']
                    ),
                    'profile_image_url' => $student_details['profile_image_url']
                );
        
                $data['student_details']['name'] = array(
                    'fname' => $student_details['first_name'],
                    'mname' => $student_details['middle_name'],
                    'lname' => $student_details['last_name']
                );
                
                if ($attendance_data) {
                    foreach ($attendance_data as $key => $value) {
                        $data['attendance_records'][$key]['id'] = $value['attendance_id'];
                        $data['attendance_records'][$key]['date'] = $value['date'];
                        $data['attendance_records'][$key]['remarks'] = $value['remarks'];
                    }
                } else {
                    $data['attendance_records'] = array();
                }
            }
        }

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/student_profile', $data);
        $this->load->view('dashboard/footers/dashboard_footer');
        $this->load->view('dashboard/footers/student_profile_footer', $data);
    }

    public function edit_student_details($student_id)
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
            $student_data = array(
                'first_name' => $fname,
                'middle_name' => $mname,
                'last_name' => $lname,
                'section_id' => $section_id
            );

            //Insert new Student
            $result = $this->student_model->update($student_data, $student_id);
            if (!$result) {
                echo 'Error';
            } else {
                echo 'Success';
            }
        }
        
    }

    public function remove_student($student_id)
    {
        $result = $this->student_model->delete($student_id);

        if ($result) {
            //Success Delete
            echo "Success";
        } else {
            echo "Error";
        }
    }

    public function get_student_names()
    {
        $query = $this->input->get('query');
        

        $student_data = $this->student_model->get_like_names($query);

        $names = array();
        foreach ($student_data as $key => $value) {
            $names[$key] = array(
                'student_id' => $value['student_id'],
                'name' => $value['first_name'] . " " . $value['middle_name'] . " ". $value['last_name']
            );
        }

        echo json_encode($names);
    }
}