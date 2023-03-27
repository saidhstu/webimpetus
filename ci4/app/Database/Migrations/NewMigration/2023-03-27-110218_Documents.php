<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documents extends Migration
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
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'metadata' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'document_date' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'billing_status' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'modified_at' => [
                'type' => 'datetime',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP',
                'ON UPDATE CURRENT_TIMESTAMP' => TRUE,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('documents');
    }

    public function down()
    {
        $this->forge->dropTable('documents');
    }
}
