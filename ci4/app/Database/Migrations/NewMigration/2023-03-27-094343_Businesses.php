<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Businesses extends Migration
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
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci'
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'null' => true,
            ],
            'default_business' => [
                'type' => 'INT',
                'constraint'     => 1,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'company_address' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'company_number' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'vat_number' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'web_site' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'telephone_no' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'payment_page_url' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'language_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 7,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'directors' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'no_of_shares' => [
                'type' => 'decimal',
                'constraint'     => '12,2',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'trading_as' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'business_contacts' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'business_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 24,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('businesses');
    }

    public function down()
    {
        $this->forge->dropTable('businesses');
    }
}
