<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adduuidforall extends Migration
{
    public function up()
    {
        $fields = [
            'uuid_business_id'       => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
        ];

       
       $this->forge->addColumn('blocks_list', $fields);
       $this->forge->addColumn('blog_comments', $fields);
       $this->forge->addColumn('blog_images', $fields);
       $this->forge->addColumn('categories', $fields);
       $this->forge->addColumn('contacts', $fields);
       $this->forge->addColumn('content_category', $fields);
       $this->forge->addColumn('content_list', $fields);
       $this->forge->addColumn('customers', $fields);
       $this->forge->addColumn('domains', $fields);
       $this->forge->addColumn('enquiries', $fields);
       $this->forge->addColumn('media_list', $fields);
       $this->forge->addColumn('menu', $fields);
       $this->forge->addColumn('meta_fields', $fields);
       $this->forge->addColumn('migrations', $fields);
       $this->forge->addColumn('secrets', $fields);
       $this->forge->addColumn('secrets_services', $fields);
       $this->forge->addColumn('services', $fields);
       $this->forge->addColumn('tenants', $fields);
       $this->forge->addColumn('tenants_services', $fields);
       $this->forge->addColumn('users', $fields);
       $this->forge->addColumn('webpage_images', $fields);
    }

    public function down()
    {
        //
    }
}
