<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddcolumninTask extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'customers_id', 'tasks');
        if (!$isExists) {
            $this->forge->addColumn('tasks', array(
                'customers_id' => $fieldOption,
            ));
        } 
       
       
        $isExists = $db->fieldExists( 'contacts_id', 'tasks');
        if (!$isExists) {
            $this->forge->addColumn('tasks', array(
                'contacts_id' => $fieldOption,
            ));
        } 
       
    }

    public function down()
    {
      
    }
}
