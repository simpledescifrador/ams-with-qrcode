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

            //Show Login View
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/' . $slug, $data);   
            $this->load->view('dashboard/footer');
            
        } else {
            redirect('login','refresh'); // Login First
        }  
    }
}