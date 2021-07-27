<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_building extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'building_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'building_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'lat_coordinate' => array(
                'type' => 'DOUBLE',
                'null' => false,
            ),
            'lon_coordinate' => array(
                'type' => 'DOUBLE',
                'null' => false,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('building_id', true);
        $this->dbforge->create_table('tbl_building');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_building');
    }

}
