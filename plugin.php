<?php
/*
Plugin Name: &#1041;&#1091;&#1090;&#1086;&#1085;&#1080; &#1079;&#1072; TBL (TopBlogLog)
Version: 0.1.9
Plugin URI: http://kaloyan.info/blog/wp-tbl
Description: &#1058;&#1086;&#1079;&#1080; &#1087;&#1083;&#1098;&#1075;&#1080;&#1085; &#1097;&#1077; &#1074;&#1080; &#1087;&#1086;&#1084;&#1086;&#1075;&#1085;&#1077; &#1083;&#1077;&#1089;&#1085;&#1086; &#1080; &#1073;&#1098;&#1088;&#1079;&#1086; &#1076;&#1072; &#1087;&#1086;&#1089;&#1090;&#1072;&#1074;&#1077;&#1090;&#1077; &#1073;&#1091;&#1090;&#1086;&#1085;&#1080;&#1090;&#1077; &#1079;&#1072; &#1075;&#1083;&#1072;&#1089;&#1091;&#1074;&#1072;&#1085;&#1077; &#1085;&#1072; <a target="_blank" href="http://topbloglog.com">TopBlogLog</a>
Author: Kaloyan K. Tsvetkov
Author URI: http://kaloyan.info/
*/

/////////////////////////////////////////////////////////////////////////////

/**
* @internal prevent from direct calls
*/
if (!defined('ABSPATH')) {
	return ;
	}

/**
* The directory path to the plugin
*/
define('WP_TBL_DIR', dirname( __FILE__ ));

/**
* @internal prevent from second inclusion
*/
if (!isset($wp_tbl)) {

	/**
	* Initiating the plugin...
	* @see wp_tbl
	*/
	$wp_tbl = new wp_tbl;
	}

/////////////////////////////////////////////////////////////////////////////

/**
* TBL Button Class
*
* @author Kaloyan K. Tsvetkov <kaloyan@kaloyan.info>
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/
Class wp_tbl {

	/**
	* The settings for the plugin (better to read them from
	* a class var, then from the DB all the time).
	* @var array
	*/
	var $settings = array();

	/**
	* Constructor
	*
	* Reads the settings, attaches the extra tables, and places the plugin hooks
	*/
	Function wp_tbl() {

		// settings ?
		//
		$this->settings = (array) get_option('wp_tbl_settings');

		// start the admin pages ...
		//
		if (is_admin()) {
			require_once(
				WP_TBL_DIR . '/wp-admin/wp-admin.php'
				);
			new wp_tbl_admin($this);
			} else {

			// attach the handler
			//
			if ($this->settings['append']) {
				add_action('the_content',
					array(&$this, 'the_content'),
					12
					);
				}

			// add shortcode
			//
			add_shortcode('tbl', array($this, 'shortcode'));
			add_shortcode('topbloglog', array($this, 'shortcode'));
			}

		// attach to plugin installation
		//
		register_activation_hook(
			__FILE__, array(&$this, 'install'));
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	* Performs the routines required at plugin installation:
	* in general introducing the settings array
	*/
	Function install() {

		require_once(
			dirname(__FILE__)
				. '/plugin/install.php'
			);
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	* Get the version of the plugin
	* @access public
	*/
	Function version() {
		if (preg_match('~Version\:\s*(.*)\s*~i',
				file_get_contents(__FILE__), $R)
			) {
			return trim($R[1]);
			}

		return '$Rev: 261332 $';
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	*/
	Function get_button($args = null) {

		// parse the arguments
		//
		$args = wp_parse_args($args, $this->settings);

		// the css classes ?
		//
		$css = 'wp_tbl ';
		if (is_home()) {
			$css .= ' wp_tbl_home ';
			}
		if (is_single()) {
			$css .= ' wp_tbl_single ';
			}
		if (is_category()) {
			$css .= ' wp_tbl_category tbl_archive ';
			}
		if (is_tag()) {
			$css .= ' wp_tbl_tag tbl_archive ';
			}
		if (is_date()) {
			$css .= ' wp_tbl_date tbl_archive ';
			}
		if (is_search()) {
			$css .= ' wp_tbl_search ';
			}

		// the button
		//
		$button = $args['html_pre'] . '<span class="' . $css . '"><script type="text/javascript">
<!--// [wp-tbl, v' . $this->version() . ' ($Rev: 261332 $)]
 btntype = ' . (
	in_array($args['theme'], range(1,9))
		? $args['theme']
		: '1') . ';
 col1 = \'#' . $args['bgcolor'] . '\'; ' . ( $args['blog_id']
	? ("\r\n" . ' blog_id = \'' . $args['blog_id'] . '\';')
	: '' ) . '
 url = \'' . get_permalink() . '\';

//-->
</script><script src="http://topbloglog.com/js/votebtn.js" type="text/javascript"></script></span>' . $args['html_post'];

		return $button;
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	/**
	*/
	Function the_content($content) {

		// feed detected - give up ...
		//
		if (is_feed()) {
			return $content;
			}

		// shortcode already added ?
		//
		global $post;
		if (isset($post->wp_tbl_shortcode) && $post->wp_tbl_shortcode) {
			return $content;
			}

		foreach ($this->settings['pages'] as $k => $v) {
			if (!is_callable($k)) {
				continue;
				}

			if ($k()) {
				if (!$v) {
					return $content;
					}
				break;
				}
			}

		// append
		//
		switch($this->settings['append_position']) {

			case 'nw' : /* north-west: upper left */
				$content = '<span class="wp_tbl_append" style="float:left; padding-right: 1em;">'
						. $this->get_button() . '</span>'
						. $content;
				break;

			case 'ne' : /* north-east: upper right */
				$content = '<span class="wp_tbl_append" style="float:right; padding-left: 1em;">'
						. $this->get_button() . '</span>'
						. $content;
				break;

			case 'sw' : /* south-west: bottom left */
				$content .= '<div class="wp_tbl_append" style="text-align:left;">'
						. $this->get_button() . '</div>';
				break;

			case 'se' : /* south-east: bottom right */
				$content .= '<div class="wp_tbl_append" style="text-align:right;">'
						. $this->get_button() . '</div>';
				break;

			case 's' : /* south: bottom centered */
			default :
				$content .= '<div class="wp_tbl_append" style="text-align:center;">'
						. $this->get_button() . '</div>';
				break;
			}

		return $content;
		}

	/**
	*/
	Function shortcode($args = array()) {

		// feed detected - give up ...
		//
		if (is_feed()) {
			return '';
			}

		global $post;
		$post->wp_tbl_shortcode = 1;
		return $this->get_button($args);
		}

	//--end-of-class--
	}

/////////////////////////////////////////////////////////////////////////////

/**
*/
Function get_tbl_button($args = array()) {
	global $wp_tbl;
	return $wp_tbl->get_button($args);
	}

/**
*/
Function the_tbl_button($args = array()) {
	global $wp_tbl;
	echo $wp_tbl->get_button($args);
	}