<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Building_model extends MY_Model {

    protected $table = 'tbl_building';

    public function __construct() {
        parent::__construct();
    }

    public function add_building($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_building($admin_id) {
        $tables = array($this->table);
        $where = array(
            'building_id' => $admin_id
        );
        return $this->delete($tables, $where);
    }

    public function get_buildings() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->get();
        return $query->result_array();
    }

}
