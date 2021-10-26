<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends MY_Model {

    protected $table = 'tbl_student';
    protected $table_timetable = 'tbl_timetable';

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

    /************************* TIMETABLE **********************/
    public function add_timetable($data) {
        return $this->insert($this->table_timetable, $data);
    }

    public function delete_timetable($timetable_id) {
        $tables = array($this->table_timetable);
        $where = array(
            'timetable_id' => $timetable_id
        );
        return $this->delete($tables, $where);
    }

    public function get_student_timetable($std_number) {
        $query = $this->db->select("* FROM `tbl_timetable` WHERE std_number = " . $std_number . 
            " ORDER BY FIELD(day, 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'), start_time")
            ->get();
        return $query->result_array();
    }

    public function get_today_classes($std_number) {
        $query = $this->db->select('*')
        ->from($this->table_timetable)
        ->where('std_number', $std_number)
        ->where('day', date('l'))
        ->get();
        return $query->result_array();
    }

}
