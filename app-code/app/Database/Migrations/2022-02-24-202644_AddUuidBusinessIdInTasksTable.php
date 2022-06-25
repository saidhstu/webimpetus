<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUuidBusinessIdInTasksTable extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        );
        $db = \Config\Database::connect();
        $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', 'tasks');
        if ($isUuidBusinessIdExist) {
            $this->forge->modifyColumn('tasks', array(
                'uuid_business_id' => $fieldOption,
            ));
        } else {
            $this->forge->addColumn('tasks', array(
                'uuid_business_id' => $fieldOption,
            ));
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', 'tasks');
        if (!$isUuidBusinessIdExist) {
            $this->forge->dropColumn('tasks', 'uuid_business_id');
        }
    }
}
