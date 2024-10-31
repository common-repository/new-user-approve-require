<?php

if (!defined('ABSPATH'))
  exit;

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if (!class_exists('NUAR_admin_menu')) {

    class NUAR_admin_menu {

        protected static $NUAR_instance;

        function nuar_submenu_page() {
            
            add_menu_page('User Approve Require','User Approve Require','manage_options','new-user-approve-require',array($this, 'nuar_callback'),'dashicons-businessman');
            add_submenu_page( 'new-user-approve-require', __( 'Pending Users', 'new-user-approve-require' ),'Pending Users','manage_options','panding-new-users',array($this, 'nuar_callback_panding'));
            add_submenu_page( 'new-user-approve-require', __( 'Approved Users', 'new-user-approve-require' ),'Approved Users','manage_options','approve-new-users',array($this, 'nuar_callback_approvel'));
            add_submenu_page( 'new-user-approve-require', __( 'Denied Users', 'new-user-approve-require' ),'Denied Users','manage_options','denied-new-users',array($this, 'nuar_callback_denied'));
        }

        function nuar_callback() {
        	global $nuar_comman;	                           		
        	?>
        	<div class="nuar-container">
	            <form method="post">
	            	<div class="wrap">
	                	<h2><?php echo __('General Control Setting','new-user-approve-require');?></h2>        		
	            	</div>
                    <table class="data_table">
                        <tbody>
                            <tr>
                                <th>
                                	<label><?php echo __('Manually Approve New Registration','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="checkbox" name="nuar_comman[nuar_approve_registration]" value="yes"<?php if($nuar_comman['nuar_approve_registration'] == 'yes'){echo "checked";}?>>
                                	<p class="discription"><?php echo __('Enable manual approval of new users registration.','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Message For Pending Account For Approval','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="text" class="regular-text" name="nuar_comman[nuar_pending_account_approval]" value="<?php echo $nuar_comman['nuar_pending_account_approval'];?>">
                                	<p class="discription"><?php echo __('Message for users when account is pending for approval.','new-user-approve-require');?></p>
                                </td>
                            </tr>
                             <tr>
                                <th>
                                    <label><?php echo __('Message For Denied Account For Approval','new-user-approve-require');?></label>
                                </th>
                                <td>
                                    <input type="text" class="regular-text" name="nuar_comman[nuar_denied_account_approval]" value="<?php echo $nuar_comman['nuar_denied_account_approval'];?>">
                                    <p class="discription"><?php echo __('Message for users when account is Denied for approval.','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Disable Email','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="checkbox" name="nuar_comman[nuar_account_disale_email]" value="yes"<?php if($nuar_comman['nuar_account_disale_email'] == 'yes'){echo "checked";}?>>
                                	<p class="discription"><?php echo __('Notify users will by an E-mail when their registration is rejected.','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Reject Email Subject','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="text" class="regular-text" name="nuar_comman[nuar_reject_email_subject]" value="<?php echo $nuar_comman['nuar_reject_email_subject'];?>">
                                	<p class="discription"><?php echo __('Account reject email subject','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Reject Email message','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<textarea rows="5" class="regular-text" cols="30" name="nuar_comman[nuar_reject_email_message]"><?php echo $nuar_comman['nuar_reject_email_message'];?></textarea>
                                	<p class="discription"><?php echo __('Account reject email message','-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Approve Email','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="checkbox" name="nuar_comman[nuar_account_approve_email]" value="yes"<?php if($nuar_comman['nuar_account_approve_email'] == 'yes'){echo "checked";}?>>
                                	<p class="discription"><?php echo __('Notify users will by an E-mail when their registration is approved.','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Approve Email Subject','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<input type="text" class="regular-text" name="nuar_comman[nuar_approve_email_subject]" value="<?php echo $nuar_comman['nuar_approve_email_subject'];?>">
                                	<p class="discription"><?php echo __('Account approve email subject','new-user-approve-require');?></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                	<label><?php echo __('Account Approve Email message','new-user-approve-require');?></label>
                                </th>
                                <td>
                                	<textarea rows="5" class="regular-text" cols="30" name="nuar_comman[nuar_approve_email_message]"><?php echo $nuar_comman['nuar_approve_email_message'];?></textarea>
                                	<p class="discription"><?php echo __('Account approve email message','new-user-approve-require');?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
	                <div class="submit_button">
	                    <input type="hidden" name="nuar_private_site" value="nuar_save_option">
	                    <input type="submit" value="Save changes" name="submit" class="button-primary" id="nuar-btn-space">
	                </div>              
	            </form>  
	        </div>
        <?php
        }

        function custom_user_profile_fields($user){
        	?>
        	<table class="form-table">
            	<tr>
                	<th><label><?php echo __('Approval confirmation','new-user-approve-require');?></label></th>
                	<td>
                    	<select name="approval_confirmation">
                      		<option value="confirm_approve"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'confirm_approve'){echo "selected";}?>>Approve Confirm</option>
	                      	<option value="denied_user"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'denied_user'){echo "selected";}?>>Denied Users</option>
                      		<option value="not_confirm_approve"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'not_confirm_approve'){echo "selected";}?>>Approve Not Confirm</option>
                    	</select>
                	</td>
            	</tr>
        	</table>
        	<?php
        }

        function save_custom_user_profile_fields($user_id){
            if(!current_user_can('manage_options')){
              	return false;
            }
            update_user_meta( $user_id, 'approval_confirmation', sanitize_text_field($_POST['approval_confirmation']) );
        }


        function NUAR_recursive_sanitize_text_field( $array ) {
            foreach ( $array as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->NUAR_recursive_sanitize_text_field($value);
                }else{
                    $value = NUAR_recursive_sanitize_text_field( $value );
                }
            }
            return $array;
        }
        
        function nuar_callback_panding( ){
            ?>
            <div class="nuar-container">
                <div class="wrap">
                    <h2>User Registration Approval</h2>                  
                </div>  
                <?php       
                $exampleListTable = new NUAR_panding_List_Table1();
                $exampleListTable->prepare_items();                  
                ?>
                <form  method="post" class="nuar_list_users">
                    <?php
                        $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
                        $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );

                        printf( '<input type="hidden" name="page" value="%s" />', $page );
                        printf( '<input type="hidden" name="paged" value="%d" />', $paged ); 
                    ?>
                    <?php $exampleListTable->display(); ?>
                </form>
            </div>
            <?php
        }  

        function nuar_callback_approvel(){
            ?>
            <div class="nuar-container">
                <div class="wrap">
                  <h2>Approved Users</h2>                  
                </div>
                <?php 
                $exampleListTable = new NUAR_Approve_List_Table1();
                $exampleListTable->prepare_items();                  
                ?>

                <form  method="post" class="nuar_list_users">
                    <?php
                        $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
                        $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );

                        printf( '<input type="hidden" name="page" value="%s" />', $page );
                        printf( '<input type="hidden" name="paged" value="%d" />', $paged ); 
                    ?>
                    <?php $exampleListTable->display(); ?>
                </form>
            </div>
            <?php 
        }

        function nuar_callback_denied(){         
            ?>
            <div class="nuar-container">
                <div class="wrap">
                  <h2>Denied Users</h2>                  
                </div>
                <?php 
                $exampleListTable = new NUAR_denied_List_Table1();
                $exampleListTable->prepare_items();                  
                ?>

                <form  method="post" class="nuar_list_users">
                    <?php
                        $page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
                        $paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );

                        printf( '<input type="hidden" name="page" value="%s" />', $page );
                        printf( '<input type="hidden" name="paged" value="%d" />', $paged ); 
                    ?>
                    <?php $exampleListTable->display(); ?>
                </form>
            </div>
            <?php
        }

        function nuar_save_option() {

            global $nuar_comman;
            global $woocommerce;

	        if( current_user_can('administrator') ) { 

	            if(isset($_REQUEST['nuar_private_site']) && $_REQUEST['nuar_private_site'] == 'nuar_save_option'){
                    // echo "<pre>";
                    // print_R($_REQUEST["nuar_pending_account_approval"]);
                    // echo "</pre>";
                    // exit;

                    $isecheckbox = array(

                        'nuar_approve_registration',
                        'nuar_account_disale_email',
                        'nuar_account_approve_email'

                    );

                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
                        if(!isset($_REQUEST['nuar_comman'][$value_isecheckbox])){
                           $_REQUEST['nuar_comman'][$value_isecheckbox] =sanitize_text_field('no');
                        }
                    }                  

                    foreach ($_REQUEST['nuar_comman'] as $key_nuar_comman => $value_nuar_comman) {
                        update_option($key_nuar_comman, $value_nuar_comman, 'yes');
                    }                   
	                wp_redirect( admin_url( '/admin.php?page=new-user-approve-require' ) );
	                exit;     
	            }
	        }

            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'panding_to_approve'){

                $user_detail = get_userdata(sanitize_text_field($_REQUEST['user']));
                $admin_email = get_option( 'admin_email' );

                $name = $user_detail->display_name;
                $email = $admin_email;
                $message = $nuar_comman['nuar_approve_email_message'];

                $to = $user_detail->user_email;
                $subject = $nuar_comman['nuar_approve_email_subject'];
                $headers = 'welcome message';

                if ($nuar_comman['nuar_account_approve_email'] == 'yes') {

                    wp_mail($to, $subject, $message, $headers);

                }
                
                update_user_meta( sanitize_text_field($_REQUEST['user']), 'approval_confirmation', 'confirm_approve');
                wp_redirect(admin_url('/admin.php?page=panding-new-users'));
                exit();
            }

            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'denied_to_approve'){

                $user_detail = get_userdata(sanitize_text_field($_REQUEST['user']));
                $admin_email = get_option( 'admin_email' );


                $name = $user_detail->display_name;
                $email = $admin_email;
                $message = $nuar_comman['nuar_approve_email_message'];

                $to = $user_detail->user_email;
                $subject = $nuar_comman['nuar_approve_email_subject'];
                $headers = 'welcome message';

                if ($nuar_comman['nuar_account_approve_email'] == 'yes') {
                  wp_mail($to, $subject, $message, $headers);
                }
                
                update_user_meta( sanitize_text_field($_REQUEST['user']), 'approval_confirmation', 'confirm_approve');
                wp_redirect(admin_url('/admin.php?page=denied-new-users'));
                exit();
            }

            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'approve_to_denied'){

                $user_detail = get_userdata(sanitize_text_field($_REQUEST['user']));
                $admin_email = get_option( 'admin_email' );

                $name = $user_detail->display_name;
                $email = $admin_email;
                $message = $nuar_comman['nuar_reject_email_message'];

                $to = $user_detail->user_email;
                $subject = $nuar_comman['nuar_reject_email_subject'];
                $headers = 'reject message';

                if ($nuar_comman['nuar_account_disale_email'] == 'yes') {
                  wp_mail($to, $subject, $message, $headers);
                }   

                update_user_meta( sanitize_text_field($_REQUEST['user']), 'approval_confirmation', 'denied_user');
                wp_redirect(admin_url('/admin.php?page=approve-new-users'));
                exit();
            }

            if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'panding_to_denied'){

                $user_detail = get_userdata(sanitize_text_field($_REQUEST['user']));
                $admin_email = get_option( 'admin_email' );

                $name = $user_detail->display_name;
                $email = $admin_email;
                $message = $nuar_comman['nuar_reject_email_message'];

                $to = $user_detail->user_email;
                $subject = $nuar_comman['nuar_reject_email_subject'];
                $headers = 'reject message';

                if ($nuar_comman['nuar_account_disale_email'] == 'yes') {
                  wp_mail($to, $subject, $message, $headers);
                }

                update_user_meta(sanitize_text_field($_REQUEST['user']), 'approval_confirmation', 'denied_user');
                wp_redirect(admin_url('/admin.php?page=panding-new-users'));
                exit();
            }
	    }

        function init() {
        	global $nuar_comman;
            add_action( 'admin_menu',  array($this, 'nuar_submenu_page'));
            add_action( 'init',  array($this, 'nuar_save_option'));
            add_action( 'show_user_profile', array($this,'custom_user_profile_fields') );
            add_action( 'edit_user_profile', array($this,'custom_user_profile_fields') );
            add_action( 'user_new_form', array($this,'custom_user_profile_fields') );
            add_action( 'user_register', array($this,'save_custom_user_profile_fields') );
            add_action( 'profile_update', array($this,'save_custom_user_profile_fields') );
        }

        public static function NUAR_instance() {
            if (!isset(self::$NUAR_instance)) {
                self::$NUAR_instance = new self();
                self::$NUAR_instance->init();
            }
            return self::$NUAR_instance;
        }
    }
    NUAR_admin_menu::NUAR_instance();
}

class NUAR_panding_List_Table1 extends WP_List_Table {
    public function __construct() {
        parent::__construct(
            array(
                'singular' => 'singular_form',
                'plural'   => 'plural_form',
                'ajax'     => false
            )
        );
    }

    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $data = $this->table_data();

        $perPage = 10;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );
        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
        $this->process_bulk_action();
    }

    public function get_columns() {
        $columns = array(
            'id'     => 'ID',
            'title'  => 'Users Name',
            'email'  => 'E-mail',
            'role'   => 'User Role',
            'action' => 'Action',
        );
        return $columns;
    }

    public function get_hidden_columns() {
        return array();
    }

    public function get_sortable_columns() {
        return array('id' => array('id', false));
    }

    private function table_data() {
        $data = array();
        $q = new WP_User_Query( 
            array(
                'orderby'  => 'ID',
                'wp_user'    => array(
                    'relation'  => 'AND',                 
                )
            ) 
        );
        $user_query = $q->results;

        foreach ($user_query as $value) {
            $user_info = get_user_meta($value->ID);
            if(!empty($user_info['approval_confirmation'])){
                $status = $user_info['approval_confirmation']['0'];
            }
            if(!empty($value->roles)){
                    $rolese= $value->roles['0'];
            }else{
                 $rolese="";
            }
            $user_status = $status;
            if($user_status == 'not_confirm_approve'){
                $data[] = array(
                    'id'    => $value->ID,
                    'title' =>  get_avatar($value->user_email).'<a href='. get_edit_user_link( $value->ID ).'>'.$value->display_name.'</a>',
                    'email' => '<a href=mailto:'. $value->user_email.'>'. $value->user_email.'</a>' ,
                    'role' => $rolese,
                    'action'=>'action',          
                );
            }
        }
        return $data;
    }

    public function column_default( $item, $column_name ) {
        $approve_link =  get_option( 'siteurl' ) . '?action=panding_to_approve&user=' . $item['id'] ;
        $denied_link =  get_option( 'siteurl' ) . '?action=panding_to_denied&user=' . $item['id'] ;
        switch( $column_name ) {
            case 'id':
                return $item['id'];
            case 'title':
                return $item['title'];
            case 'email':
                return $item['email'];
            case 'role':
                return $item['role'];
            case 'action':                
                return '<a class="button" href="'.$approve_link.'">Approve</a>&nbsp&nbsp<a class="button" href="'.$denied_link.'">Deny</a>';    
            default:
                return print_r( $item, true ) ;
        }
    }

    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );    
    }
}

class NUAR_Approve_List_Table1 extends WP_List_Table {
    public function __construct() {
        parent::__construct(
            array(
                'singular' => 'singular_form',
                'plural'   => 'plural_form',
                'ajax'     => false
            )
        );
    }

    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $data = $this->table_data();

        $perPage = 15;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );
        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
        $this->process_bulk_action();
    }

    public function get_columns() {
        $columns = array(
            'id'     => 'ID',
            'title'  => 'Users Name',
            'email'  => 'E-mail',
            'role'   => 'User Role',
            'action' => 'Action',
        );
        return $columns;
    }

    public function get_hidden_columns() {
        return array();
    }

    public function get_sortable_columns() {
        return array('id' => array('id', false));
    }

    private function table_data() {
        $data = array();
        $q = new WP_User_Query( 
            array(
                'orderby'  => 'ID',
                'wp_user'    => array(
                    'relation'  => 'AND',
                )
            ) 
        );
        $user_query = $q->results;

        foreach ($user_query as $value) {
          
            
            $user_info = get_user_meta($value->ID);
            if(!empty($user_info['approval_confirmation'])){
                $status = $user_info['approval_confirmation']['0'];
            }
            $user_status = $status;
            if($user_status == 'confirm_approve'){
                if(!empty($value->roles)){
                    $rolese= $value->roles['0'];
                }else{
                     $rolese="";
                }
                $data[] = array(
                    'id'    => $value->ID,
                    'title' =>  get_avatar($value->user_email).'<a href='. get_edit_user_link( $value->ID ).'>'.$value->display_name.'</a>',
                    'email' => '<a href=mailto:'. $value->user_email.'>'. $value->user_email.'</a>' ,
                    'role' =>  $rolese,
                    'action'=>'action',          
                );
            }
        }
    
        return $data;
    }
   

    public function column_default( $item, $column_name ) {
        $denied_link =  get_option( 'siteurl' ) . '?action=approve_to_denied&user=' . $item['id'] ;
        switch( $column_name ) {
            case 'id':
                return $item['id'];
            case 'title':
                return $item['title'];
            case 'email':
                return $item['email'];
            case 'role':
                return $item['role'];            
            case 'action':
                $user = new WP_User( $item['id'] ); 

                if(!empty($user->roles)){          
                    if($user->roles['0'] == 'administrator'){     
                        return false;
                    } 
                }   
                return '<a class="button" href="'.$denied_link.'">Deny</a>';
            default:
                return print_r( $item, true );
        }
    }

    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );    
    }
}

class NUAR_denied_List_Table1 extends WP_List_Table {
    public function __construct() {
        parent::__construct(
            array(
                'singular' => 'singular_form',
                'plural'   => 'plural_form',
                'ajax'     => false
            )
        );
    }

    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $data = $this->table_data();
        //usort( $data, array( &$this, 'sort_data' ) );
        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );
        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
        $this->process_bulk_action();
    }

    public function get_columns() {
        $columns = array(
            'id'     => 'ID',
            'title'  => 'Users Name',
            'email'  => 'E-mail',
            'role'   => 'User Role',
            'action' => 'Action', 
        );
        return $columns;
    }

    public function get_hidden_columns() {
        return array();
    }

    public function get_sortable_columns() {
        return array('id' => array('id', false));
    }

    private function table_data() {
        $data = array();
        $q = new WP_User_Query( 
            array(
                'orderby'  => 'ID',
                'wp_user'    => array(
                    'relation'  => 'AND',
                )
            ) 
        );
        $user_query = $q->results;

        foreach ($user_query as $value) {
            $user_info = get_user_meta($value->ID);
            if(!empty($user_info['approval_confirmation'])){
                $status = $user_info['approval_confirmation']['0'];
            }
            if(!empty($value->roles)){
                    $rolese= $value->roles['0'];
            }else{
                 $rolese="";
            }
            $user_status = $status;  
            if($user_status == 'denied_user'){
                $data[] = array(
                    'id'    => $value->ID,
                    'title' =>  get_avatar($value->user_email).'<a href='. get_edit_user_link( $value->ID ).'>'.$value->display_name.'</a>',
                    'email' => '<a href=mailto:'. $value->user_email.'>'. $value->user_email.'</a>' ,
                    'role' => $rolese,
                    'action'=>'action',          
                );
            }
        }
        return $data;
    }

    public function column_default( $item, $column_name ) {
        $approve_link =  get_option( 'siteurl' ) . '?action=denied_to_approve&user=' . $item['id'] ;
        switch( $column_name ) {
            case 'id':
                return $item['id'];
            case 'title':
                return $item['title'];
            case 'email':
                return $item['email'];
            case 'role':
                return $item['role'];
            case 'action':                
                return '<a class="button" href="'.$approve_link.'">Approve</a>';    
            default:
                return print_r( $item, true ) ;
        }
    }

    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );    
    }
}


?>