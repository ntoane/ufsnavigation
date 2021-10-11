<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_module extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'module_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
            ),
            'module_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('module_code', true);
        $this->dbforge->create_table('tbl_module');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_module');
    }

}
