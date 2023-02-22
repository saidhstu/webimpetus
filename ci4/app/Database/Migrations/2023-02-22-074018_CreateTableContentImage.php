<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableContentImage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'content_id' => [
                'type'       => 'INT',
                'constraint' => '11',
                'default' => 0,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('content_images');
    }

    public function down()
    {
        $this->forge->dropTable('content_images');
    }
}
