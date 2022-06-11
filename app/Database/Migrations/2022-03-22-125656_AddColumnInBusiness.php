<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnInBusiness extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'trading_as', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'trading_as' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'business_contacts', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'business_contacts' => $fieldOption,
            ));
        } 
       
    }

    public function down()
    {
      
    }
}
