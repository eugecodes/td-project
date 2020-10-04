<?php

	$timeframePage->setQueries(array( 'page' => 'wpvf_mode_website',
									  'tab' => 'referrers') );								   

	// Print Timeframe Menu
	$timeframePage->printTimeframeMenu( $WP_VisitorFlow->get_setting('db-startdatetime') );

	if ($WP_VisitorFlow->get_user_setting('datetimestart') !=  $timeframePage->getTimeframeStart() ) {
		$WP_VisitorFlow->set_user_setting('datetimestart', $timeframePage->getTimeframeStart(), 0);
	}
	if ($WP_VisitorFlow->get_user_setting('datetimestop')  !=  $timeframePage->getTimeframeStop() ) {
		$WP_VisitorFlow->set_user_setting('datetimestop',  $timeframePage->getTimeframeStop(), 0);
	}
	$datetimestart = $timeframePage->getTimeframeStart();
	$datetimestop = $timeframePage->getTimeframeStop();
	
	// Print Tab Menu
	$timeframePage->printTabsMenu();
	
?>
	<div style="clear:both;"></div>
	<br />
<?php
	
	// Get existing pages
	$page_title = array();
	$results = $db->get_results("SELECT id, f_post_id, title FROM $pages_table WHERE f_post_id='0';");
	foreach ($results as $result) {
		$page_title[$result->id] = $result->title;
	}
	
	$searchengine_shares = array();
	// Get the array with search enegine information
	$searchengines = $WP_VisitorFlow->get_SearchEngines();
	
	// Get aggregated data					
	$sql = $db->prepare("SELECT SUM($aggregation_table.value) AS hits,
							$aggregation_table.type AS type
						 FROM $aggregation_table
						 WHERE type LIKE '%s' AND date>='%s' AND date<='%s'
						 GROUP BY type
						 ORDER BY hits DESC;",
						 'refer%', $datetimestart, $datetimestop
						);

	$results = $db->get_results( $sql );

	$count = 1;
	$max_plot_count = 15;
	$top_pages = array();
	$table_html = '';
	foreach ($results as $res) {

		list ($foo, $page_id) = explode('-', $res->type);
		if (isset($page_title[$page_id]) && $page_title[$page_id] != 'self' && $page_title[$page_id] != 'unknown') {
			
			$title = $page_title[$page_id];
			
			foreach ( $searchengines as $se_label => $engineinfo ) {
			
				// Check if url contains the SE pattern
				foreach ( $engineinfo['searchpattern'] as $pattern ) {
					$pattern = str_replace("\.", "\\.", $pattern);
					if ( preg_match('/' . $pattern . '/',  strtolower($title) ) ) {
						if (! array_key_exists($engineinfo['label'], $searchengine_shares)) {
							$searchengine_shares[$engineinfo['label']] = 0;
						}
						$searchengine_shares[$engineinfo['label']] +=  $res->hits;
					}
				}

			}
		
			if ($title && $page_id != 'all' && $count <= $hit_count ) {
			
				if ($count <= $max_plot_count) {
					array_push($top_pages, array('title' => $title,
												   'id' => $page_id) );
				}	
					
				if ($count % 2 != 0) {
					$table_html .= '<tr>';
				}
				else {
					$table_html .= '<tr class="darker">';
				}
				$count++;			
				
				$page_label = $page_title[$page_id];
				if (strlen($page_label) > 60) {
					$page_label = substr($page_label, 0, 60) . '[...]';
				}
				$table_html .= '<td>' . $res->hits . '</td>';
				$table_html .= '<td><a class="wpvf wpvfextern" href="'. $page_title[$page_id] . '" title="' . $page_title[$page_id] . '">'  . $page_label . '</a></td>';
				$table_html .= '<td><a class="wpvf wpvfflow" href="?page=wpvf_mode_singlepage&amp;select_page_id=' .  $page_id . '">' . __('Flow', 'wp_visitorflow') . '</a></td>';
				$table_html .= '</tr>'; 
			}
		}
	}
	
	if (count($top_pages) == 0) {
?>		
		<div class="wpvf_warning">
			<p><?php echo __('No data found in the selected timeframe.', 'wp_visitorflow'); ?></p>
		</div><br />
<?php
		return;
	}

	// Draw Referrer Timeline Diagram

	$chart_data = array();
	
	//Get data of today (if necessary):
	$today = $WP_VisitorFlow->get_datetime('Y-m-d');
	$todays_data = array();
	if ($datetimestop == $today) {
		$todays_data = $WP_VisitorFlow->get_data( $today );
	}

	// Add total views to chart data
	$total_referrer_data = array();
	$results = $db->get_results($db->prepare("SELECT date, value AS count 
											  FROM $aggregation_table 
											  WHERE type='visits'
											    AND date>='%s' AND date<='%s'
											  ORDER BY date ASC;",
											 $datetimestart, $datetimestop)
								);
	foreach ($results as $res) {
		$total_referrer_data[$res->date] = $res->count;
	}
	if ( isset($todays_data['visits']) ) {
		$total_referrer_data[$today] = $todays_data['visits'];
	}
	array_push($chart_data, array('label' => __('Sum of all referrer pages', 'wp_visitorflow'),
								  'data' => $total_referrer_data) );

	// Add top 10 referrer pages to chart data
	foreach ($top_pages as $page) {
		$results = $db->get_results($db->prepare("SELECT date, value AS count
												  FROM $aggregation_table 
												  WHERE type='refer-%d'
												  AND (date BETWEEN '%s' AND date_add('%s', interval 1 day));",
												  $page['id'], $datetimestart, $datetimestop)
									);
		
		$data = array();
		foreach ($results as $res) {
			$data[$res->date] = $res->count;
		}
		
		if ( isset($todays_data['refer-' . $page['id']]) ) {
			$data[$today] = $todays_data['refer-' . $page['id']];
		}
		
		array_push($chart_data, array('label' => $page['title'],
									  'data' => $data) );
	}
	
	// Get hourly data
	$hourly_datetimestart = $datetimestart;
	$hourly_datetimestop =  $datetimestop;
	$hourly_startDateTime =  new DateTime($hourly_datetimestart);
	$hourly_stopDateTime =  new DateTime( $hourly_datetimestop );
	$flow_startDateTime = new DateTime( $WP_VisitorFlow->get_setting('flow-startdatetime') );
			
	if ($hourly_startDateTime > $flow_startDateTime ) {
		$hourly_datetimestart = $WP_VisitorFlow->get_setting('flow-startdatetime');
	}
	if ($hourly_stopDateTime < $flow_startDateTime ) {
		$hourly_datetimestop = $WP_VisitorFlow->get_setting('flow-startdatetime');
	}

	$hourly_data = array();
	foreach ($top_pages as $page) {
		$results = $db->get_results($db->prepare("SELECT COUNT(id) AS count,
														 HOUR(datetime) as hour
												  FROM $flow_table 
												  WHERE f_page_id='%s'
												  AND step=1
												  AND (datetime BETWEEN '%s' AND date_add('%s', interval 1 day))
												  GROUP BY HOUR(datetime);",
												  $page['id'], $hourly_datetimestart, $hourly_datetimestop)
									);
		
		$data = array();
		foreach ($results as $res) {
			$data[$res->hour] = $res->count;
		}
		
		for ($h = 0; $h <= 23; $h++) {
			if (! isset($data[$h])) { 
				$data[$h] = 0;
			}
		}
		
		ksort($data);

		array_push($hourly_data, array('label' => $page['title'],
									   'data' => $data) );
	}
	
	
	echo '<br />';
	include_once dirname( __FILE__ ) . '/../functions/wp_visitorflow_jqplot_plot.php';
	include_once dirname( __FILE__ ) . '/../functions/wp_visitorflow_jqplot_piechart.php';
	include_once dirname( __FILE__ ) . '/../functions/wp_visitorflow_jqplot_filledarea.php';

?>
	<div class="twocol_left">
		<h2><?php echo sprintf(__('%s Top Referrers within the Selected Timeframe', 'wp_visitorflow'), $hit_count); ?></h2>

		<table class="wpvftable">
		<tr>
			<th><?php echo __('Counts', 'wp_visitorflow'); ?></th>
			<th colspan="2"><?php echo __('Referrer', 'wp_visitorflow'); ?></th>
		</tr>
		<?php echo $table_html; ?>
		</table>
	</div>
	<div class="twocol_right">
		<h2><?php echo __('Development of Top Referrers within the Selected Timeframe', 'wp_visitorflow'); ?></h2>
<?php	
		wp_visitorflow_plot( '',
								 $chart_data,
								 array('id' => 'chart_referrers',
									   'width' => '100%', 
									   'height' => '500px')
							);
?>
		<h2><?php echo __('Top Referrers over Time of the Day', 'wp_visitorflow'); ?></h2>
		<em>(<?php echo sprintf(__('Data from %s to %s', 'wp_visitorflow'),		
								date_i18n( get_option( 'date_format' ), strtotime($hourly_datetimestart)),
								date_i18n( get_option( 'date_format' ), strtotime($hourly_datetimestop))
								); ?>)</em><br />
<?php	
	wp_visitorflow_filledarea( '',
						 $hourly_data,
						 array('id' => 'hourly_pages',
							   'width' => '100%', 
							   'height' => '500px')
						);

?>
	</div>
	
	<div style="clear:both;"></div>
	<br />
	<br />
	<br />
	
	<div class="twocol_left">
<?php	
	
		wp_visitorflow_piechart( __('Search Engine Summary', 'wp_visitorflow'),
								 $searchengine_shares,
								 array('id' => 'pie_engines',
									   'width' => '350px', 
									   'height' => '450px',
									   'legendrows' => 4)
								);
?>
	</div>
	<div class="twocol_right">
		<h3><?php echo __('Latest Search Key Words', 'wp_visitorflow'); ?></h3>
<?php
		include_once dirname( __FILE__ ) . '/../../includes/functions/wp_visitorflow_getSEKeywordsTable.php';
?>
	</div>
<?php
