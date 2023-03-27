<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlogComments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type'       => 'VARCHAR',
                'constraint' => '36',
                'collation' => 'utf8mb4_general_ci'
            ],
            'blog_id' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'blog_uuid' => [
                'type'       => 'VARCHAR',
                'constraint' => '36',
                'collation' => 'utf8mb4_general_ci'
            ],
            'Name' => [
                'type' => 'VARCHAR',
                'constraint' => '36',
                'collation' => 'utf8mb4_general_ci'
            ],
            'Status' => [
                'type' => 'smallint',
                'constraint'     => 6,
                'default' => 0
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint'     => 50,
                'collation' => 'utf8mb4_general_ci',
            ],
            'comments' => [
                'type' => 'text',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'comment_by' => [
                'type' => 'VARCHAR',
                'constraint'     => 36,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint'     => 64,
                'default' => 1
            ],
            'site_uuid' => [
                'type' => 'VARCHAR',
                'constraint'     => 36,
                'null' => true
            ],
            'Created' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'Modified' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'OrderNum' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'Server_Number' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('ID', true);
        $this->forge->createTable('blog_comments');
    }

    public function down()
    {
        $this->forge->dropTable('blog_comments');
    }
}
