<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MediaList extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint'     => 255,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint'     => 3,
                'default' => 1
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint'     => 150,
                'collation' => 'utf8mb4_general_ci',
                'null' => true,
            ],
            'created' => [
                'type' => 'timestamp',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('media_list');
    }

    public function down()
    {
        $this->forge->dropTable('media_list');
    }
}
