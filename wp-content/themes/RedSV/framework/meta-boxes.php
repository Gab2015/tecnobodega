<?php
global $meta_boxes;
if ( ! isset( $meta_boxes ) ) {
	$meta_boxes = array();
}

add_action( 'after_setup_theme', 'vw_setup_meta_boxes' );
function vw_setup_meta_boxes() {
	add_action( 'admin_init', 'vw_register_meta_boxes' );
}

/* -----------------------------------------------------------------------------
 * Register meta boxes
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_register_meta_boxes' ) ) {
	function vw_register_meta_boxes() {
		global $meta_boxes;

		$page_sidebars = vw_get_registered_sidebars();

		/* -----------------------------------------------------------------------------
		 * Post Options
		 * -------------------------------------------------------------------------- */
		$meta_boxes[] = array(
			'id' => 'vw_page_options',
			'title' => __( 'Post Options', 'redthemesv-backend' ),
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => __( 'Make this post featured', 'redthemesv-backend' ),
					'id' => 'vw_post_featured',
					'type' => 'checkbox',
				),
				array(
					'name' => __( 'Post Layout', 'redthemesv-backend' ),
					'id' => 'vw_post_layout',
					'desc' => __( 'Choose the post layout.' , 'redthemesv-backend' ),
					'type' => 'select',
					'std' => 'right',
					'options' => array(
						'right' => __( 'Right Sidebar', 'redthemesv-backend' ),
						'fullwidth' => __( 'Full Width', 'redthemesv-backend' ),
					),
				),
			)
		);

		/* -----------------------------------------------------------------------------
		 * Page Options
		 * -------------------------------------------------------------------------- */
		$meta_boxes[] = array(
			'id' => 'vw_page_options',
			'title' => __( 'Page Options', 'redthemesv-backend' ),
			'pages' => array( 'page' ),
			'fields' => array(
				array(
					'name' => __( 'Page Subtitle', 'redthemesv-backend' ),
					'id' => 'vw_page_subtitle',
					'type' => 'text',
				),
				array(
					'name' => __( 'Sidebar Position', 'redthemesv-backend' ),
					'id' => 'vw_page_sidebar_position',
					'desc' => __( 'Choose the sidebar position.' , 'redthemesv-backend' ),
					'type' => 'select',
					'std' => 'right',
					'options' => array(
						'hidden' => __( 'Hidden', 'redthemesv-backend' ),
						'left' => __( 'Left Sidebar', 'redthemesv-backend' ),
						'right' => __( 'Right Sidebar', 'redthemesv-backend' ),
					),
				),
				array(
					'name' => __( 'Sidebar', 'redthemesv-backend' ),
					'id' => 'vw_page_sidebar',
					'desc' => __( 'You can edit the Default Page Sidebar at Opciones del Tema page (General &gt; Default Sidebar For Pages).' , 'redthemesv-backend' ),
					'type' => 'select',
					'options' => $page_sidebars,
				),
			)
		);

		/* -----------------------------------------------------------------------------
		 * Review Meta Box
		 * -------------------------------------------------------------------------- */
		$meta_boxes[] = array(
			'id' => 'vw_review',
			'title' => __( 'Review Options', 'redthemesv-backend' ),
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => __( 'Enable Review', 'redthemesv-backend' ),
					'id' => 'vw_enable_review',
					'type' => 'checkbox',
				),
				array(
					'name' => __( 'Review Summary', 'redthemesv-backend' ),
					'id' => 'vw_review_summary',
					'class' => 'field-review-summary',
					'type' => 'textarea',
				),
				array(
					'name' => __( 'Review Score', 'redthemesv-backend' ),
					'id' => 'vw_review_scores',
					'class' => 'field-review-score',
					'type' => 'review_score',
				),
			)
		);

		/* -----------------------------------------------------------------------------
		 * Post Formats
		 * -------------------------------------------------------------------------- */
		$meta_boxes[] = array(
			'id' => 'vw_post_format_gallery',
			'title' => __( 'Gallery Post Options', 'redthemesv-backend' ),
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => __( 'Gallery Images', 'redthemesv-backend' ),
					'id' => 'vw_post_format_gallery_images',
					'type' => 'image_advanced',
				),
			)
		);

		$meta_boxes[] = array(
			'id' => 'vw_post_format_audio',
			'title' => __( 'Audio Post Options', 'redthemesv-backend' ),
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => __( 'Sound Cloud Audio Source', 'redthemesv-backend' ),
					'id' => 'vw_post_format_audio_oembed',
					'type' => 'oembed',
					'desc' => 'Paste page URL from SoundCloud',
				),
			)
		);

		$meta_boxes[] = array(
			'id' => 'vw_post_format_video',
			'title' => __( 'Video Post Options', 'redthemesv-backend' ),
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => __( 'Video Source', 'redthemesv-backend' ),
					'id' => 'vw_post_format_video_oembed',
					'type' => 'oembed',
					'desc' => 'Paste page URL from YouTube, Vimeo.',
				),
			)
		);

		// Make sure there's no errors when the plugin is deactivated or during upgrade
		if ( class_exists( 'RW_Meta_Box' ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				new RW_Meta_Box( $meta_box );
			}
		}
	}
}

if ( ! function_exists( 'vw_get_registered_sidebars' ) ) {
	function vw_get_registered_sidebars() {
		$page_sidebars = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			$page_sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $page_sidebars;
	}
}