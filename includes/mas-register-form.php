<?php //extra field login form

add_action('register_form','mas_add_field');

function mas_add_field() {

    $output = '<p style="margin-bottom:10px;">';
	$output .= '<label style="text-align: left;">';
	$output .= '<input style="margin-top: 0;" type="checkbox" name="user-newsletter" id="user-newsletter" value="true" checked="checked"/>';
	$output .= __('Newsletter subscriptions', 'mas-lang');
	$output .= '</label>';
	$output .= '</p>';

	echo $output;
  
}