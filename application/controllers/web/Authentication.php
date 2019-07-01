<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller{
    

    public function login()
    {
        $this->load->model('setup_model');
        
        if (!$this->setup_model->is_complete_registered()) {
            redirect('register');
        } else if (isset($this->session->userdata['logged_in'])) {
            redirect('dashboard','refresh'); //Already logged in
        } else {
            //Load Login View
            $data['title'] = ucfirst('Login | Attendance Monitoring System');
            //Show Login View
            $this->load->view('admin/index', $data);    
        } 
    }

    public function register()
    {
        $this->load->model('setup_model');

        if (!$this->setup_model->is_complete_registered()) {
            //Load Login View
            $data['title'] = ucfirst('Register | Attendance Monitoring System');

            $this->load->view('templates/header', $data);
            $this->load->view('admin/register');  
            $this->load->view('templates/footer');
            

        } else {
            redirect('login');
        }
    }

    /*
    ** Validation Registration
    **
     */
    public function register_auth()
    {
        $this->load->library('form_validation'); //Load Form Validation
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|min_length[5]|max_length[25]|matches[password]',
            array(
                'matches' => "The Password not match!"
            )
        );

        if ($this->form_validation->run() == FALSE) {
            /* Failed Form Validation */

            //Pass Validation Error Message to session
            $this->session->set_flashdata('validate_msg', validation_errors());
            redirect('register');
            
		} else {
            /* Success Form Validation */
            
            $name = $this->input->post('name'); //Get the value of Name
            $username = $this->input->post('username'); //Get the value of Usernane
            $password = $this->input->post('password'); //Get the value of Password

            $user_data = array(
                'name' => $name,
                'username' => $username,
                'password' => md5($password)
            );

            $this->load->model('user_model'); //Load User Model

            $user_id = $this->user_model->insert($user_data);

            if (!$user_id) {
                //Error Register

                $data['error_msg'] = 'Error Occurred. Failed to Register';
                //Pass Validation Error Message to session
                $this->session->set_flashdata('error_msg', $data['error_msg']);
                redirect('register');

            } else {
                //Success Register

                $this->load->model('setup_model');

                $result = $this->setup_model->set_completed_register(TRUE);

                if ($result == true) {
                    $user_details = $this->user_model->get(array('id' => $user_id));

                    //Pass User Data to session
                    $session_data = array(
                        'user_id' => $user_details['user_id'],
                        'name' => $user_details['name'],
                        'username' => $user_details['username']
                    );

                    $this->session->set_userdata('logged_in', $session_data);
                    

                    redirect('dashboard','refresh');
                }
            }
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
                    'name' => $user_details[0]['name'],
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


    /*
    ** Change User Password 
    **
     */
    public function change_password()
    {
        $this->load->library('form_validation'); //Load Form Validation

        //Set Form Rules
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|min_length[5]|max_length[15]|callback_check_current_password');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[5]|max_length[25]|differs[password]');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'trim|required|min_length[5]|max_length[25]|matches[new_password]',
            array(
                'matches' => "The New Password not match!"
            )
        );

        if ($this->form_validation->run() == FALSE) {
            /* Failed Form Validation */
            echo validation_errors();
		} else {

            $user_id = $this->session->userdata['logged_in']['user_id']; //Get User ID
            $this->load->model('user_model'); 

            $new_password = $this->input->post('new_password');
            $data = array(
                'password' => md5($new_password)
            );
            
            $result = $this->user_model->update($data, $user_id);

            if (!$result) {
                //Error
                echo 'Error';
            } else {
                echo 'Success';
            }
            
        }
    }

    public function check_current_password($password)
    {
        $user_id = $this->session->userdata['logged_in']['user_id']; //Get User ID
        $this->load->model('user_model');
        $con['id'] = $user_id; 
        $con['conditions'] = array(
            'password' => md5($password)
        );
        $result = $this->user_model->get($con);

        if ($result) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_current_password', 'The {field} is invalid');
            return FALSE;
        }
    }

    public function register_user()
    {

    }
}