<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addcolumnbusinessinemployess extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
        $db = \Config\Database::connect();
        $isExists = $db->fieldExists('businesses', 'employees');
        if ($isExists) {
            $this->forge->modifyColumn('employees', array(
                'businesses' => $fieldOption,
            ));
        } else {
            $this->forge->addColumn('employees', array(
                'businesses' => $fieldOption,
            ));
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $isUuidBusinessIdExist = $db->fieldExists('businesses', 'employees');
        if (!$isUuidBusinessIdExist) {
            $this->forge->dropColumn('employees', 'businesses');
        }
    }
}
