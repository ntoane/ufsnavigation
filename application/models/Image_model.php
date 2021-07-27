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

    public function get_building_images($building_id) {
        $sql = "SELECT b.building_image_id, b.building_id, b.image_id, i.url FROM tbl_building_image b INNER JOIN tbl_image i 
            ON b.image_id=i.image_id WHERE b.building_id = " . $building_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

}
