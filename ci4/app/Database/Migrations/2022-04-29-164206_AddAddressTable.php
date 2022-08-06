<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAddressTable extends Migration
{
    public function up(){
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_line_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_line_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_line_3' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_line_4' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'post_code' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'uuid_contact' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'uuid_user' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'uuid_customer' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_type' => [
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
        $isExists = $db->tableExists( 'addresses');
        if(!$isExists){

            $this->forge->createTable('addresses');
        }
    }

    public function down()
    {
        $this->forge->dropTable('addresses');
    }
}
