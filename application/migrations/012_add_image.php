<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_image extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'image_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('image_id', true);
        $this->dbforge->create_table('tbl_image');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_image');
    }

}
