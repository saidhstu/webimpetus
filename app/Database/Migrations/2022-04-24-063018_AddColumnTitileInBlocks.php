<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnTitileInBlocks extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'title', 'blocks_list');
        if (!$isExists) {
            $this->forge->addColumn('blocks_list', array(
                'title' => $fieldOption,
            ));
        } 
        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'webpages_id', 'blocks_list');
        if (!$isExists) {
            $this->forge->addColumn('blocks_list', array(
                'webpages_id' => $fieldOption,
            ));
        } 
    }

    public function down()
    {
        //
    }
}
