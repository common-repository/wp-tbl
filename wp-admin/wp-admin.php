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

/**
* ...
* @see wp_admin_page
*/
require_once WP_TBL_DIR . '/lib/wp-admin-page/class.wp-admin-page.php';

/////////////////////////////////////////////////////////////////////////////

/**
* @internal check if class is already loaded
*/
if (class_exists('wp_tbl_admin')) {
	return ;
	}

/////////////////////////////////////////////////////////////////////////////

/**
* The administration panel class
*
* This class handles the pages attached to the backend
*/
Class wp_tbl_admin Extends wp_admin_page {

	/**
	* Constructor
	*
	* Instantiates the page controller and places the required
	* plugin hooks for the loaded page controller
	*
	* @param boolean $init
	*/
	Function wp_tbl_admin($init = 0) {

		// page ?
		//
		if (!$init) {
			parent::wp_admin_page();
			return;
			}

		// menu ?
		//
		wp_admin_page::admin_menu(
			'',
			array(

				// dashboard
				//
				'options-general.php' => array(
					'submenu' => array(
						'tbl_settings' => array(
							'file' => __FILE__,
							'class' => __CLASS__,
							'page_title' => '&#1041;&#1091;&#1090;&#1086;&#1085;&#1080; &#1079;&#1072; TBL &rsaquo; &#1053;&#1072;&#1089;&#1090;&#1088;&#1086;&#1081;&#1082;&#1080;',
							'menu_title' => '&#1041;&#1091;&#1090;&#1086;&#1085;&#1080; &#1079;&#1072; TBL',
							),
						)
					),
				)
			);
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	*/
	Function admin_head() {
		global $wp_tbl;
		$plugin = './../wp-content/plugins/'
				. basename(dirname(dirname(__FILE__)));
		include_once dirname(__FILE__)
				. '/templates/settings.head.php';
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	* Convert Slugs
	*/
	Function index() {
		global $wp_tbl;
		include_once dirname(__FILE__)
				. '/templates/settings.page.php';
		}

	/**
	* Do convert the slugs
	*/
	Function action_save() {

		// information updated ?
		//
		if (!$_POST['submit']) {
			return $this->index();
			}

		// sanitize
		//
		$_POST['wp_tbl_settings'] = (array) $_POST['wp_tbl_settings'];
		array_walk($_POST['wp_tbl_settings'],
			create_function('&$v, $k',' $v = is_scalar($v) ? stripSlashes($v) : $v;')
			);

		// save
		//
		update_option(
			'wp_tbl_settings',
			$_POST['wp_tbl_settings']+ (array) get_option('wp_tbl_settings')
			);

		wp_admin_page::redirect(
			remove_query_arg(
				array('saved'),
				$_SERVER['REQUEST_URI']
				)
			. '&saved=1',
			1);
		}

	//--end-of-class--
	}
