<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOnWebpages extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'published_date', 'content_list');
        if (!$isExists) {
            $this->forge->addColumn('content_list', array(
                'published_date' => $fieldOption,
            ));
        } 

    }

    public function down()
    {
        //
    }
}
