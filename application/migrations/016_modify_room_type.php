<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Modify_Room_Type extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_column('tbl_room', array(
            'room_type' => array(
                'type' => 'ENUM("1", "2", "3")',
                'comment' => '1=room , 2=male toilet, 3=female toilet',
                'null' => false,
                'after' => 'floor_num'
            ),
        ));
    }

    public function down()
    {
        $this->dbforge->drop_column('tbl_room', 'room_type');
    }

}