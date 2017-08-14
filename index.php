<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php get_header(); ?>
	<body>
		<div v-cloak id="app">
			<?php get_sidebar(); ?>
			<section id="list">
				<header>NOTES</header>
				<div id="list-filter">
					<span>{{ listData.length }} notes</span>
				</div>
				<section id="list-view">
					<div v-for="note in listData" class="list-note">
						<div v-bind:class="{'list-note-block':note.post_image===0, 'list-note-inline':note.post_image!==0, 'list-note-wrap': true }">
							<div>
								{{ note.post_title }}
							</div>
							<span>
								{{ dateChecker( note.post_modified ) }}
							</span>
							<div>
								{{ note.post_content }}
							</div>
						</div>
						<img v-show="note.post_image!==0" v-bind:src="note.post_image" />
						<span></span>
					</div>
				</section>
				
			</section>
		</div>
		<?php get_footer(); ?>
	</body>
</html>