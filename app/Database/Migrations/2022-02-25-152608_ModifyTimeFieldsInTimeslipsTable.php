<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyTimeFieldsInTimeslipsTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('timeslips', array(
            'break_time_start' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'break_time_end' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
        ));
    }

    public function down()
    {
        $this->forge->modifyColumn('timeslips', array(
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
        ));
    }
}
