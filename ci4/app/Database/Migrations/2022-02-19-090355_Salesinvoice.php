<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Salesinvoice extends Migration
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
            'invoice_number'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'terms'       => [
                'type'       => 'VARCHAR',
                'constraint' => '245',
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
            'notes' => [
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
            'due_date' => [
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
            'analysis_ledger' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'analysis_account' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
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
            'inv_template' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'print_template_code' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'internal_notes' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'inv_customer_ref_po' => [
                'type' => 'VARCHAR',
                'constraint' => '245',
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
            'inv_exchange_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'inv_tax_code' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'total_hours' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
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
        $this->forge->createTable('sales_invoices');
    }

    public function down()
    {
        $this->forge->dropTable('sales_invoices');
    }
}
