<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adduuidinproject extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        );
        $db = \Config\Database::connect();
        $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', 'projects');
        if ($isUuidBusinessIdExist) {
            $this->forge->modifyColumn('projects', array(
                'uuid_business_id' => $fieldOption,
            ));
        } else {
            $this->forge->addColumn('projects', array(
                'uuid_business_id' => $fieldOption,
            ));
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $isUuidBusinessIdExist = $db->fieldExists('uuid_business_id', 'projects');
        if (!$isUuidBusinessIdExist) {
            $this->forge->dropColumn('projects', 'uuid_business_id');
        }
    }
}
