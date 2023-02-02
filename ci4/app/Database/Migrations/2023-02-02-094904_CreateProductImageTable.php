<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductImageTable extends Migration
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
            'product_id' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '24',
                'null' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('product_images');
    }

    public function down()
    {
        $this->forge->dropTable('product_images');
    }
}
