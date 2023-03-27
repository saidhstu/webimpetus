<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentList extends Migration
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
            'title' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
            ],
            'sub_title' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'content' => [
                'type'           => 'longtext',
                'collation' => 'utf8mb4_general_ci',
            ],
            'type' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'default' => 1,
            ],
            'status' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'default' => 1,
            ],
            'code' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
            ],
            'meta_title' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'meta_description' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'meta_keywords' => [
                'type'           => 'text',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'custom_fields' => [
                'type'           => 'longtext',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'custom_assets' => [
                'type'           => 'longtext',
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'uuid' => [
                'type'           => 'INT',
                'constraint'     => 25,
                'default' => 0,
            ],
            'publish_date' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'categories' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'published_date' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'language_code' => [
                'type' => 'VARCHAR',
                'constraint'     => 7,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('id');
        $this->forge->createTable('content_list');
    }

    public function down()
    {
        $this->forge->dropTable('content_list');
    }
}
