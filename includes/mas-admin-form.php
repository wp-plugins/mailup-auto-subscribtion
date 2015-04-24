<?php //INIZIO FORM DI AMMINISTRAZIONE

	echo '<form name="host" id="host" method="post" action="">';
	echo '<table class="form-table"><tbody>';

	echo '<tr>';
	echo '<th scope="row"><label>' . __('Endpoint/ Console url', 'mas-lang') . '</label></th>';
	echo '<td>';
	echo '<input type="text" name="host" id="host" value="' . $host . '">';
	echo '<p class="description">' . __('Do you need help? Click <a href="http://help.mailup.com/display/mailupapi/MailUp+API+Credentials" target="_blank">here</a>', 'mas-lang') . '</p>';
	echo '</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<th scope="row"><label>' . __('MailUp List ID', 'mas-lang') . '</label></th>';
	echo '<td>';
	echo '<input type="text" name="list" id="list" value="' . $list . '">';
	echo '<p class="description">' . __('Enter the ID of the list which you want to register your users.', 'mas-lang') . '</strong></p>';
	echo '</td>';
	echo '</tr>';

	echo '<tr>';	
	echo '<th scope="row"><label>' . __('MailUp Group ID', 'mas-lang') . '</label></th>';
	echo '<td>';
	echo '<input type="text" name="group" id="group" value="' . $group . '">';
	echo '<p class="description">' . __('If you want to add users to a specific MailUp group, enter here the correct ID.', 'mas-lang') . '</strong></p>';
	echo '</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<th scope="row"><label>' . __('Confirm', 'mas-lang') . '</label></th>';
	echo '<td><fieldset>';
	echo '<label>';
	echo '<input type="hidden" name="sent" id="sent" value="true">';
	echo '<input type="checkbox" name="confirm" id="confirm" value="true"';

	if($confirm == 'true') { 
		echo 'checked="checked"';
	}

	echo '>';
	echo __('Send MailUp register confirmation', 'mas-lang') . '</label>';

	echo '</fieldset></td>';
	echo '</tr>';


	echo '<tr>';
	echo '<th scope="row"><label>' . __('Registration form', 'mas-lang') . '</label></th>';
	echo '<td><fieldset>';
	echo '<label>';
	echo '<input type="hidden" name="sent" id="sent" value="true">';
	echo '<input type="checkbox" name="newsletter" id="newsletter" value="true"';

	if($newsletter == 'true') { 
		echo 'checked="checked"';
	}

	echo '>';
	echo __('Newsletter option in the registration form', 'mas-lang') . '</label>';

	echo '</fieldset></td>';
	echo '</tr>';

	echo '</table>';
	echo '</tbody>';

	echo '<p class="submit"><input class="button button-primary" type="submit" value="' . __('Save changes', 'mas-lang') . '"></p>';

	echo '</form>';