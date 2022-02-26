<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Workorder extends Migration
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
            'order_number'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
         
            'client_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'bill_to' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'comments' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'order_by' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'project_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '245',
                'null' => true,
            ],
            'date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            
            'balance_due' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'total' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'total_paid' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'paid_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
          
            'payment_pin_or_passcode' => [
                'type' => 'VARCHAR',
                'constraint' => '245',
                'null' => true,
            ],
            'invoice_tax_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'template' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
          
            'customer_ref_po' => [
                'type' => 'VARCHAR',
                'constraint' => '245',
                'null' => true,
            ],
            'tax_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'currency_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'base_currency_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'exchange_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'tax_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'total_qty' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'discount' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'total_due' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'total_tax' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'total_due_with_tax' => [
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
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'modified_at datetime default null on update current_timestamp',
        ]);
    
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('work_orders');
    }

    public function down()
    {
        $this->forge->dropTable('work_orders');
    }
}
