<?php
/**
 * Template name: Как попасть в труппу театра МОСТ
 */
get_header(); 
the_post();
?>
<section class="main-section">
	<div class="page-wrap">
		<?php
		if(has_post_thumbnail())
		{
			echo '<h1 class="page-title">';
			the_title();
			echo '</h1>';
			?>
			<div class="row ticket">
				<div class="col-md-3 col-lg-3">
					<?php the_post_thumbnail('ticket-image'); ?>
					<button class="btn-on-page" onclick="showForm('#get-there-form');">Подать заявку</button>
				</div>
				<div class="col-md-9 col-lg-9"><?php the_content(); ?></div>

			</div>
			<?php
		}
		else
		{
			the_content();
		}
		?>
	</div>
	<div class="get-there">
		<img src="<?php bloginfo('template_url'); ?>/img/get_there.jpg" alt="<?php the_title(); ?>">
		<form action="" method="post" id="get-there-form">
			<div class="get-there-wrap">
				<div class="row">
					<div class="col-md-3 col-lg-3">
						<input type="text" name="getthere[family]" placeholder="Фамилия*:" class="row">
						<input type="text" name="getthere[name]" placeholder="Имя*:" class="row">
						<input type="text" name="getthere[old]" placeholder="Возраст*:" class="row">
						<input type="text" name="getthere[university]" placeholder="Учебное заведение*:" class="row">
						<input type="text" name="getthere[email]" placeholder="Почта*:" class="row">
						<input type="text" name="getthere[phone]" placeholder="Телефон*:" class="row">
					</div>
					<div class="col-md-9 col-lg-9">
						<div class="padding-left-30">
							<select name="getthere[type]" id="" class=".styler" placeholder="Тип учебной группы*:">
								<option value="1">Тип 1</option>
								<option value="2">Тип 2</option>
								<option value="3">Тип 3</option>
							</select>
							<textarea name="getthere[coments]" id="" cols="90" rows="8" placeholder="Коментарий*:"></textarea>
							<button type="submit">Отправить</button>	
						</div>
					</div>
				</div>	
			</div>
		</form>
	</div>
	
<?php
get_footer('clean');