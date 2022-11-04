<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryToDocument extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $isExists = $db->fieldExists('category_id', 'documents');
        if (!$isExists) {
            $this->forge->addColumn('documents', array(
                'category_id' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'after' => 'document_date',
                    'null' => true,
                )
            ));
        }
    }

    public function down()
    {
        //
    }
}
