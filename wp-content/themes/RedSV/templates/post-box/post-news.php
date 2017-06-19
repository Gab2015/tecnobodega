<div class="Newslider no-control-nav postnews-slider">
	<ul class="slides">

	<?php while( have_posts() ) : the_post(); ?>
		<li><div class="post-box-inner">
					<h2 class="title">
						<span class="super-title"><?php echo $post_date; ?></span>
						<span><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'redthemesv'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></span>
					</h2>
                    <?php global $more; $more = 0; the_content(); ?>
					<span class="read-more2">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'redthemesv'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php _e( 'Leer Más', 'redthemesv' ); ?> <i class="icon-entypo-right-open"></i></a>
					</span>
				</div>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'redthemesv'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
				<div class="post-thumbnail-wrapper2">
					<?php the_post_thumbnail( 'vw_large' ); ?>
				</div>

				
			</a>
		</li>
	<?php endwhile; ?>
	
	</ul>
</div>