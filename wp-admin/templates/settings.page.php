
<div class="wrap">
	<div id="icon-edit" class="icon32"><br /></div>
	<h2>TBL Бутони &rarr; Настройки</h2>

<?php	wp_admin_page::ok('Настройките бяха записани успешно.', 'saved'); wp_admin_page::error('', 1); ?>

	<form action="" method="post" style="padding:0;margin:0;">
		<input type="hidden" name="action" value="save" />


	<div id="poststuff" class="metabox-holder has-right-sidebar">

		<div id="side-info-column" class="inner-sidebar">
			<div class="meta-box-sortables">

				<div id="submitdiv" class="stuffbox">

					<div class="submitbox" id="submitlink">

<div id="minor-publishing" style="padding: 0 10px 10px;">

	<p><strong>Облик</strong></p>

	<table class="wp-tbl-look">
		<tr>
			<th>
				<label for="wp_tbl_settings_theme">Форма:</label>
			</th>
			<td>
				<select id="wp_tbl_settings_theme" name="wp_tbl_settings[theme]">
				<?php $this->html_options(
					array(
						'1' => 'Стил #1',
						'2' => 'Стил #2',
						'3' => 'Стил #3',
						'4' => 'Стил #4',

						'5' => 'Стил #5',
						'6' => 'Стил #6',
						'7' => 'Стил #7',
						'8' => 'Стил #8',
						'9' => 'Стил #9',
						),
					$wp_tbl->settings['theme']
					); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp_tbl_settings_append_position">Разположение:</label><br />
			</th>
			<td>
				<select id="wp_tbl_settings_append_position" name="wp_tbl_settings[append_position]">
				<?php $this->html_options(
					array(
						's'=>'отдолу по средата',
						'sw'=>'отдолу вляво',
						'se'=>'отдолу вдясно',
						'nw'=>'горе вляво',
						'ne'=>'горе вдясно',
						),
					$wp_tbl->settings['append_position']
					); ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<label for="wp_tbl_settings_bgcolor">Фон:</label><br />
			</th>
			<td> # <input id="wp_tbl_settings_bgcolor" name="wp_tbl_settings[bgcolor]"
				autocomplete="off" maxlength="6" value="<?php echo $wp_tbl->settings['bgcolor']; ?>" style="width:100px;"/>

			</td>
		</tr>
	</table>

					<?php for($i = 1; $i<=9; $i++) { ?>
<div class="wp-tbl-preview wp-tbl-theme-<?php echo $i;?>" <?php if ($wp_tbl->settings['theme'] == $i) echo 'style="display:block;"'; ?> >
Стил на бутон #<?php echo $i;?><br />
<div class="wb-tbl-preview-button">
<script type="text/javascript">
 btntype = <?php echo $i;?>;
 col1 = '#<?php echo $wp_tbl->settings['bgcolor']; ?>';
 blog_id = 59;
 url = 'http://kaloyan.info/blog/wp-tbl/';
//-->
</script><script src="http://topbloglog.com/js/votebtn.js" type="text/javascript"></script>
</div><div class="wb-tbl-preview-sample"><img src="http://www.topbloglog.com/i/sample-btn-<?php echo $i; ?>.gif" /></div></div>
					<?php } ?>
		<a id="wp-tbl-all-themes" title="Всички стилове за бутони">Виж всички стилове на бутони</a>

</div>

<div id="major-publishing-actions">

	<div id="publishing-action">
		<input class="button-primary" id="save-post"
			 type="submit" name="submit" value="Запази" />
	</div>

	<div class="clear"></div>
</div>

						<div class="clear"></div>
					</div>
				</div>
			</div>

			<div class="side-info">
				<h5>Версия</h5>
				<p>Бутони за TopBlogLog, версия <?php echo $wp_tbl->version();?></p>

				<h5>Повече информация</h5>
				<ul>
				<li><a href="http://kaloyan.info/blog/wp-tbl/">Страницата на проекта</a>
				<li><a href="http://www.topbloglog.com/forum/topic.php?id=63">Описание на бутоните</a>
				<li><a href="http://topbloglog.com/">TopBlogLog</a>
				<li><a href="http://kaloyan.info">Kaloyan.info</a>
				</ul>
			</div>

		</div>

		<div id="post-body" class="has-sidebar">
			<div id="post-body-content" class="has-sidebar-content">


			<h2>Автоматично добавяне</h2>
			<p class="note">
				Една от възможностите, които предлага този плъгин, е бутоните за
				<em>TopBlogLog</em> да се добавят автоматично към всички материали публикувани на
				вашия блог. Ако искате да се възползвате от този вариант, използвайте
				тази форма за да укажете къде точно искате да се покажат бутоните (ако
				искате вие да контролирате къде се появяват бутоните прочетете секцията
				<a href="#howto">"Бутони за TopBlogLog: Начин на използване"</a>).
			</p>


			<div class="stuffbox">
				<h3><label for="wp_tbl_settings_append">
						Автоматично добавяне:
					</label></h3>

				<div class="inside">
					<select style="width:150px;" id="wp_tbl_settings_append" name="wp_tbl_settings[append]">
				<?php $this->html_options(
					array(0=>'не',1=>'да'),
					$wp_tbl->settings['append']
					); ?>
				</select>
					<p>Дали да се добавят автоматично бутоните или не. </p>
				</div>
			</div>



			<h2>Страници</h2>
			<p class="note">
				От тук може да контролирате на кои части от блога да се показват
				бутоните и на кои не.
			</p>

			<?php
			$_pages = array(
				'is_home' => array(
					'Първа страница:',
					'Това е първата страница на блога ви, където обикновенно се показват най-новите ви постове.'
					),
				'is_single' =>  array(
					'Блог постове:',
					'Това са страниците, на които се показват индивидуално всеки пост (и коментарите му).'
					),
				'is_page' =>  array(
					'Самостоятелни страници:',
					'Това са "статичните" страници, които например "About Me" и "За Мен" страниците.'
					),
				'is_category' =>  array(
					'Архиви по категории:',
					'Това са страниците, чрез които разглеждате постовете, подредени по категории.'
					),
				'is_tag' =>  array(
					'Архиви по етикети (тагове):',
					'Това са страниците, чрез които разглеждате постовете, подредени по етикети(тагове).'
					),
				'is_date' =>  array(
					'Архиви по дати:',
					'Това са страниците, чрез които разглеждате постовете, подредени по дата (по година, по месец, по ден)'
					),
				'is_search' =>  array(
					'Резултати от търсене:',
					'Това са страниците, на които се покзават резултатите от търсенето в постовете от вашия блог.'
					),
				);

			foreach ($_pages as $k=>$v) {
				?>
				<div class="stuffbox">
					<h3><label for="wp_tbl_settings_pages_<?php echo $k;?>"><?php echo $v[0];?></label></h3>

					<div class="inside">
						<select style="width:150px;" id="wp_tbl_settings_pages_<?php echo $k;?>"
							name="wp_tbl_settings[pages][<?php echo $k;?>]">
						<?php $this->html_options(
							array(0=>'не',1=>'да'),
							$wp_tbl->settings['pages'][$k]
							); ?>
						</select>
						<p><?php echo $v[1];?></p>
					</div>
				</div>
			<?php } ?>



				<h2>Оформление</h2>
				<p class="note">
					Ако искате да "облечете" бутоните в допълнителен HTML код,
					използвайте следващите две настройки:
				</p>

				<div class="stuffbox">
					<h3><label for="wp_tbl_settings_html_pre">
						HTML код за показване преди бутона:
					</label></h3>

					<div class="inside">
						<textarea id="wp_tbl_settings_html_pre"
							name="wp_tbl_settings[html_pre]"
							><?php echo htmlSpecialChars($wp_tbl->settings['html_pre']); ?></textarea>
						<p>HTML код, който ще бъде отпечатан преди бутоните.</p>
					</div>
				</div>

				<div class="stuffbox">
					<h3><label for="wp_tbl_settings_html_post">
						HTML код за показване след бутона:
					</label></h3>

					<div class="inside">
						<textarea id="wp_tbl_settings_html_post"
							name="wp_tbl_settings[html_post]"
							><?php echo htmlSpecialChars($wp_tbl->settings['html_post']); ?></textarea>
						<p>HTML код, който ще бъде отпечатан след бутоните.</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	</form>

	<br class="clear" />

<br />
<br />
<br />
<br />

<a name="howto"></a>
<h2>Бутони за TopBlogLog &rarr; Начин на използване</h2>

<div style="width: 76%;">
<p>
	Поставянето на бутоните за <em>TopBlogLog</em> изобщо не е трудно, но
	автоматизирането на тази дейност може да ви спести малко време, а и
	малко неприятности (като например да поставите бутоните в темата която
	използвате и да се налага да ги копирате отново ако смените темата).
</p>

<blockquote>
	<p>
	Начините (режимите) на използване са два: "ръчен" и "автоматичен".
	</p>
</blockquote>

<p>
	При <em>автоматичния режим</em>, бутоните се добавят автоматично към
	всики материали от блога ви. Забележете, че те се добавят чак при
	отпечатването, и по никакъв начин не променят съдържанието на
	материалите, запаметено в базата данни. Недостатък на този режим, е че
	бутоните, ще се появат на всички страници и не можете да укажете, ако
	искате някои от страниците да нямат бутон.
</p>

<p>
	При <em>ръчния режим</em>, вие сами контролирате на кои страници да се
	показват бутоните, като поставяте малки псевдо тагове, ето така:
</p>

<blockquote>
	<pre style="background:#BFDFFF; padding: 1em; ">[topbloglog]</pre>
</blockquote>

<p>
	При този режим имате пълен контрол - сами може да определите дали да
	сложите бутона или не, и ако решите да го сложите, имате възможност да
	го "засадите" където пожелаете в страниците си. Ето един пример:
</p>

<blockquote>
	<pre style="background:#BFDFFF; padding: 1em; ">Здравейте,
това е кратък увод, след който ще дойде реда да поставя
бутона на който ще се радвам да гласувате.

<b>[topbloglog]</b>

Сега, да продължим&hellip;</pre></blockquote>

<p>
	Ако използвате и двата режима (автоматичния режим е включен, и въпреки
	това поставите псевдо-таг), "ръчния" режим ще има по-голям приоритет, и
	бутонът ще се покаже там, където сте поставили <code>[topbloglog]</code> таг-а, a
	за сметка на това, автоматичното поставяне на бутона няма да се включи.
</p>

<p>
	За повече информация посете тази <a
	href="http://kaloyan.info/blog/wp-tbl/"
	title="Бутони за TopBlogLog" target="_blank">страница</a>.
</p>
</div>

</div>


<!-- таблица за показване на всички -->
<div id="wp-tbl-thickbox-preview"><table class="wp-tbl-thickbox-preview">
	<tr>
	<?php for($i = 1; $i<=9; $i++) { ?><td
		onClick="jQuery('#wp_tbl_settings_theme').val('<?php echo $i; ?>').change();">
Стил на бутон #<?php echo $i;?><br />

<div class="wb-tbl-preview-sample">
	<img src="http://www.topbloglog.com/i/sample-btn-<?php echo $i; ?>.gif" />
</div>
	</td><?php if (!($i % 3)) echo '</tr><tr>'; } ?>
</tr></table></div>