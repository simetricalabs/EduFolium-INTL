<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');

if (elgg_is_sticky_form('register')) {
	extract(elgg_get_sticky_values('register'));
	elgg_clear_sticky_form('register');
}

// must accept terms
if($accept_terms = elgg_get_plugin_setting("registration_terms", "profile_manager")){
	$link_begin = "<a target='_blank' href='" . $accept_terms . "'>";
	$link_end = "</a>";
	$terms = "<div class='mandatory'>";
}

echo "<div id='profile_manager_register_left'>";
					'id' => 'register-name',
				));
			<div class="mandatory">
			</div>
			<div class="mandatory">
				<div class='profile_manager_register_input_container'>
					<?php
					echo elgg_view('input/text', array(
					?>
			</div>
			<div class="mandatory">
						'id' => 'register-password',
					?>
					<span class='elgg-icon profile_manager_validate_icon'></span>
				</div>
			</div>
			<div class="mandatory">
					));
					?>
					<span class='elgg-icon profile_manager_validate_icon'></span>
				</div>
			</div>
			<?php 
<?php
// view to extend to add more fields to the registration form
echo elgg_view('register/extend');
// Add captcha hook
echo elgg_view('input/captcha');

echo "</div>";



//echo "<div class='clearfloat'></div>";
echo "<div class='elgg-foot'>";
echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('Registrarse')));

echo "</div>";
		$('[name="custom_profile_fields_website"]').attr("placeholder","Perfil LinkedIn  ");
		