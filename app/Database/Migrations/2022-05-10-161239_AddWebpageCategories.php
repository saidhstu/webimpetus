<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWebpageCategories extends Migration
{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'webpage_id' => [
                'type' => 'INT',
                'constraint' => 11,
               
            ],
            'categories_id' => [
                'type' => 'INT',
                'constraint' => 11,
             
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            
            'uuid_business_id' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
           
            'created_at datetime default current_timestamp',
            'modified_at datetime default null on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');

        $db = \Config\Database::connect();
        $isExists = $db->tableExists( 'webpage_categories');
        if(!$isExists){

            $this->forge->createTable('webpage_categories');
        }
    }

    public function down()
    {
        $this->forge->dropTable('webpage_categories');
    }
}
