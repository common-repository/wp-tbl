<?php
/**
* TBL Button Class
*
* @author Kaloyan K. Tsvetkov <kaloyan@kaloyan.info>
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

/////////////////////////////////////////////////////////////////////////////

/**
* @internal prevent from direct calls
*/
if (!defined('ABSPATH')) {
	return ;
	}
	
/////////////////////////////////////////////////////////////////////////////

	// merge old and new settings
	//
	$default =  array(
		'blog_id' => null,
		'theme' => '1',
		'bgcolor' => 'FFFFFF',

		'append' => false,
		'append_position' => 's',
		'html_pre' => '',
		'html_post' => '',

		'pages' => array(
			'is_home' => 1,
			'is_single' => 1,
			'is_page' => 0,
			'is_category' => 0,
			'is_tag' => 0,
			'is_date' => 0,
			'is_search' => 0,
			),

		'version' => -1,
		);

	$wp_tbl_settings = $this->settings + $default;
	$wp_tbl_settings['version'] = $this->version();
	
	update_option(
		'wp_tbl_settings',
		$wp_tbl_settings	
		);

	$this->settings = $wp_tbl_settings;
	
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 