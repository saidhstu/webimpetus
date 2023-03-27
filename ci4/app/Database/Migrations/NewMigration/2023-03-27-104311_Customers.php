<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
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
            'uuid' => [
                'type'           => 'VARCHAR',
                'constraint'     => 64,
                'null' => true,
            ],
            'company_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci',
            ],
            'acc_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'contact_firstname' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci',
            ],
            'contact_lastname' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci',
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => 1,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci',
            ],
            'address1' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'address2' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'postal_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 45,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint'     => 45,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'notes' => [
                'type' => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'supplier' => [
                'type'           => 'INT',
                'constraint'     => 1,
                'null' => true,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'categories' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
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
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
