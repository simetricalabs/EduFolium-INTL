<?php

	/**
	* Shows the latests edu jobs in the Digest
	*
	*/
	
	$ts_lower = (int) elgg_extract("ts_lower", $vars);
	$ts_upper = (int) elgg_extract("ts_upper", $vars);
	$totaljobs = 10;	// total jobs to display

	// only show jobs that are published
	$dbprefix = elgg_get_config("dbprefix");
	
	$job_status_name_id = add_metastring("status");
	$job_published_value_id = add_metastring("published");
	
	$job_options = array(
		'type' => 'object', 
		'subtype' => 'edujobs', 
		'limit' => 10, 
		'created_time_lower' => $ts_lower,
		'created_time_upper' => $ts_upper,		
	);	

	$title = '<h1>'.elgg_echo('edujobs:digest:intro1').'</h1>';
	$subtitle = '<p>'.elgg_echo('edujobs:digest:intro2').'</p>';
	
	// get no of jobs by country
	$argentina = count_ext_jobs_by_country('Argentina');
	$mexico = count_ext_jobs_by_country('Mexico');
	$chile = count_ext_jobs_by_country('Chile');
	$peru = count_ext_jobs_by_country('Peru');
	$colombia = count_ext_jobs_by_country('Colombia');
	$venezuela = count_ext_jobs_by_country('Venezuela');
	
	$link_argentina = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Argentina',
		'text' => 'Argentina: '.$argentina,
	));	
	
	$link_mexico = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Mexico',
		'text' => 'Mexico: '.$mexico,
	));	
	
	$link_chile = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Chile',
		'text' => 'Chile: '.$chile,
	));	
	
	$link_peru = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Peru',
		'text' => 'Peru: '.$peru,
	));	
	
	$link_colombia = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Colombia',
		'text' => 'Colombia: '.$colombia,
	));	
	
	$link_venezuela = elgg_view('output/url', array(
		'href' => 'http://edufolium.com/intl/edujobs/teachers/extjobs?searchformsubmitted=1&country=Venezuela',
		'text' => 'Venezuela: '.$venezuela,
	));		
	
	$jobsbycountry =  '
		<div id="countries">
		<div class="left">'.$link_argentina.'</div>
		<div class="right">'.$link_mexico.'</div>
		<div class="left">'.$link_chile.'</div>
		<div class="right">'.$link_peru.'</div>
		<div class="left">'.$link_colombia.'</div>
		<div class="right">'.$link_venezuela.'</div>
		</div>'
	;
	echo elgg_view_module("digest", '', $title.$subtitle.$jobsbycountry);
	
	
	if($jobs = elgg_get_entities($job_options)){
		$title = elgg_view("output/url", array("text" => elgg_echo("edujobs"), "href" => "edujobs/jobs" ));
		
		$latest_jobs = "";
		
		$i=0;
		foreach($jobs as $job){
			$i++;
			$job_url = $job->getURL();
			
			//get location
			$location = '';
			$flag = get_country_flag($job->country);
			if ($job->city) $location .= $job->city;
			if ($job->country) $location .= ', ' . $job->country;
			if ($flag) $location .= '&nbsp;<img src="'.elgg_get_site_url().'mod/edujobs/assets/flags/'.$flag.'" width="20" height="12" alt="'.$job->country.'" />';

			$latest_jobs .= "<div class='digest-job'>";
			if($job->icontime){
				$latest_jobs .= "<a href='" . $job_url. "'><img src='". $job->getIconURL("medium") . "' /></a>";
			}
			$latest_jobs .= "<span>";
			$latest_jobs .= "<h4><a href='" . $job_url. "'>" . $job->title . "</a></h4>";
			$latest_jobs .= elgg_get_excerpt($job->description);
			$latest_jobs .= '<br />';
			if ($location) $latest_jobs .= $location . ' | ';
			$latest_jobs .= elgg_echo('edujobs:view:job:date') . date(DATE_FORMAT, $job->time_created);
			$latest_jobs .= "</span>";
			$latest_jobs .= "</div>";
		}
		
		echo elgg_view_module("digest", $title, $latest_jobs);
	}
	
	if($i<$totaljobs)	{	// show external jobs only if internal jobs are less than 10
	
		$count = $totaljobs - $i;
		$job_ext_options = array(
			'type' => 'object', 
			'subtype' => 'edujobsext', 
			'limit' => $count, 
			'created_time_lower' => $ts_lower,
			'created_time_upper' => $ts_upper,		
		);	
		
		$search_options = array();
		$user = elgg_extract("user", $vars);
		$country = $user->country;
		if ($country) {
			$country_frm = array('name' => 'country','value' => $country, 'operand' => '=');
			array_push($search_options,$country_frm);
		}	
		
		if($search_options){  // in case of sidebar form submitted
			$job_ext_options['metadata_name_value_pairs'] = $search_options;
			$job_ext_options['metadata_name_value_pairs_operator'] = 'AND';
			$jobs = elgg_get_entities_from_metadata($job_ext_options);
		}
		else {
			$jobs = elgg_get_entities($job_ext_options);
		}	
		
		if($jobs){
			$title = elgg_view("output/url", array("text" => elgg_echo("jobsext"), "href" => "edujobs/teachers/extjobs" ));
			
			$latest_jobs = "";
			
			foreach($jobs as $job){
				$job_url = $job->getURL();
				
				//get location
				$location = '';
				$flag = get_country_flag($job->country);
				if ($job->location) $location .= $job->location;
				if ($job->country) $location .= ', ' . $job->country;
				if ($flag) $location .= '&nbsp;<img src="'.elgg_get_site_url().'mod/edujobs/assets/flags/'.$flag.'" width="20" height="12" alt="'.$job->country.'" />';

				$latest_jobs .= "<div class='digest-job'>";
				if($job->icontime){
					$latest_jobs .= "<a href='" . $job_url. "'><img src='". $job->getIconURL("medium") . "' /></a>";
				}
				$latest_jobs .= "<span>";
				$latest_jobs .= "<h4><a href='" . $job_url. "'>" . $job->title . "</a></h4>";
				$latest_jobs .= elgg_get_excerpt($job->description);
				$latest_jobs .= '<br />';
				if ($location) $latest_jobs .= $location . ' | ';
				$latest_jobs .= elgg_echo('edujobs:view:job:date') . date(DATE_FORMAT, $job->time_created);
				$latest_jobs .= "</span>";
				$latest_jobs .= "</div>";
			}
			
			echo elgg_view_module("digest", $title, $latest_jobs);
		}	
		
	}
	
