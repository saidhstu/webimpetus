<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 25,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint'     => 36,
                'collation' => 'utf8mb4_general_ci'
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '124',
                'collation' => 'utf8mb4_general_ci'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'notes' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'image_logo' => [
                'type' => 'longblob',
            ],
            'sort_order' => [
                'type' => 'INT',
                'constraint'     => 15,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
