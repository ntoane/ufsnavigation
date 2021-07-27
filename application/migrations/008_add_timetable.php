<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_timetable extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'timetable_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'std_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'room_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'module_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
            ),
            'start_time' => array(
                'type' => 'TIME',
                'null' => false,
            ),
            'end_time' => array(
                'type' => 'TIME',
                'null' => false,
            ),
            'day' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('timetable_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (std_number) REFERENCES tbl_student(std_number)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES tbl_room(room_id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_code) REFERENCES tbl_module(module_code)');
        $this->dbforge->create_table('tbl_timetable');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_timetable');
    }

}
