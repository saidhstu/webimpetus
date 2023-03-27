<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerCategories extends Migration
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
            'customer_id' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'categories_id' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'uuid' => [
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
        $this->forge->createTable('customer_categories');
    }

    public function down()
    {
        $this->forge->dropTable('customer_categories');
    }
}
