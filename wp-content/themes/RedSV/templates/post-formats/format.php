<?php
$blog_show_featured_image_single_post = vw_get_option( 'blog_show_featured_image_single_post' );
if ( '0' == $blog_show_featured_image_single_post ) return;

if ( has_post_thumbnail() ) :
	$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	?>
	<div class="post-thumbnail-wrapper">
		<a class="swipebox" href="<?php echo $full_image_url[0]; ?>" title="<?php printf( esc_attr__('Permalink to image of %s', 'redthemesv'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
			<?php the_post_thumbnail( 'vw_large' ); ?>
		</a>
	</div>
<?php endif; ?>