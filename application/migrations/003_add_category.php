<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_category extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'category_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ),
            'created_at datetime default current_timestamp',
        ));

        $this->dbforge->add_key('category_id', true);
        $this->dbforge->create_table('tbl_category');

        foreach ($this->seedData as $seed) {
            $sql = "INSERT INTO tbl_category (`category_name`) VALUES " . $seed;
            $this->db->query($sql);
        }
    }

    public function down() {
        $this->dbforge->drop_table('tbl_category');
    }

    private $seedData = array(
        '("Buildings")',
        '("Parkings")',
        '("Offices")',
        '("Lecture Halls")',
        '("Study Places")',
        '("Health Services")',
        '("Shops")',
        '("Sports")',
        '("Hostels")'
    );

}
