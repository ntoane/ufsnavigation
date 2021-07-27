<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model', 'admins');
    }

    public function index() {
        if (_is_user_login($this)) {
        $data['admins'] = $this->admins->get_admins();
        $data['view'] = 'admin/_index.php';
        $this->load->view('_layout.php', $data);
        }
    }

    public function create() {
        if (_is_user_login($this)) {
        if ($this->input->post('submit_admin')) {
            $password = $password = password_hash('user123', PASSWORD_BCRYPT);
            $data_admin = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => $password
            );
            $id = $this->admins->add_admin($data_admin);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Admin added successfully, default password is user123');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Insert');
            }
            redirect('admin');
        } else {
            $data['view'] = 'admin/_create.php';
            $this->load->view('_layout.php', $data);
        }
        }
    }

    public function edit() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_admin')) {
            $data_admin = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
            );
            $where = array(
                'admin_id' => $this->input->post('admin_id')
            );
            $id = $this->admins->update($data_admin, $where);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Admin user updated Successfully');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Update');
            }
            redirect('admin');
        } else {
            $admin_id = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($admin_id > 0) {
                $data['admin'] = $this->admins->get_row("SELECT * FROM tbl_admin WHERE admin_id = " . $admin_id);
                if($admin_id == _get_current_user_id($this)) {
                    $data['view'] = 'admin/_profile.php';
                }else {
                    $data['view'] = 'admin/_edit.php';
                }
                $this->load->view('_layout.php', $data);
            } else {
                redirect('admin');
            }
        }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $admin_id = $this->uri->segment(3);
            if ($admin_id > 0) {
                $id = $this->admins->delete_admin($admin_id);
    
                if ($id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Admin user deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot Delete User');
                }
                redirect('admin');
            }else {
                redirect('admin');
            }
      }
    }

    public function change_password() {
        if (_is_user_login($this)) {
            if ($this->input->post('update_password')) {
                $password = $this->input->post("old_password");
                $new_password = $this->input->post("new_password");
                $confirm_password = $this->input->post("confirm_password");

                $user = $this->admins->get_current_admin(_get_current_user_id($this));
                if (!empty($user) && password_verify($password, $user->password)) {
                    /* correct password, attempt to change it */
                    if ($new_password == $confirm_password) {
                        /* change password */
                        $data_user = array(
                            'password' => password_hash($new_password, PASSWORD_BCRYPT)
                        );
                        $where = array(
                            'admin_id' => _get_current_user_id($this)
                        );
                        $id = $this->admins->update($data_user, $where);
                        if ($id > 0) {
                            $this->session->set_flashdata('type', 'success');
                            $this->session->set_flashdata('title', 'Success');
                            $this->session->set_flashdata('text', 'Password changed successfully, please login');
                            redirect('login/logout');
                        } else {
                            $this->session->set_flashdata('type', 'error');
                            $this->session->set_flashdata('title', 'Error');
                            $this->session->set_flashdata('text', 'Error changing Password');
                            redirect('admin/edit/' . _get_current_user_id($this));
                        }
                    } else {
                        /* passwords do not match */
                        $this->session->set_flashdata('type', 'error');
                        $this->session->set_flashdata('title', 'Error');
                        $this->session->set_flashdata('text', 'Passwords do not match');
                        redirect('admin/edit/' . _get_current_user_id($this));
                    }
                } else {
                    /* wrong password */
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Wrong Old Password');
                    redirect('admin/edit/' . _get_current_user_id($this));
                }
            }
        }
    }

}
