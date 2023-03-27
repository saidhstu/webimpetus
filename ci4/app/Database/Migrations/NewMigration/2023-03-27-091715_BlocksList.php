<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlocksList extends Migration
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
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'collation' => 'utf8mb4_general_ci'
            ],
            'text' => [
                'type' => 'mediumtext',
                'null' => true,
                'collation' => 'utf8mb4_general_ci'
            ],
            'status' => [
                'type' => 'INT',
                'constraint'     => 5,
                'null' => false,
                'default' => 1
            ],
            'created' => [
                'type' => 'timestamp',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint'     => 245,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'webpages_id' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
                'default' => 1
            ],
            'sort' => [
                'type' => 'INT',
                'constraint'     => 245,
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('blocks_list');
    }

    public function down()
    {
        $this->forge->dropTable('blocks_list');
    }
}
