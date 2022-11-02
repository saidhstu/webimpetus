<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMorecolumninTask extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );

        $fieldOptionVarchar = array(
            'type' => 'VARCHAR',
            'constraint' => '127',
            'null' => true,
        );

        $isExists = $db->fieldExists('category', 'tasks');
        if (!$isExists) {
            $this->forge->addColumn('tasks', array(
                'category' => $fieldOptionVarchar,
            ));
        }

        $isExists = $db->fieldExists('priority', 'tasks');
        if (!$isExists) {
            $this->forge->addColumn('tasks', array(
                'priority' => $fieldOptionVarchar,
            ));
        }

        $isExists = $db->fieldExists('sprint_id', 'tasks');
        if (!$isExists) {
            $this->forge->addColumn('tasks', array(
                'sprint_id' => $fieldOption,
            ));
        }
    }

    public function down()
    {
    }
}
