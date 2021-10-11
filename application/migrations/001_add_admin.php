<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_admin extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'admin_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'fname' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'lname' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => true,
                'null' => false,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ),
            'password_changed' => array(
                'type' => 'ENUM("0","1")',
                'default' => "0",
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('admin_id', true);
        $this->dbforge->create_table('tbl_admin');

        $password = password_hash('user12345', PASSWORD_BCRYPT);

        $sql = "INSERT INTO tbl_admin (`fname`, `lname`, `email`, `password`) VALUES "
                . "('System', 'Developer', 'developer@admin.com','$password')";
        $this->db->query($sql);
    }

    public function down() {
        $this->dbforge->drop_table('tbl_admin');
    }

}
