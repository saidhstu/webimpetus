<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUuidBusinessIdFieldTypeToVarcharInCustomersAndContactsTable extends Migration
{
    public function up()
    {
        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        );
        $this->forge->modifyColumn('customers', array(
            'uuid_business_id' => $fieldOption,
        ));
        $this->forge->modifyColumn('contacts', array(
            'uuid_business_id' => $fieldOption,
        ));
    }

    public function down()
    {
        $fieldOption = array(
            'type' => 'INT',
            'constraint' => 11,
            'null' => true,
        );
        $this->forge->modifyColumn('customers', array(
            'uuid_business_id' => $fieldOption
        ));
        $this->forge->modifyColumn('contacts', array(
            'uuid_business_id' => $fieldOption
        ));
    }
}
