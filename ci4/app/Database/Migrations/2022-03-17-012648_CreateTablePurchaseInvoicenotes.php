<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePurchaseInvoicenotes extends Migration
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
            'purchase_invoices_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => '11',
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
        $this->forge->createTable('purchase_invoice_notes');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_invoice_notes');
    }
}
