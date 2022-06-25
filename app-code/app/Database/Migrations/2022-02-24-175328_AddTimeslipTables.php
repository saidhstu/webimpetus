<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimeslipTables extends Migration
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
            'task_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'week_no' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'employee_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'slip_start_date' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'slip_timer_started' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'slip_end_date' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'slip_timer_end' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'break_time' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],
            'break_time_start' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'break_time_end' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'slip_hours' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'slip_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'slip_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'slip_timer_accumulated_seconds' => [
                'type' => 'INT',
                'constraint' => '11',
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
        $this->forge->createTable('timeslips');
    }

    public function down()
    {
        $this->forge->dropTable('timeslips');
    }
}
