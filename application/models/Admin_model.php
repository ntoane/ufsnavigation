<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends MY_Model {

    protected $table = 'tbl_admin';

    public function __construct() {
        parent::__construct();
    }

    public function add_admin($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_admin($admin_id) {
        $tables = array($this->table);
        $where = array(
            'admin_id' => $admin_id
        );
        return $this->delete($tables, $where);
    }

    public function get_current_admin($admin_id) {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('admin_id', $admin_id)
        ->get();
        return $query->row();
    }

    public function get_admins() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->get();
        return $query->result_array();
    }

}
