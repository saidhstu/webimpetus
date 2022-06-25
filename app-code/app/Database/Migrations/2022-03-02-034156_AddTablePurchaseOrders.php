<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTablePurchaseOrders extends Migration
{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'purchase_order_no' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'tax_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'currency_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'unit_price' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'unit_qty' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'exchange_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'total_without_tax' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'comments' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_by' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'project_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'supplier_vat_no' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'payment_due_on' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'payment_made_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'billing_frequency' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
           
            'purchase_order_inactive' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,

            ],
            'vat_charge' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $tableExists = $db->tableExists("purchase_orders");
        if(!$tableExists){

            $this->forge->createTable('purchase_orders');
        }
    }

    public function down()
    {
        $this->forge->dropTable('purchase_orders');
    }
}
