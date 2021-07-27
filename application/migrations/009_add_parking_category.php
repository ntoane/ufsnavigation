<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_parking_category extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'cat_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'cat_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('cat_id', true);
        $this->dbforge->create_table('tbl_parking_category');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_parking_category');
    }

}
