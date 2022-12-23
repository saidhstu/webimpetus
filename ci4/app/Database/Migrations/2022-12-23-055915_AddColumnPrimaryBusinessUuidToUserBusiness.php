<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnPrimaryBusinessUuidToUserBusiness extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $isExists = $db->fieldExists('primary_business_uuid', 'user_business');
        if (!$isExists) {
            $this->forge->addColumn('user_business', array(
                'primary_business_uuid' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '127',
                    'after' => 'user_business_id',
                    'default' => null,
                )
            ));
        }
    }

    public function down()
    {
        //
    }
}
