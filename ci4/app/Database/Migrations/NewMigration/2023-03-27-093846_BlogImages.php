<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlogImages extends Migration
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
            'blog_id' => [
                'type' => 'INT',
                'constraint'     => 5
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'collation' => 'utf8mb4_general_ci'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('blog_images');
    }

    public function down()
    {
        $this->forge->dropTable('blog_images');
    }
}
