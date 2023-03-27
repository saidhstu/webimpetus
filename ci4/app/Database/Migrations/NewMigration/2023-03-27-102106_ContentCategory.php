<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentCategory extends Migration
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
            'created' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'modified' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'groupid' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'categoryid' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'uuid' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'contentid' => [
                'type' => 'INT',
                'constraint'     => 11
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('created');
        $this->forge->addKey('modified');
        $this->forge->addKey('groupid');
        $this->forge->addKey('categoryid');
        $this->forge->addKey('uuid');
        $this->forge->addKey('contentid');
        $this->forge->createTable('content_category');
    }

    public function down()
    {
        $this->forge->dropTable('content_category');
    }
}
