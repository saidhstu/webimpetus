<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNewTablePurchaseOrdersItems1 extends Migration
{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'purchase_orders_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'discount' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
        
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
           
            'created_at datetime default current_timestamp',
            'modified_at datetime default null on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');

        $db = \Config\Database::connect();
        $isExists = $db->tableExists( 'purchase_order_items');
        if(!$isExists){

            $this->forge->createTable('purchase_order_items');
        }
    }

    public function down()
    {
        $this->forge->dropTable('purchase_order_items');
    }
}
