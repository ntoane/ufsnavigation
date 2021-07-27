<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_building_image extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'building_image_id' => array(
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
            'image_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('building_image_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (building_id) REFERENCES tbl_building(building_id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (image_id) REFERENCES tbl_image(image_id)');
        $this->dbforge->create_table('tbl_building_image');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_building_image');
    }

}
