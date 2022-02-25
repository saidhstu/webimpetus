<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'reported_by'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'projects_id'       => [
                'type'       => 'INT',
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
            'estimated_hour' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
           
            'rate'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'active' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'assigned_to'       => [
                'type'       => 'INT',
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
                'null' => true,
            ],
        
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
