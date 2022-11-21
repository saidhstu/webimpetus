<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModuleNameToTemplateTable extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $isExists = $db->fieldExists('module_name', 'templates');
        if (!$isExists) {
            $this->forge->addColumn('templates', array(
                'module_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '64',
                    'after' => 'comment',
                    'null' => true,
                )
            ));
        }

        $isExists = $db->fieldExists('is_default', 'templates');
        if (!$isExists) {
            $this->forge->addColumn('templates', array(
                'is_default' => array(
                    'type' => 'TINYINT',
                    'constraint' => '1',
                    'after' => 'module_name',
                    'default' => false,
                )
            ));
        }
    }

    public function down()
    {
        //
    }
}
