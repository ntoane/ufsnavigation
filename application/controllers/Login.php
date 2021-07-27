<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        if (!_is_frontend_user_login($this)) {
            $this->load->view('login/_index.php');
        } else {
            redirect('dashboard');
        }
    }

    public function signin() {
        if (_is_user_login($this)) {
            redirect(_get_user_redirect($this));
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
//            echo $email.' '.$password;
            if ($this->do_login($email, $password)) {
                redirect(_get_user_redirect($this));
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Wrong email and/or password');
                redirect('login');
            }
        }
    }

    public function do_login($email, $password) {
        $this->load->model('Admin_model', 'admins');
        $user = $this->admins->get_row("SELECT * FROM tbl_admin WHERE email = '" . $email ."'");
        if (empty($user) || !password_verify($password, $user->password)) {
            return false;
        }else {
            $data = array(
                'user_id' => $user->admin_id,
                'user_type' => "admin",
                'is_logged_in' => true
            );
            $this->session->set_userdata($data);
        return true;
        }
    }

    public function logout() {
        $array_items = array('user_id', 'user_type', 'is_logged_in');
        $this->session->unset_userdata($array_items);

        $this->session->sess_destroy();
        redirect('login');
    }

    public function forgot_password() {
        if (!_is_frontend_user_login($this)) {
            $this->load->view('login/_forgot_password.php');
        } else {
            redirect('dashboard');
        }
    }

}
