<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBusinessCodeToBusiness extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $isExists = $db->fieldExists('business_code', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'business_code' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '24',
                    'after' => 'business_contacts',
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
