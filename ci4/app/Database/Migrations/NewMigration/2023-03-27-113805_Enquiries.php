<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Enquiries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'collation' => 'utf8mb4_general_ci',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'collation' => 'utf8mb4_general_ci',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint'     => 225,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'message' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
            ],
            'type' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'default' => 1,
            ],
            'attachment' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'att_type' => [
                'type' => 'longtext',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'contentid' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'ipaddress' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'custom_fields' => [
                'type' => 'longtext',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'created' => [
                'type' => 'timestamp',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('enquiries');
    }

    public function down()
    {
        $this->forge->dropTable('enquiries');
    }
}
