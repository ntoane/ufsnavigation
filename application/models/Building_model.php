<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Building_model extends MY_Model {

    protected $table = 'tbl_building';
    protected $table_room = 'tbl_room';
    protected $table_room_direction = 'tbl_room_direction';

    public function __construct() {
        parent::__construct();
    }

    public function add_building($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_building($building_id) {
        $tables = array($this->table);
        $where = array(
            'building_id' => $building_id
        );
        return $this->delete($tables, $where);
    }

    public function get_building($building_id) {
        $query = $this->db->select('*')
        ->from($this->table)
        //->where('category_id', 1)
        ->where('Building_id', $building_id)
        ->get();
        return $query->row();
    }

    public function get_buildings() {
        $query = $this->db->select('*')
        ->from($this->table)
        //->where('category_id', 1)
        ->get();
        return $query->result_array();
    }

    public function get_building_levels($building_id) {
        $query = $this->db->select('COUNT(room_id) AS num_room, room_id, building_id, room_name, floor_num, description')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->group_by('floor_num')
        ->order_by('floor_num', 'ASC')
        ->get();
        return $query->result_array();
    }

    public function get_Health_Services() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('category_id', 3)
        ->get();
        return $query->result_array();
    }

    public function get_eating_places() {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('category_id', 4)
        ->get();
        return $query->result_array();
    }
/************************ Rooms ***********************/

    public function add_room($data) {
        return $this->insert($this->table_room, $data);
    }

    public function delete_room($room_id) {
        $tables = array($this->table_room);
        $where = array(
            'room_id' => $room_id
        );
        return $this->delete($tables, $where);
    }

    public function get_room($room_id) {
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('room_id', $room_id)
        ->get();
        return $query->row();
    }

    public function get_building_level_rooms($building_id, $floor_num) {
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->where('floor_num', $floor_num)
        ->where('room_type', 1)
        ->get();
        return $query->result_array();
    }

    public function get_building_level_male_toilets($building_id, $floor_num) {
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->where('floor_num', $floor_num)
        ->where('room_type', 2)
        ->get();
        return $query->result_array();
    }

    public function get_building_level_female_toilets($building_id, $floor_num) {
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->where('floor_num', $floor_num)
        ->where('room_type', 3)
        ->get();
        return $query->result_array();
    }

    public function get_building_level_toilets($building_id, $floor_num) {
        $toilet_where = "(room_type = '2' OR room_type = '3')";
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->where('floor_num', $floor_num)
        ->where($toilet_where)
        ->get();
        return $query->result_array();
    }

    //Get all rooms and toilets for this level
    public function get_building_level_rooms_toilets($building_id, $floor_num) {
        $query = $this->db->select('*')
        ->from($this->table_room)
        ->where('building_id', $building_id)
        ->where('floor_num', $floor_num)
        ->get();
        return $query->result_array();
    }

    //Room directions
    public function add_room_direction($data) {
        return $this->insert($this->table_room_direction, $data);
    }

    public function get_room_directions($room_id) {
        $query = $this->db->select('*')
        ->from($this->table_room_direction)
        ->where('room_id', $room_id)
        ->get();
        return $query->result_array();
    }

    public function delete_room_direction($room_direction_id) {
        $tables = array($this->table_room_direction);
        $where = array(
            'room_direction_id' => $room_direction_id
        );
        return $this->delete($tables, $where);
    }

}
