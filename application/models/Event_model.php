<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends MY_Model {

    protected $table = 'tbl_calendar';

    public function __construct() {
        parent::__construct();
    }

    public function add_event($data) {
        return $this->insert($this->table, $data);
    }

    public function update($data, $where) {
        return $this->edit($this->table, $data, $where);
    }

    public function delete_event($calendar_id) {
        $tables = array($this->table);
        $where = array(
            'calendar_id' => $calendar_id
        );
        return $this->delete($tables, $where);
    }

    public function get_event($calendar_id) {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('calendar_id', $calendar_id)
        ->get();
        return $query->row();
    }

    public function get_events() {
        $query = $this->db->select("calendar_id, event_name, DATE_FORMAT(start_time, '%k:%i') AS start_time, 
        DATE_FORMAT(end_time, '%k:%i') AS end_time, event_date")
        ->from($this->table)
        ->get();
        return $query->result_array();
    }

    public function get_upcoming_events() {
        $query = $this->db->select("calendar_id, event_name, DATE_FORMAT(start_time, '%k:%i') AS start_time, 
        DATE_FORMAT(end_time, '%k:%i') AS end_time, event_date")
        ->from($this->table)
        ->where('event_date >=', date('Y-m-d'))
        ->get();
        return $query->result_array();
    }

    public function get_past_events() {
        $query = $this->db->select("calendar_id, event_name, DATE_FORMAT(start_time, '%k:%i') AS start_time, 
        DATE_FORMAT(end_time, '%k:%i') AS end_time, event_date")
        ->from($this->table)
        ->where('event_date <', date('Y-m-d'))
        ->get();
        return $query->result_array();
    }

    public function get_events_by_dates($start, $end) {
        $query = $this->db->select('*')
        ->from($this->table)
        ->where('event_date >=', $start)
        ->where('event_date <=', $end)
        ->get();
        return $query->result_array();
    }

}
