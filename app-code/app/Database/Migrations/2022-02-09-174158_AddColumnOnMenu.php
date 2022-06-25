<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOnMenu extends Migration
{
    public function up()
    {
  
        $fields = [
            'icon'       => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
                'default' => "fa fa-globe",
            ],
        ];

       
       $this->forge->addColumn('menu', $fields);


    }

    public function down()
    {
        //
    }
}
