<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model', 'student');
        $this->load->model('Email_model', 'email_model');
    }

    public function index() {
        if (_is_user_login($this)) {
        $data['students'] = $this->student->get_students();
        $data['view'] = 'student/_index.php';
        $this->load->view('_layout.php', $data);
        }
    }

    public function create() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_student')) {
                $code = _generate_code();
                $password = password_hash($code, PASSWORD_BCRYPT);
                $email = $this->input->post('email');
                $data_student = array(
                    'std_number' => $this->input->post('std_number'),
                    'std_fname' => $this->input->post('fname'),
                    'std_lname' => $this->input->post('lname'),
                    'email' => $email,
                    'password' => $password
                );
                $id = $this->student->add_student($data_student);
                if ($id > 0) {
                    $message = 'You have been registered to UFS Campus Navigation Assistant <br> Use the following credentials to login to the App
                                <br> Username: Your Student Number <br> Password: ' . $code;
                    $this -> email_model -> send_mail($email,'UFS Campus Navigation Assistant Credentials',$message);

                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Student added successfully, password is sent to email');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot Insert Student');
                }
                redirect('student');
            } else {
                $data['view'] = 'student/_create.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function edit() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_student')) {
            $data_student = array(
                'std_fname' => $this->input->post('fname'),
                'std_lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
            );
            $where = array(
                'std_number' => $this->input->post('std_number')
            );
            $id = $this->student->update($data_student, $where);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Student updated Successfully');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Update Student');
            }
            redirect('student');
        } else {
            $std_number = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($std_number > 0) {
                $data['student'] = $this->student->get_student($std_number);

                $data['view'] = 'student/_edit.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('student');
            }
        }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $std_number = $this->uri->segment(3);
            if ($std_number > 0) {
                if ($this->student->delete_student($std_number)) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Student deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot Delete Student');
                }
                redirect('student');
            }else {
                redirect('student');
            }
      }
    }

}
