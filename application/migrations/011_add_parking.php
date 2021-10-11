<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_parking extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'parking_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'cat_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ),
            'parking_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'parking_type' => array(
                'type' => 'ENUM("car", "wheelchair", "both")',
                'default' => 'car',
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

        $this->dbforge->add_key('parking_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (category_id) REFERENCES tbl_category(category_id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (cat_id) REFERENCES tbl_parking_category(cat_id) ON DELETE CASCADE');
        $this->dbforge->create_table('tbl_parking');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_parking');
    }

}
