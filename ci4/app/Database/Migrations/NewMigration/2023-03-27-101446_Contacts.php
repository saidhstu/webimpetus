<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contacts extends Migration
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
            'client_id' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'surname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'saludation' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'comments' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'news_letter_status' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'allow_web_access' => [
                'type'           => 'INT',
                'constraint'     => 1,
                'null' => true,
            ],
            'contact_type' => [
                'type'           => 'VARCHAR',
                'constraint'     => 245,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci',
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'direct_phone' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'collation' => 'utf8mb4_general_ci'
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'direct_fax' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}
