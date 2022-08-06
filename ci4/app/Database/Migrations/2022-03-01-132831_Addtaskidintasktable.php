<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addtaskidintasktable extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'INT',
            'constraint' => '11',
            'null' => true,
        );
        $db = \Config\Database::connect();
        $fieldExist = $db->fieldExists('task_id', 'tasks');
        if ($fieldExist) {
            $this->forge->modifyColumn('tasks', array(
                'task_id' => $fieldOption,
            ));
        } else {
            $this->forge->addColumn('tasks', array(
                'task_id' => $fieldOption,
            ));
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $fieldExist = $db->fieldExists('task_id', 'tasks');
        if (!$fieldExist) {
            $this->forge->dropColumn('tasks', 'task_id');
        }
    }
}
