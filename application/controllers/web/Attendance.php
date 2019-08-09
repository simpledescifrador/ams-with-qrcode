<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attendance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('attendance_model'); //Load Attendance Model
        date_default_timezone_set('Asia/Manila');
    }

    public function generate_attendance()
    {
        $report_type = $this->input->get('report');
        

        $data['title'] = ucfirst("Attendance Reports | Attendance Monitoring System");
        $data['sub_title'] = "Reports";
        $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);


        $this->load->model('student_model');
        $this->load->model('qrcode_model');
        $this->load->model('attendance_model');
        $this->load->model('section_model');

        $present = 0;
        $tardy = 0;
        $excused = 0;
        $unexcused = 0;
        
        $data['report_type'] = $report_type;
        
        function dateSort($a, $b) {
            return strtotime($a["date"]) - strtotime($b["date"]);
        }


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
                $end_date = $date_range[1] . " 00:00:00";

                //Get Attendance
                $attendance_con['conditions'] = array(
                    'qr_code' => $qrcode_data['qr_code'],
                    'date >=' => $start_date,
                    'date <' => $end_date
                );

                $attendance_data = $this->attendance_model->get($attendance_con);
   
            
                if ($attendance_data) {
                    usort($attendance_data, "dateSort");

                    foreach ($attendance_data as $key => $value) {
                        $date = $value['date'];
                        $remark = $value['remarks'];

                        $data['s_attendance_data'][$key]['date'] =  date('Y-m-d', strtotime($date));

                        $data['s_attendance_data'][$key]['remark'] = $remark;
                    }


                } else {
                    
                    $data['attendance_data'] = array();
                }

                $data['present'] = $present;
                $data['tardy'] = $tardy;
                $data['excused'] = $excused;
                $data['unexcused'] = $unexcused;

                break;
            case 2: /* Section Report */

                $section_id = $this->input->get('section');
                $date = $this->input->get('date');
                $date_range = explode(" - ", $date);

                $section_data = $this->section_model->get(array('id' => $section_id));
                //Panel Title to Data
                $data['date_range'] = $date_range;
                $data['heading'] = "Section " . $section_data['name'];

                $start_date = $date_range[0] . " 00:00:00";
                $end_date = $date_range[1] . " 00:00:00";

                $attendance_con['conditions'] = array(
                    'section_id' => $section_id,
                    'date >=' => $start_date,
                    'date <' => $end_date
                );

                $attendance_data = $this->attendance_model->get_attendance($attendance_con);
                $data['attendance_data'] = array();
                if ($attendance_data) {
                    $k = 0;
                    usort($attendance_data, "dateSort");

                    foreach ($attendance_data as $key => $value) {
                        $date = date('Y-m-d', strtotime($value['date']));
                        $remark = $value['remarks'];
                        
                        $prev_date;
                        if (!isset($data['attendance_data'][$k][strtolower($remark)])) {
                            $data['attendance_data'][$k][strtolower($remark)] = 0;
                        }

                        if (!isset($prev_date)) {
                            $data['attendance_data'][$k]['date'] = $date;
                            $data['attendance_data'][$k][strtolower($remark)] =  $data['attendance_data'][$k][strtolower($remark)] + 1;
                            $prev_date = $date;
                        } else {
                            if ($prev_date === $date) {
                                $data['attendance_data'][$k][strtolower($remark)] = $data['attendance_data'][$k][strtolower($remark)] + 1;
                            } else {
                                $k++;
                                $data['attendance_data'][$k]['date'] = $date;
                                $data['attendance_data'][$k][strtolower($remark)] = (isset($data['attendance_data'][$k][strtolower($remark)]))? $data['attendance_data'][$key][strtolower($remark)] + 1 : 1;
                            }

                            $prev_date = $date;
                        }

                            ${strtolower($remark)} = ${strtolower($remark)} + 1; /* Increment Totals */

                    }
                }
                
                $data['present'] = $present;
                $data['tardy'] = $tardy;
                $data['excused'] = $excused;
                $data['unexcused'] = $unexcused;

                break;
        }

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/attendance_report', $data);
        $this->load->view('dashboard/footers/dashboard_footer');
        $this->load->view('dashboard/footers/attendance_report_footer', $data);
    }

    public function view_attendance()
    {
        $section_id = $this->input->get('section-id');
        $date = $this->input->get('date');

        if (!isset($section_id, $date)) {
            show_404();
        } else {
            $this->load->model('section_model');
            $section_data = $this->section_model->get(array('id' => $section_id));
            

            $data['title'] = ucfirst('View Attendance | Attendance Monitoring System');
            $data['username'] = ucfirst($this->session->userdata['logged_in']['username']);
            $data['panel_title'] = "Section " . $section_data['name'] . " Attendance";
            $data['attendance_date'] = $date;
            // $data['date'] = date_format(date_create($date), "D, M d, Y");


            $this->load->model('student_model');
            $this->load->model('qrcode_model');
            $this->load->model('attendance_model');
            
            
            $student_con['conditions'] = array(
                'section_id' => $section_id
            );
            $student_data = $this->student_model->get($student_con);
            
            if ($student_data) {
                foreach ($student_data as $key => $value) {
                    $student_id = $value['student_id'];
    
                    $data['attendance'][$key]['student_id'] = $student_id;
                    $data['attendance'][$key]['student_name'] = $value['last_name'] . ", " . $value['first_name'] . " " . $value['middle_name'] . " ";
    
                    //Get Qrcode
                    $qrcode_con['returnType'] = 'single';
                    $qrcode_con['conditions'] = array(
                        'student_id' => $student_id
                    );
    
                    $qrcode_data = $this->qrcode_model->get($qrcode_con);
    
                    $start_date = $date . " 00:00:00";
                    $end_date = date('Y-m-d', strtotime('+1 day', strtotime($date))) . " 00:00:00";
                    
    
                    //Get Attendance
                    $attendance_con['returnType'] = 'single';
                    $attendance_con['conditions'] = array(
                        'qr_code' => $qrcode_data['qr_code'],
                        'date >=' => $start_date,
                        'date <' => $end_date
                    );
    
                    $attendance_data = $this->attendance_model->get($attendance_con);
    
                    if ($attendance_data) {
                        //True
                        $data['attendance'][$key]['attendance_id'] = $attendance_data['attendance_id'];
                        $data['attendance'][$key]['remark'] = $attendance_data['remarks'];
                    } else {
                        //false 
                        $data['attendance'][$key]['remark'] = null;
                        $data['attendance'][$key]['attendance_id'] = null;
                    }
                }
            } else {
                $data['attendance'] = array();
            }
            

            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/attendance_view', $data);
            $this->load->view('dashboard/footers/dashboard_footer');
            $this->load->view('dashboard/footers/attendance_view_footer', $data);
        }
        


    }

    public function mark_attendance()
    {
        $student_ids = $this->input->post('student_ids');
        $remark = $this->input->post('remark');
        $date = $this->input->post('date');
        
        if (!isset($student_ids, $remark, $date)) {
            echo "Error";
        } else {
            for ($i=0; $i < count($student_ids); $i++) {
                $student_id = $student_ids[$i];
                $this->load->model('student_model');
                $student_data = $this->student_model->get(array('id' => $student_id));

                //Get Qrcode
                $qrcode_con['returnType'] = 'single';
                $qrcode_con['conditions'] = array(
                    'student_id' => $student_id
                );

                $this->load->model('qrcode_model');
                $qrcode_data = $this->qrcode_model->get($qrcode_con);
            
                $insert_result = $this->attendance_model->insert(
                    array(
                        'qr_code' => $qrcode_data['qr_code'],
                        'date' => date('Y-m-d H:i:s', strtotime($date)),
                        'status' => "",
                        'remarks' => $remark
                    )
                );
                if (!$insert_result) {
                    echo "Error";
                    break;
                }
            }
            //No Error
            echo "Success";
        }
    
    }

    public function new_attendance()
    {

        $student_id = $this->input->post('student_id');
        $remark = $this->input->post('remark');
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
        
            $insert_result = $this->attendance_model->insert(
                array(
                    'qr_code' => $qrcode_data['qr_code'],
                    'date' => date('Y-m-d H:i:s', strtotime($date)),
                    'status' => "",
                    'remarks' => $remark
                )
            );

            if ($insert_result) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
        
    }

    public function edit_attendance($attendance_id)
    {
        $date = $this->input->post('date');
        $remark = $this->input->post('remark');

        $update_result = $this->attendance_model->update(
            array(
                'date' => date('Y-m-d H:i:s', strtotime($date)),
                'remarks' => $remark
            ),
            $attendance_id
        );

        if ($update_result) {
            echo "Success";
        } else {
            echo "Error";
        }

    }

    public function remove_attendance($attendance_id)
    {
        $result = $this->attendance_model->delete($attendance_id);

        if ($result) {
            echo 'Success';
        } else {
            echo 'Error';
        }
        
    }
}