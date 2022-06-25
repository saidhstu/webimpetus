<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategories extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'categories', 'customers');
        if (!$isExists) {
            $this->forge->addColumn('customers', array(
                'categories' => $fieldOption,
            ));
        } 
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'categories', 'content_list');
        if (!$isExists) {
            $this->forge->addColumn('content_list', array(
                'categories' => $fieldOption,
            ));
        } 
    }

    public function down()
    {
        //
    }
}
