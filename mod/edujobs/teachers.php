<?php
/**
 * Elgg membersmap helper functions
 *
 * @package MembersMap
 */

// Get engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
elgg_load_library('elgg:edujobs');

admin_gatekeeper();

$options = array('type' => 'user', 'full_view' => false, 'limit' => 0);
$users = elgg_get_entities($options);

//if ($users)  {
	//echo '<h4>Total Users: '.count($users).'</h4>';
//}

echo '<table>';
echo '<tr><th style="width:30px;">No</th><th style="width:200px;">Username</th><th style="width:200px;">Name</th><th style="width:300px;">Email</th><th style="width:100px;">CV</th></tr>';
$i=0;

foreach ($users as $u)  {
	if ($u->custom_profile_type == DOCENTE_PROFILE_TYPE_GUID)	{
		$link = elgg_view('output/url', array(
			'href' => elgg_get_site_url().'profile/'.$u->username,
			'text' => $u->username,
			'is_trusted' => true,
		));
			echo '<tr><td>'.$i.'</td>';		
			echo '<td>'.$link.'</td>';
			echo '<td>'.$u->name.'</td>';			
			if($u->email)
				echo '<td>'.$u->email.'</td>';
			else
				{	
					if ($u->School_Email)
						echo '<td>'.$u->School_Email.'</td>';
					else
						{
							if($u->contactemail)	
								echo '<td>'.$u->contactemail.'</td>';
							else
								echo '<td>N/A</td>';
						}
				}					
			
		$i=$i+1;											
		if (check_if_user_has_cv($u)) 
			echo '<td>YES</td></tr>';
		else 	
			echo '<td>NO</td></tr>';
	}
}
echo '</table>';

echo "<br />finished";
