<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends MY_Model {

    protected $table = 'tbl_student';

    public function __construct() {
        parent::__construct();
    }

    public function add_student($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_student($std_number) {
        $tables = array($this->table);
        $where = array(
            'std_number' => $std_number
        );
        return $this->delete($tables, $where);
    }

    public function get_student($std_number) {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('std_number', $std_number)
        ->get();
        return $query->row();
    }

    public function get_students() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->get();
        return $query->result_array();
    }

}
