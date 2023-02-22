<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableContentBlocksList extends Migration
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
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'text' => [
                'type'       => 'text',
                'constraint' => '2048',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => '5',
                'null' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'content_id' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'sort' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' => 0,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => '127',
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
        $this->forge->createTable('content_blocks_list');
    }

    public function down()
    {
        $this->forge->dropTable('content_blocks_list');
    }
}
