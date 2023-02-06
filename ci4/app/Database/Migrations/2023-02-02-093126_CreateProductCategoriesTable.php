<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoriesTable extends Migration
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
            'uuid_product' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'uuid_category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('product_categories');
    }

    public function down()
    {
        $this->forge->dropTable('product_categories');
    }
}
