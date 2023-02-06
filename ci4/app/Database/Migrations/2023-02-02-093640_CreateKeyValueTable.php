<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKeyValueTable extends Migration
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
            'uuid_product' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'key_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'key_value' => [
                'type' => 'VARCHAR',
                'constraint' => '24',
                'null' => true,
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('key_values');
    }

    public function down()
    {
        $this->forge->dropTable('key_values');
    }
}
