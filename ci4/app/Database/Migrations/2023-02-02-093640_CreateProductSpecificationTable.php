<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductSpecificationTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint' => '24',
                'null' => true,
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('product_specifications');
    }

    public function down()
    {
        $this->forge->dropTable('product_specifications');
    }
}
