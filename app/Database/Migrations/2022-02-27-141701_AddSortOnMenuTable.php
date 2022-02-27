<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSortOnMenuTable extends Migration
{
    public function up()
    {
        
        $fields = [
            'sort_order'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
        ];
       
       $this->forge->addColumn('menu', $fields);
    }

    public function down()
    {
        //
    }
}
