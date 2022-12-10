<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomInvoiceOrderNumberToTable extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $isExists = $db->fieldExists('custom_invoice_number', 'sales_invoices');
        if (!$isExists) {
            $this->forge->addColumn('sales_invoices', array(
                'custom_invoice_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                    'after' => 'invoice_number',
                    'default' => null,
                )
            ));
        }

        $isExists = $db->fieldExists('custom_invoice_number', 'purchase_invoices');
        if (!$isExists) {
            $this->forge->addColumn('purchase_invoices', array(
                'custom_invoice_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                    'after' => 'invoice_number',
                    'default' => null,
                )
            ));
        }

        $isExists = $db->fieldExists('custom_order_number', 'work_orders');
        if (!$isExists) {
            $this->forge->addColumn('work_orders', array(
                'custom_order_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                    'after' => 'order_number',
                    'default' => null,
                )
            ));
        }

        $isExists = $db->fieldExists('custom_order_number', 'purchase_orders');
        if (!$isExists) {
            $this->forge->addColumn('purchase_orders', array(
                'custom_order_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                    'after' => 'order_number',
                    'default' => null,
                )
            ));
        }
    }

    public function down()
    {
        //
    }
}
