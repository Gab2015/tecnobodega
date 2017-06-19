<div class="post-meta header-font">
	
	<?php $post_date = get_the_time(get_option('date_format')); ?>
	<a href="<?php the_permalink(); ?>" class="post-date updated" title="<?php printf( esc_attr__('Permalink to %s', 'redthemesv'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php echo $post_date; ?></a>
</div>