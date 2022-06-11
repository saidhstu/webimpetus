<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyOrAddUuidBusinessIdInAllTables extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        foreach ($tables as $table) {
            $fieldOption = array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            );
            $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', $table);
            if ($isUuidBusinessIdExist) {
                $this->forge->modifyColumn($table, array(
                    'uuid_business_id' => $fieldOption,
                ));
            } else {
                $this->forge->addColumn($table, array(
                    'uuid_business_id' => $fieldOption,
                ));
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        foreach ($tables as $table) {
            $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', $table);
            if (!$isUuidBusinessIdExist) {
                $this->forge->dropColumn($table, 'uuid_business_id');
            }
        }
    }
}
