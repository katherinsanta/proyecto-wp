<?php
	
	// /*get latest themes from themeforest for user visrusnac*/
	// //$tf = wp_remote_get("http://marketplace.envato.com/api/v3/new-files-from-user:cosmothemes,themeforest.json");
	// $tf = '';
	
	// if (!is_wp_error($tf)){
	// 	// If everything's okay, parse the body and json_decode it
	// 	echo '<div>';
	// 	$json = json_decode(wp_remote_retrieve_body($tf));		
	// 	if(sizeof($json)){
	// 		foreach ($json as $key => $themes) {
	// 			if(sizeof($themes)){
	// 				foreach ($themes as $cosmo_theme) {
						
	// 					echo '<div  class="our_themes left"><a href="'.$cosmo_theme->url.'?ref=cosmothemes"><img src="'.$cosmo_theme->thumbnail.'" alt="'.$cosmo_theme->item.'" /></a></div>';
	// 				}
	// 			}
	// 		}
	// 	}
	// 	echo '</div>';
	// }else{
	// 	_e('No result, try again later.','cosmotheme');
	// }

	// $portfolio_link = 'http://themeforest.net/user/cosmothemes/portfolio?ref=cosmothemes';
	// $all_items = sprintf(__('%s All Cosmothemes items %s','cosmotheme'),'<div style="clear:both;"><a href="'.$portfolio_link.'">', '</a></div>');
	// echo $all_items;
?>