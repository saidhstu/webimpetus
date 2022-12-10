<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTax extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tax_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '24',
                'null' => true,
            ],
            'tax_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0,
            ],
            'description' => [
                'type'       => 'text',
                'constraint' => '1023',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('taxes');
    }

    public function down()
    {
        $this->forge->dropTable('taxes');
    }
}
