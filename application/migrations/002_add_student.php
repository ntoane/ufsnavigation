<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_student extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'std_number' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ),
            'std_fname' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'std_lname' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('std_number', true);
        $this->dbforge->create_table('tbl_student');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_student');
    }

}
