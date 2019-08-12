<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
        $this->load->model('setup_model');
        
        if (!$this->setup_model->is_complete_registered()) {
            redirect('register');
        } else if (isset($this->session->userdata['logged_in'])) {
            redirect('dashboard', 'refresh'); //Already logged in
        } else {
            //Load Login View
            $data['title'] = ucfirst('Login | Attendance Monitoring System');
            //Show Login View
            $this->load->view('admin/index', $data);
        }
	}
}
