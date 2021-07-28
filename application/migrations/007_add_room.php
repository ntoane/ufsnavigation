<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_room extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'room_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'building_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'room_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'floor_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('room_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (building_id) REFERENCES tbl_building(building_id) ON DELETE CASCADE');
        $this->dbforge->create_table('tbl_room');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_room');
    }

}
