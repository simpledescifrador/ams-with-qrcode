<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recitation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('recitation_model'); //Load Recitation Model
        date_default_timezone_set('Asia/Manila');
    }

    public function generate_report()
    {
        $report_type = $this->input->get('report');
        

        $data['title'] = ucfirst("Recitation Reports | Attendance Monitoring System");
        $data['sub_title'] = "Reports";
        $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);

        $data['report_type'] = $report_type;

        function dateSort($a, $b) {
            return strtotime($a["date"]) - strtotime($b["date"]);
        }

        function compareByName($a, $b) {
            return strcmp($a["last_name"] . ", " . $a['first_name'], $b["last_name"] . ", " . $b['first_name']);
        }
        $this->load->model('student_model');
        $this->load->model('qrcode_model');
        $this->load->model('attendance_model');
        $this->load->model('section_model');

        switch ($report_type) {
            case 1: /* Student Report */
                $section_id = $this->input->get('section');
                $student_id = $this->input->get('student');
                $date = $this->input->get('date');
                $date_range = explode(" - ", $date);

                //Get Student Data
                $student_data = $this->student_model->get(array('id' => $student_id));

                $student_name = $student_data['last_name'] . ", " . $student_data['first_name'] . " " . $student_data['middle_name'];
                

                //Panel Title to Data
                $data['date_range'] = $date_range;
                $data['heading'] = $student_name;

                //Get Qrcode
                $qrcode_con['returnType'] = 'single';
                $qrcode_con['conditions'] = array(
                    'student_id' => $student_id
                );

                $qrcode_data = $this->qrcode_model->get($qrcode_con);

                $start_date = $date_range[0] . " 00:00:00";
                $end_date = date('Y-m-d', strtotime($date_range[1]. ' + 1 days')) . " 00:00:00";

                //Get Recitation
                $recitation_con['conditions'] = array(
                    'qr_code' => $qrcode_data['qr_code'],
                    'date >=' => $start_date,
                    'date <' => $end_date
                );

                $recitation_data = $this->recitation_model->get($recitation_con);
                $total_recitation = 0;

                if ($recitation_data) {
                    usort($recitation_data, "dateSort");
                    $k = 0;
                    foreach ($recitation_data as $key => $value) {
                        $date = date('Y-m-d', strtotime($value['date']));
                        $prev_date;
                        
                        if (!isset($data['s_recitation_data'][$k]['recitations'])) {
                            $data['s_recitation_data'][$k]['recitations'] = 0;
                        }

                        if (!isset($prev_date)) {
                            $data['s_recitation_data'][$k]['date'] = $date;
                            $data['s_recitation_data'][$k]['recitations'] = $data['s_recitation_data'][$k]['recitations'] + 1;
                            $prev_date = $date;
                            $total_recitation++;
                        } else {
                            if ($prev_date === $date) {
                                $data['s_recitation_data'][$k]['recitations'] = $data['s_recitation_data'][$k]['recitations'] + 1;
                                $total_recitation++;
                            } else {
                                $k++;
                                $data['s_recitation_data'][$k]['date'] = $date;
                                $data['s_recitation_data'][$k]['recitations'] = (isset($data['s_recitation_data'][$k]['recitations']))? $data['s_recitation_data'][$k]['recitations'] + 1 : 1;
                                $total_recitation++;
                            }

                            $prev_date = $date;
                        }
                        
                    }
                } else {
                    $data['s_recitation_data'] = array();
                }
                
                $data['total_recitations'] = $total_recitation;

                break;
            case 2: /* Section Report */
                $section_id = $this->input->get('section');
                $student_id = $this->input->get('student');
                $date = $this->input->get('date');
                $date_range = explode(" - ", $date);

                $section_data = $this->section_model->get(array('id' => $section_id));

                //Panel Title to Data
                $data['date_range'] = $date_range;
                $data['heading'] = "Section " . $section_data['name'];


                $student_con['conditions'] = array(
                    'section_id' => $section_id
                );

                $students = $this->student_model->get($student_con);
                $total_recitation = 0;

                if ($students) {
                    usort($students, 'compareByName');
                    foreach ($students as $s => $value) {
                        $student_name = $value['last_name'] . ", " . $value['first_name'] . " " . $value['middle_name'];
                        $student_id = $value['student_id'];
                        $data['recitation_data'][$s]['student_id'] = $student_id;
                        $data['recitation_data'][$s]['student_name'] = $student_name;

                        //Get Qrcode
                        $qrcode_con['returnType'] = 'single';
                        $qrcode_con['conditions'] = array(
                            'student_id' => $student_id
                        );

                        $qrcode_data = $this->qrcode_model->get($qrcode_con);

                        $start_date = $date_range[0] . " 00:00:00";
                        $end_date = date('Y-m-d', strtotime($date_range[1]. ' + 1 days')) . " 00:00:00";
        
                        //Get Recitation
                        $recitation_con['returnType'] = 'count';
                        $recitation_con['conditions'] = array(
                            'qr_code' => $qrcode_data['qr_code'],
                            'date >=' => $start_date,
                            'date <' => $end_date
                        );

                        $recitations = $this->recitation_model->get($recitation_con);

                        if ($recitations) {
                            $data['recitation_data'][$s]['recitations'] = $recitations;
                            $total_recitation = $total_recitation + $recitations;
                        } else {
                            $data['recitation_data'][$s]['recitations'] = 0;
                        }
                        
                    }
                } else {
                    $data['recitation_data'] = array();
                }
                $data['total_recitations'] = $total_recitation;
                break;
        }

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/recitation_report', $data);
        $this->load->view('dashboard/footers/dashboard_footer');
        $this->load->view('dashboard/footers/recitation_report_footer', $data);
    }

    public function new_recitation()
    {
        $student_id = $this->input->post('student_id');
        $date = $this->input->post('date');

        $this->load->model('student_model');
        $student_data = $this->student_model->get(array('id' => $student_id));

        if (empty($student_id)) {
            echo "Please enter the student id";
        } else if (!$student_data) {
            echo "Invalid student id";
        } else {
            //Get Qrcode
            $qrcode_con['returnType'] = 'single';
            $qrcode_con['conditions'] = array(
                'student_id' => $student_id
            );

            $this->load->model('qrcode_model');
            $qrcode_data = $this->qrcode_model->get($qrcode_con);
        
            $insert_result = $this->recitation_model->insert(
                array(
                    'qr_code' => $qrcode_data['qr_code'],
                    'date' => date('Y-m-d H:i:s', strtotime($date))
                )
            );

            if ($insert_result) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }


    public function edit_recitation($recitation_id)
    {
        $date = $this->input->post('date');

        $update_result = $this->recitation_model->update(
            array(
                'date' => date('Y-m-d H:i:s', strtotime($date))
            ),
            $recitation_id
        );

        if ($update_result) {
            echo "Success";
        } else {
            echo "Error";
        }
    }

    public function remove_recitation($recitation_id)
    {
        $result = $this->recitation_model->delete($recitation_id);

        if ($result) {
            echo 'Success';
        } else {
            echo 'Error';
        }
    }
}