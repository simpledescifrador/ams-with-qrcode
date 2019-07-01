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
                    $this->load->model('school_year_model');
                    $sy_list = $this->school_year_model->get();
                    foreach ($sy_list as $value) {
                        $data['sy_list'][] = $value['school_year'];
                    }
                    break;
                case 'student':
                    $this->load->model('section_model');
                    $sections = $this->section_model->get();
                    $data['sections'] = $sections;
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