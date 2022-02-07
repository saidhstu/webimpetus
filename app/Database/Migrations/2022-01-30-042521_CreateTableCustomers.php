<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCustomers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'company_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'acc_no' => [
                'type' => 'VARCHAR',
				'constraint' => '100',
                'null' => true,
            ],
			'status' => [
                'type' => 'INT',
				'constraint' => '1',
                'null' => true,
            ],
            'contact_firstname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'contact_lastname'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'address1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address2'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'city'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'country'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'postal_code'       => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'notes'       => [
                'type'       => 'text',
                'null' => true,
            ],
            'supplier' => [
                'type' => 'INT',
				'constraint' => '1',
                'null' => true,
            ],
            'website'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
