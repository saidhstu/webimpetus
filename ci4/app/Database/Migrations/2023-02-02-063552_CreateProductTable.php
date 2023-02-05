<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
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
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '127',
                'null' => true,
            ],
            'product_code' => [
                'type' => 'VARCHAR',
                'constraint' => '23',
                'null' => true,
            ],
            'product_description' => [
                'type'       => 'text',
                'constraint' => '2048',
                'null' => true,
            ],
            'product_category' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
            ],
            'product_sku' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => true,
            ],
            'is_published' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default' => 0,
            ],
            'stock_available' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0,
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => '11',
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
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
