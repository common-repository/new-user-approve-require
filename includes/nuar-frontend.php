<?php

if (!defined('ABSPATH'))
  exit;


if (!class_exists('NUAR_frontend_menu')) {

    class NUAR_frontend_menu {

        protected static $NUAR_instance;

        function my_custom_function_name($user, $password){
            global $nuar_comman;

            if (!empty($user->roles) && $user->roles['0'] == 'administrator') {

                return $user;
                
            }else{

                if (isset($user->ID) && get_user_meta($user->ID, 'approval_confirmation', true) == 'not_confirm_approve') {

                    return new WP_Error('pending_approval', $nuar_comman['nuar_pending_account_approval'] );

                }else if(isset($user->ID) && get_user_meta($user->ID, 'approval_confirmation', true) == 'denied_user'){

                     return new WP_Error('denied_approval', $nuar_comman['nuar_denied_account_approval'] );

                } else{

                    return $user;
                }
            }
        }                  
           

        function bbloomer_save_extra_register_select_field_admin( $customer_id ){


               update_user_meta( $customer_id, 'approval_confirmation', 'not_confirm_approve');

        }

        function disable_woo_auto_login( $new_customer ) {

                return false;
        }
      
        function init() {

            global $nuar_comman;

            if($nuar_comman['nuar_approve_registration'] == 'yes'){

                add_filter( 'authenticate', array($this,'my_custom_function_name'), 30, 3);
                add_action( 'woocommerce_created_customer',array($this, 'bbloomer_save_extra_register_select_field_admin') );
                add_filter( 'woocommerce_registration_auth_new_customer', array( $this, 'disable_woo_auto_login' ) );

            }

        }
        public static function NUAR_instance() {
            if (!isset(self::$NUAR_instance)) {
                self::$NUAR_instance = new self();
                self::$NUAR_instance->init();
            }
            return self::$NUAR_instance;
        }
    }
    NUAR_frontend_menu::NUAR_instance();
}