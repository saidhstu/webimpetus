<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUuidBusinessIdFieldTypeToVarcharInUsersTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
    }

    public function down()
    {
        $this->forge->modifyColumn('users', array(
            'uuid_business_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
        ));
    }
}
