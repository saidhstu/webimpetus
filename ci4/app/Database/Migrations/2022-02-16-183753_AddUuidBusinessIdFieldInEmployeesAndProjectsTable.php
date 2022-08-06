<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUuidBusinessIdFieldInEmployeesAndProjectsTable extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        );
        $this->forge->addColumn('employees', array(
            'uuid_business_id' => $fieldOption,
        ));
        $this->forge->addColumn('projects', array(
            'uuid_business_id' => $fieldOption,
        ));
    }

    public function down()
    {
        $this->forge->dropColumn('employees', 'uuid_business_id');
        $this->forge->dropColumn('projects', 'uuid_business_id');
    }
}
