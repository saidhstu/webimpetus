<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Businesses extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'uuid' => [
                'type' => 'VARCHAR',
				'constraint' => '100',
                'null' => true,
            ],
			'default_business' => [
                'type' => 'INT',
				'constraint' => '1',
                'null' => true,
            ],
           
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('businesses');
    }

    public function down()
    {
        //
    }
}
