<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectsTable extends Migration
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
            'client_id'       => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'project_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'start_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'budget' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'rate' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'currency' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'deadline_date' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
            ],
            'project_incharge' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'project_active' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'uuid_business' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'created_at datetime default current_timestamp',
            'modified_at datetime default null on update current_timestamp',
        ]);
    
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('projects');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
    }
}
