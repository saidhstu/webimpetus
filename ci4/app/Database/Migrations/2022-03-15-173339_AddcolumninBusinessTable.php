<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddcolumninBusinessTable extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'DECIMAL',
            'constraint' => '12,2',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'no_of_shares', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'no_of_shares' => $fieldOption,
            ));
        } 
       
    }

    public function down()
    {
      
    }
}
