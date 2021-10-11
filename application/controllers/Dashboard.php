<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        $data['view'] = 'dashboard/_index.php';
        $this->load->view('_layout.php', $data);
    }


}
