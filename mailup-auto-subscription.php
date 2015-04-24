<?php
/*

Plugin Name: MailUp Auto Subscription

Plugin URI: http://www.logicimage.it

Description: Let users subscribe to MailUp newsletter service in the same time they're registering to your site.

Author: Andrea Gherardi

Version: 1.01

Author URI: http://www.logicimage.it

*/

//INTERNAZIONALIZZAZIONE
add_action( 'plugins_loaded', 'mas_load_textdomain' );

function mas_load_textdomain() {
	load_plugin_textdomain('mas-lang', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action( 'admin_menu', 'mas_add_menu' );

//VOCE DI MENU 
function mas_add_menu() {

	$mas_page = add_menu_page( 'MailUp Auto Subscription', 'MailUp Auto Subscription', 'manage_options', 'mailup-auto-subscription', 'mas_options');
	return $mas_page;

}

//PAGINA OPZIONI
function mas_options() {
	
	//CONTROLLO I DIRITTI UTENTE
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'It looks like you do not have sufficient permissions to view this page.', 'mas-lang' ) );
	}


	//INIZIO TEMPLATE DI PAGINA
	echo '<div class="wrap">'; 
	echo '<h2>MailUp Auto Subscribtion</h2>';
	echo '<p>' . __('Register your users to MailUp in the same time they subscribe to your site.', 'mas-lang') . '<br>' .
	__('Enter the Host of your console, choose the list and if necessary the group created in MailUp, nothing else.', 'mas-lang') . '<br></p>';

	$host = get_option('mas-host');
	if($_POST['host']) {
		$host = trim($_POST['host']);
		update_option('mas-host', $host);
	}

	$list = get_option('mas-list');
	
	if($_POST['list']) {
		$list = trim($_POST['list']);
		update_option('mas-list', $list);
	}

	$group = get_option('mas-group');
	if($_POST['group']) {
		$group = trim($_POST['group']);
		update_option('mas-group', $group);
	}

	if (get_option('mas-confirm') == null) {
		add_option('mas-confirm', 'true');
	}
	$confirm = get_option('mas-confirm');

	if ($_POST['sent'] == 'true') {
		$confirm = ($_POST['confirm'] == 'true') ? 'true' : 'false';
		update_option('mas-confirm', $confirm);
	}

	if (get_option('mas-newsletter') == null) {
		add_option('mas-newsletter', 'true');
	}
	$newsletter = get_option('mas-newsletter');

	if ($_POST['sent'] == 'true') {
		$newsletter = ($_POST['newsletter'] == 'true') ? 'true' : 'false';
		update_option('mas-newsletter', $newsletter);
	}

	//AVVISO ANTISPAM NEL CASO SIANO DISATTIVATE ENTRAMBE LE OPZIONI DI CONFERMA
	if(get_option('mas-confirm') == 'false' && get_option('mas-newsletter') == 'false' ) {
		echo '<div class="error"><p><strong>' . 

		__('<strong>ATTENTION!</strong> Sending newsletter without user confirmation is considered spam.', 'idemas-lang')

		. '</p></div>';
	}

	//RICHIAMO IL FORM DI AMMINISTRAZIONE
	include(plugin_dir_path( __FILE__ ) . '/includes/mas-admin-form.php' );

	echo '</div>';

}

if (get_option('mas-newsletter') == 'true') {

	//MODIFICO IL FORM DI REGISTRAZIONE 
	include(plugin_dir_path( __FILE__ ) . '/includes/mas-register-form.php' );

}


add_action('user_register', 'mas_mailup_register');

function mas_mailup_register($user_id) { 
	
		$user_info = get_userdata($user_id);
		$mas_username = $user_info->user_login;
		$mas_mail = $user_info->user_email;

		$mas_host = get_option('mas-host');
		$mas_list = get_option('mas-list');
		$mas_group = get_option('mas-group');
		$mas_confirm = get_option('mas-confirm');

	//SE ATIVATA L'OPZIONE NEL FORM DI REGISTRAZIONE
	if (get_option('mas-newsletter') == 'true') {

		$mas_user_newsletter = ($_POST['user-newsletter'] == 'true') ? 'true' : 'false';

		if ($mas_user_newsletter != 'false') {
		
			$url = "http://$mas_host/frontend/xmlSubscribe.aspx?list=$mas_list&group=$mas_group&email=$mas_mail&confirm=$mas_confirm&csvFldNames=campo1&csvFldValues=$mas_username";
		    
			wp_remote_post($url);

		}

	} else {

		$url = "http://$mas_host/frontend/xmlSubscribe.aspx?list=$mas_list&group=$mas_group&email=$mas_mail&confirm=$mas_confirm&csvFldNames=campo1&csvFldValues=$mas_username";
		    
		wp_remote_post($url);

	}
	
}
