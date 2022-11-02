<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSprints extends Migration
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
            'sprint_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'note'       => [
                'type' => 'text',
                'null' => true,
            ],
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sprints');
    }

    public function down()
    {
        $this->forge->dropTable('sprints');
    }
}
