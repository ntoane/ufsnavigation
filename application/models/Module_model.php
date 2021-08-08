<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends MY_Model {

    protected $table = 'tbl_module';

    public function __construct() {
        parent::__construct();
    }

    public function add_module($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_module($calendar_id) {
        $tables = array($this->table);
        $where = array(
            'module_code' => $calendar_id
        );
        return $this->delete($tables, $where);
    }

    public function get_module($calendar_id) {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('module_code', $calendar_id)
        ->get();
        return $query->row();
    }

    public function get_modules() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->get();
        return $query->result_array();
    }

}
