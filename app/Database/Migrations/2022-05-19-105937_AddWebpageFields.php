<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWebpageFields extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'sort', 'blocks_list');
        if (!$isExists) {
            $this->forge->addColumn('blocks_list', array(
                'sort' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'type', 'blocks_list');
        if (!$isExists) {
            $this->forge->addColumn('blocks_list', array(
                'type' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '245',
                    'null' => true,
                ),
            ));
        } 
        
    }

    public function down()
    {
        //
    }
}
