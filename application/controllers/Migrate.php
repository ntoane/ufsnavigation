<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
	public function index()
	{
        $this->load->library('migration');

        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo 'Migrations Run Successfully. Click <a href=' . base_url() . ' >here </a> to Login.';
        }
	}
}
