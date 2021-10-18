<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_room_direction extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'room_direction_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'room_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'entrance' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'directions' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('room_direction_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES tbl_room(room_id) ON DELETE CASCADE');
        $this->dbforge->create_table('tbl_room_direction');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_room_direction');
    }

}
