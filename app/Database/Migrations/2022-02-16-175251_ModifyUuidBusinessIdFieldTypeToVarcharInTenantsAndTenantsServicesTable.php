<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUuidBusinessIdFieldTypeToVarcharInTenantsAndTenantsServicesTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ),
        ));
    }

    public function down()
    {
        $this->forge->modifyColumn('tenants', array(
            'uuid_business_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
        ));
        $this->forge->modifyColumn('tenants_services', array(
            'uuid_business_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
        ));
    }
}
