<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createtabledocuments extends Migration
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
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'metadata' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            
            'document_date' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            
            'billing_status' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'modified_at datetime NULL on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('documents');
    }

    public function down()
    {
        $this->forge->dropTable('documents');
    }
}
