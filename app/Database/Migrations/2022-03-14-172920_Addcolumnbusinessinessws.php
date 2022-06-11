<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addcolumnbusinessinessws extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $fieldOption = array(
            'type' => 'VARCHAR',
            'constraint' => '245',
            'null' => true,
        );
       
        $isExists = $db->fieldExists( 'company_address', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'company_address' => $fieldOption,
            ));
        } 
       
       
        $isExists = $db->fieldExists( 'company_number', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'company_number' => $fieldOption,
            ));
        } 
       
       
        $isExists = $db->fieldExists( 'vat_number', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'vat_number' => $fieldOption,
            ));
        } 
       
       
        $isExists = $db->fieldExists( 'email', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'email' => $fieldOption,
            ));
        } 
      
        $isExists = $db->fieldExists( 'web_site', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'web_site' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'telephone_no', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'telephone_no' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'payment_page_url', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'payment_page_url' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'country_code', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'country_code' => $fieldOption,
            ));
        } 
        $isExists = $db->fieldExists( 'directors', 'businesses');
        if (!$isExists) {
            $this->forge->addColumn('businesses', array(
                'directors' => $fieldOption,
            ));
        } 
    }

    public function down()
    {
      
    }
}