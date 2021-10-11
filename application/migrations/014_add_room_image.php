<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_room_image extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'room_image_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'room_id' => array(
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

        $this->dbforge->add_key('room_image_id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (room_id) REFERENCES tbl_room(room_id) ON DELETE CASCADE');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (image_id) REFERENCES tbl_image(image_id) ON DELETE CASCADE');
        $this->dbforge->create_table('tbl_room_image');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_room_image');
    }

}
