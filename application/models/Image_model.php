<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends MY_Model {

    protected $image_table = 'tbl_image';
    protected $building_image_table = 'tbl_building_image';
    protected $parking_image_table = 'tbl_parking_image';
    protected $room_image_table = 'tbl_room_image';

    public function __construct() {
        parent::__construct();
    }

    public function add_image($data) {
        return $this->insert($this->image_table, $data);
    }

    public function add_building_image($data) {
        return $this->insert($this->building_image_table, $data);
    }

    public function add_parking_image($data) {
        return $this->insert($this->parking_image_table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_image($image_id) {
        // $tables = array($this->image_table);
        // $where = array(
        //     'image_id' => $image_id
        // );
        $sql = "DELETE FROM `tbl_image` WHERE `image_id` = ".$image_id;
        $query = $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_image($image_id) {
        $query = $this->db->select('*')
        ->from($this->image_table)
        ->where('image_id', $image_id)
        ->get();
        return $query->row();
    }

    public function get_building_images($building_id) {
        $sql = "SELECT b.building_image_id, b.building_id, b.image_id, i.url FROM tbl_building_image b INNER JOIN tbl_image i 
            ON b.image_id=i.image_id WHERE b.building_id = " . $building_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_building_image_urls($building_id) {
        $sql = "SELECT i.url FROM tbl_building_image b INNER JOIN tbl_image i ON b.image_id=i.image_id WHERE b.building_id = " . $building_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_parking_images($parking_id) {
        $sql = "SELECT p.parking_image_id, p.parking_id, p.image_id, i.url FROM tbl_parking_image p INNER JOIN tbl_image i 
            ON p.image_id=i.image_id WHERE p.parking_id = " . $parking_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_parking_image_urls($parking_id) {
        $sql = "SELECT i.url FROM tbl_parking_image p INNER JOIN tbl_image i ON p.image_id=i.image_id WHERE p.parking_id = " . $parking_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
