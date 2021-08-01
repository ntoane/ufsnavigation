<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parking_model extends MY_Model {

    protected $parking = 'tbl_parking';
    protected $parking_cat = 'tbl_parking_category';

    public function __construct() {
        parent::__construct();
    }

    public function add_parking_cat($data) {
        return $this->insert($this->parking_cat, $data);
    }

    public function add_parking($data) {
        return $this->insert($this->parking, $data);
    }

    public function update_parking_cat($data, $where) {
        return $this->edit($this->parking_cat, $data, $where);
    }

    public function update_parking($data, $where) {
        return $this->edit($this->parking, $data, $where);
    }

    public function delete_parking_cat($parking_cat_id) {
        $tables = array($this->parking_cat);
        $where = array(
            'cat_id' => $parking_cat_id
        );
        return $this->delete($tables, $where);
    }

    public function delete_parking($parking_id) {
        $tables = array($this->parking);
        $where = array(
            'parking_id' => $parking_id
        );
        return $this->delete($tables, $where);
    }

    public function get_parking_cat($cat_id) {
        $query = $this->db->select('*')
        ->from($this->parking_cat)
        ->where('cat_id', $cat_id)
        ->get();
        return $query->row();
    }

    public function get_parking_categories() {
        $query = $this->db->select('*')
        ->from($this->parking_cat)
        ->get();
        return $query->result_array();
    }

    public function get_parking($parking_id) {
        $query = $this->db->select('*')
        ->from($this->parking)
        ->where('parking_id', $parking_id)
        ->get();
        return $query->row();
    }

    public function get_car_parkings() {
        $query = $this->db->select('*')
        ->from($this->parking)
        ->where('parking_type', 'car')
        ->get();
        return $query->result_array();
    }

    public function get_wheelchair_parkings() {
        $query = $this->db->select('*')
        ->from($this->parking)
        ->where('parking_type', 'wheelchair')
        ->get();
        return $query->result_array();
    }

}
