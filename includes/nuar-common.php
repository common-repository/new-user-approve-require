<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('NUAR_comman')) {

    class nUAR_comman {

        protected static $instance;

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
             return self::$instance;
        }

        function init() {
            global $nuar_comman;
            $optionget = array(              
                'nuar_approve_registration' => 'yes',
                'nuar_pending_account_approval' =>'your account is not active please, wait for admin approval...!',
                'nuar_account_disale_email' => 'yes',
                'nuar_reject_email_subject' => 'Rejected Your Account..',
                'nuar_reject_email_message' => 'hiii, your accound has been disable.',
                'nuar_approve_email_subject' => 'Approve Your Account..',
                'nuar_approve_email_message' => 'Yeah !, your account has been approve. welcome to our site..!',
                'nuar_account_approve_email' => 'yes',
                'nuar_denied_account_approval'=>'OOPS !!!! Rejected Your Account ..Please try again other Email'
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {

               $nuar_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );

            }
        }
    }
    NUAR_comman::instance();
}
?>