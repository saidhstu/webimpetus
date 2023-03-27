<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Domains extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint'     => 36,
                'collation' => 'utf8mb4_general_ci',
            ],
            'sid' => [
                'type' => 'INT',
                'constraint'     => 25,
                'default' => 0,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint'     => 124,
                'collation' => 'utf8mb4_general_ci',
            ],
            'notes' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
            ],
            'image_logo' => [
                'type' => 'longblob',
                'null' => true,
            ],
            'image_type' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('domains');
    }

    public function down()
    {
        $this->forge->dropTable('domains');
    }
}
