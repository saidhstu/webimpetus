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
            'category_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '24',
                'null' => true,
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => '127',
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
        $this->forge->createTable('product_categories');
    }

    public function down()
    {
        $this->forge->dropTable('product_categories');
    }
}
