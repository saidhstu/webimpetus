<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'client_id'       => [
            'type'       => 'INT',
            'constraint' => '11',
        ],
        'first_name' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'surname' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'title' => [
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        ],
        'saludation' => [
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        ],
        'comments' => [
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        ],
        'news_letter_status' => [
            'type' => 'VARCHAR',
            'constraint' => '150',
            'null' => true,
        ],
        'allow_web_access' => [
            'type' => 'INT',
            'constraint' => '1',
            'null' => true,
        ],
        'email'       => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'password'       => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'direct_phone'       => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'mobile'       => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
            'null' => true,
        ],
        'direct_fax'       => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
            'null' => true,
        ],
        'created_at datetime default current_timestamp',
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('employees');
}

public function down()
{
    $this->forge->dropTable('employees');
}

}
