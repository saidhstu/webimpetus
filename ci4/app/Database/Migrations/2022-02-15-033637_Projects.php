<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Projects extends Migration
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
        'customers_id'       => [
            'type'       => 'INT',
            'constraint' => '11',
            'null' => true,
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'start_date' => [
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        ],
        'budget'       => [
            'type'       => 'DECIMAL',
            'constraint' => '10,2',
        ],
        'rate'       => [
            'type'       => 'DECIMAL',
            'constraint' => '10,2',
        ],
        'currency'       => [
            'type'       => 'VARCHAR',
            'constraint' => '20',
        ],
        'deadline_date' => [
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        ],
        'employees_id' => [
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        ],
        'active' => [
            'type' => 'INT',
            'constraint' => '1',
            'null' => true,
        ],
       
    'created_at datetime default current_timestamp',
    ]);
    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('projects');
}

public function down()
{
    $this->forge->dropTable('projects');
}
}
