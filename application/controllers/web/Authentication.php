<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller{
    

    public function login()
    {
        if (isset($this->session->userdata['logged_in'])) {
            redirect('dashboard','refresh'); //Already logged in
        } else {
            //Load Login View
            $data['title'] = ucfirst('Login | Attendance Monitoring System');
            //Show Login View
            $this->load->view('admin/index', $data);    
        }   
    }

    /*
    ** Validation Login 
    **
     */
    public function login_auth()
    {
        $this->load->library('form_validation'); //Load Form Validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[25]');

        if ($this->form_validation->run() == FALSE) {
            /* Failed Form Validation */

            //Pass Validation Error Message to session
            $this->session->set_flashdata('validate_msg', validation_errors());
            redirect('login');
            
		} else {
            /* Success Form Validation */

            //Start For User Validation
            $username = $this->input->post('username'); //Get the value of Usernane
            $password = $this->input->post('password'); //Get the value of Password

            $this->load->model('user_model'); //Load User Model

            $validation_result = $this->user_model->login_validation($username, $password);

            if ($validation_result == false) {
                //Validation Failed
                
                $data['error_msg'] = 'Invalid Username or Password';
                //Pass Validation Error Message to session
                $this->session->set_flashdata('error_msg', $data['error_msg']);
                redirect('login');
            } else {
                //Validation Success
                $user_details = $this->user_model->get(
                    array(
                        'conditions' => array(
                            'username' => $username
                        )
                    )
                );
                
                //Pass User Data to session
                $session_data = array(
                    'user_id' => $user_details[0]['user_id'],
                    'username' => $user_details[0]['username']
                );

                $this->session->set_userdata('logged_in', $session_data);

                
                redirect('dashboard','refresh');
            }
            
        }
    }

    public function forgot_password()
    {
        $data['title'] = ucfirst('Forgot Password | Attendance Monitoring System');
        //Show Login View
        $this->load->view('admin/passwordForgot', $data);
    }

    public function logout()
    {   
        // Removing session data
        $sess_array = array(
            'user_id' => '',
            'username' => ''
        );

        $this->session->unset_userdata('logged_in', $sess_array);
        $data['display_msg'] = 'Successfully Logout';
        $this->session->set_flashdata('display_msg', $data['display_msg']);
        redirect('login');
    }
}