<!-- [wp-tbl] -->
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $plugin; ?>/wp-admin/js/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo $plugin; ?>/wp-admin/js/colorpicker/js/colorpicker.js"></script>

<script type="text/javascript"><!--//
jQuery(document).ready(
	function() {
		jQuery('#wp_tbl_settings_bgcolor').blur(
			function() {
				var color = '#ffffff';
				if (jQuery(this).val()) {
					color = '#' + jQuery(this).val();
					}

				jQuery('.wb-tbl-preview-button').css('background-color', color);

				var ifr = document.getElementsByTagName('iframe');
				for (i=0;i<ifr.length;i++) {
					if (ifr[i].src.indexOf('http://topbloglog.com/vote-button.php?') > -1) {
						ifr[i].src += '&col1=' + jQuery(this).val();
						}
					}
				}
			);
		}
	);
//-->
</script>
<script type="text/javascript"><!--//
jQuery(document).ready(
	function() {
		jQuery('#wp_tbl_settings_theme').change(
			function() {
				jQuery('.wp-tbl-preview').hide();
				jQuery('.wp-tbl-theme-' + jQuery(this).val()).show();
				tb_remove();
				}
			);
		}
	);
//-->
</script>
<script type="text/javascript"><!--//
jQuery(document).ready(
	function() {
		if (tb_show) {
			jQuery('#wp-tbl-all-themes').css('visibility', 'visible').click(
				function() {
					tb_show(this.title,
						'#TB_inline?height=478&width=800&inlineId=wp-tbl-thickbox-preview',
						false);
					return false;
					}
				);

			}
		}
	);
//-->
</script>
<script type="text/javascript"><!--//
jQuery(document).ready(
	function() {

			jQuery('#wp_tbl_settings_bgcolor').ColorPicker({
				"color": '<?php echo $wp_tbl->settings['bgcolor']; ?>',
				"onSubmit": function(hsb, hex, rgb) {
					jQuery('#wp_tbl_settings_bgcolor').val(hex);
				},
				"onBeforeShow": function () {
					jQuery(this).ColorPickerSetColor(this.value);
				},
				"onChange": function (hsb, hex, rgb) {
					jQuery('#wp_tbl_settings_bgcolor').val(hex).blur();
				}

			})
			.bind('keyup', function(){
				jQuery(this).ColorPickerSetColor(this.value);
			});

		}
	);
//-->
</script>

<style type="text/css">
table.wp-tbl-look {
	width: 100%;
	}
table.wp-tbl-look th {
	font-weight: normal;
	text-align: right;
	white-space: nowrap;
	}
table.wp-tbl-look td select,
table.wp-tbl-look td input {
	width: 88%;
	}
.wp-tbl-preview {
	text-align: center;
	line-height: 24px;
	padding: 0px 10px 10px;
	border: solid 1px silver;
	background: white;
	margin-top: 10px;
	display:none;
	}
#wp_tbl_settings_html_pre,
#wp_tbl_settings_html_post {
	width: 99%
	}

.wb-tbl-preview-button {
	padding: 6px 0;
	background-color: #<?php echo $wp_tbl->settings['bgcolor']; ?>;
	}
.wb-tbl-preview-sample {
	padding: 6px 0;
	background-color: #fff;
	}
#wp-tbl-all-themes {
	text-align: center;
	display: block;
	cursor: pointer;
	margin-top:4px;
	font-size:11px;
	visibility:hidden;
	}
#wp-tbl-thickbox-preview {
	display:none;
	}
table.wp-tbl-thickbox-preview {
	width: 100%;
	margin-top: 13px;
	}
table.wp-tbl-thickbox-preview td {
	text-align: center;
	border: solid 1px black;
	font-weight: bold;
	height:150px;
	cursor: pointer;
	}
table.wp-tbl-thickbox-preview td .wb-tbl-preview-sample {
	margin-top: 10px;
	}
</style>