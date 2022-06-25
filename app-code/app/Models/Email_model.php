<?php
namespace App\Models;
use CodeIgniter\Model;
use Config\Database;

class Email_model extends Model
{

    public $_table_prefix;
    protected $Events_Model;
    protected $db;
    protected $email;
    protected $Dashboard;

    function __construct()
    {
        parent::__construct();
        $this->_table_prefix = "";
        $this->db = Database::connect();
        $this->email = \Config\Services::email();
    }

  

    function send_mail($to, $from_name, $from_email, $message, $subject, $file = [], $to_name = '', $cc = '', $bcc = '')
    {   
        $emailConfig = \Config\Services::email();
        

        if($to_name===''){
            $to_name = $to;
        }

 
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

        $validEmail = false;
        if( is_array( $cc )){
            
            foreach( $cc as $key => $email){

                if( preg_match($regex, trim( $email ))) {

                    $validEmail = true;
                }else{
                    $validEmail = false;
                    break;
                }
            }
            if( $validEmail ){
                
                $emailConfig->setCC($cc);
            }

        }else{
            if(preg_match($regex, trim($cc))) {

                $emailConfig->setCC($cc);
            }else{
                $emailConfig->setCC($cc);
            }
        }
       
        $validEmail = false;
      
        if( is_array( $bcc )){
            
            foreach( $bcc as $key => $email){

                if( preg_match($regex, trim( $email ))) {

                    $validEmail = true;
                }else{
                    $validEmail = false;
                    break;
                }
            }
            if( $validEmail ){
                
                $emailConfig->setBCC($bcc);
            }

        }else{
            if(preg_match($regex, trim($bcc))) {

                $emailConfig->setBCC($bcc);
            }
        }
      
        $emailConfig->setTo($to, $to_name);
        $emailConfig->setFrom($from_email, $from_name);
        $emailConfig->setSubject($subject);
        $emailConfig->setMessage($message);
    
        if (!empty($file)) {

            foreach ( $file as $filePath ) {

                if (file_exists($filePath)) {

                    $emailConfig->attach($filePath);
                }    
            }
        }
        $result = $emailConfig->send();
        $emailConfig->clear(TRUE);

        return $result;
    }




}