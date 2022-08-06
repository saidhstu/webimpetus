<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUuidInContacts extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'uuid', 'contacts');
        if (!$isExists) {
            $this->forge->addColumn('contacts', array(
                'uuid' => $fieldOption,
            ));
        } 
    }

    public function down()
    {
        //
    }
}
