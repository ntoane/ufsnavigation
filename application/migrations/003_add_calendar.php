<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_calendar extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'calendar_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'event_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'start_time' => array(
                'type' => 'TIME',
                'null' => false,
            ),
            'end_time' => array(
                'type' => 'TIME',
                'null' => false,
            ),
            'event_date' => array(
                'type' => 'DATE',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('calendar_id', true);
        $this->dbforge->create_table('tbl_calendar');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_calendar');
    }

}
