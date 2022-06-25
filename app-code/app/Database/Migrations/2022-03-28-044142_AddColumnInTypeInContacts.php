<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnInTypeInContacts extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'contact_type', 'contacts');
        if (!$isExists) {
            $this->forge->addColumn('contacts', array(
                'contact_type' => $fieldOption,
            ));
        } 
       
    }

    public function down()
    {
        //
    }
}
