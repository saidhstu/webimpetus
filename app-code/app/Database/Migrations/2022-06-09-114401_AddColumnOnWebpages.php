<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOnWebpages extends Migration
{
    public function up()
    {


        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );

        $this->forge->addColumn('content_list', array(
            'published_date' => $fieldOption,
        ));
        

    }

    public function down()
    {
        //
    }
}
