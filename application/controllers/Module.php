<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Module_model', 'module');
    }

    public function index() {
        if (_is_user_login($this)) {
            $data['modules'] = $this->module->get_modules();
            $data['view'] = 'module/_index.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function create() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_module')) {
                $data_module = array(
                    'module_code' => $this->input->post('module_code'),
                    'module_name' => $this->input->post('module_name')
                );
                
                if ($this->module->add_module($data_module)) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Module added Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot Insert Module');
                }
                redirect('module');
            } else {
                $data['view'] = 'module/_create.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function edit() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_module')) {
            $data_module = array(
                'module_name' => $this->input->post('module_name')
            );
            $where = array(
                'module_code' => $this->input->post('module_code')
            );
            $id = $this->module->update($data_module, $where);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Module updated Successfully');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Update Module');
            }
            redirect('module');
        } else {
            $module_code = $this->uri->segment(3);
            if (!empty($module_code)) {
                $data['module'] = $this->module->get_module($module_code);
                $data['view'] = 'module/_edit.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('module');
            }
        }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $module_code = $this->uri->segment(3);
            if (!empty($module_code)) {
                if ($this->module->delete_module($module_code)) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Module deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot this Module');
                }
                redirect('module');
            }else {
                redirect('module');
            }
      }
    }

}
