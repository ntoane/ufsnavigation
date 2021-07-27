<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_notification extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'notification_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'calendar_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),

            'std_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'event_date' => array(
                'type' => 'DATE',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('notification_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (calendar_id) REFERENCES tbl_calendar(calendar_id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (std_number) REFERENCES tbl_student(std_number)');
        $this->dbforge->create_table('tbl_notification');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_notification');
    }

}
