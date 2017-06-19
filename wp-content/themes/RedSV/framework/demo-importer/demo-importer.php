<?php

if ( ! function_exists( 'vwdemo_import_custom_sidebars' ) ) {
	function vwdemo_import_custom_sidebars() {
		echo '<p>Import custom sidebars</p>';
		$sidebar_data = file_get_contents( dirname( __FILE__ ) . '/demo-content/custom_sidebars.txt' );
		update_option( 'sbg_sidebars', unserialize($sidebar_data) );
	}

}

if ( ! function_exists( 'vwdemo_import_widgets' ) ) {
	function vwdemo_import_widgets() {
		if ( ! function_exists( 'wie_process_import_file' ) ) {
			require_once get_template_directory().'/framework/demo-importer/widget-importer-exporter/widgets.php';
			require_once get_template_directory().'/framework/demo-importer/widget-importer-exporter/import.php';
		}

		echo '<p>Import widgets</p>';
		wie_process_import_file( dirname( __FILE__ ) . '/demo-content/widgets.txt' );
	}
}

if ( ! function_exists( 'vwdemo_setup_menu' ) ) {
	function vwdemo_setup_menu() {
		$top_menu_slug = 'top-menu';
		$main_menu_slug = 'main-menu';

		$locations = get_theme_mod('nav_menu_locations');
		$all_menu = get_terms('nav_menu');

		foreach ( $all_menu as $menu_item ) {
			if ( $top_menu_slug == $menu_item->slug ) {
				$locations['top_navigation'] = $menu_item->term_id;
			}

			if ( $main_menu_slug == $menu_item->slug ) {
				$locations['main_navigation'] = $menu_item->term_id;
			}
		}

		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

if ( ! function_exists( 'vwdemo_setup_homepage' ) ) {
	function vwdemo_setup_homepage() {
		$front_page = get_page_by_title( 'Home' );
		if ( ! empty( $front_page ) )
			update_option( 'page_on_front', $front_page->ID );

		
		$blog_page = get_page_by_title( 'Blog' );
		if ( ! empty( $blog_page ) )
			update_option( 'page_for_posts', $blog_page->ID );

		update_option( 'show_on_front', 'page' );
	}
}

if ( ! function_exists( 'vwdemo_start_import' ) ) {
	function vwdemo_start_import() {
		define( 'WP_LOAD_IMPORTERS', true );
		require_once get_template_directory().'/framework/demo-importer/wordpress-importer/wordpress-importer.php';

		add_action( 'import_start', 'vwdemo_import_custom_sidebars', 91 );
		add_action( 'import_start', 'vwdemo_import_widgets', 92 );
		add_action( 'import_end', 'vwdemo_setup_menu' );
		add_action( 'import_end', 'vwdemo_setup_homepage' );

		$wp_import = new WP_Import();
		$file = get_template_directory().'/framework/demo-importer/demo-content/demo-content.xml';
		$wp_import->fetch_attachments = $wp_import->allow_fetch_attachments();
		$wp_import->import( $file );
		die();
	}
	add_action( 'wp_ajax_vwdemo_start_import', 'vwdemo_start_import' );
}

if ( ! function_exists( 'vwdemo_js' ) ) {
	function vwdemo_js( $hook_suffix ) {
		// var_dump($hook_suffix);
		if( $hook_suffix == 'appearance_page_redux_options' ) {
			wp_enqueue_script('jquery');
    		wp_enqueue_script('thickbox');
    		wp_enqueue_style('thickbox');

			add_action('admin_footer', 'vwdemo_footer_script');
		}
	}

	add_action('admin_enqueue_scripts', 'vwdemo_js');
}

if ( ! function_exists( 'vwdemo_footer_script' ) ) {
	function vwdemo_footer_script() {
		?>
		<script type="text/javascript">
		//<![CDATA[
		;(function( $, window, document, undefined ){
			$( ' <span>&nbsp;</span> <a id="vw_import_demo" class="thickbox button" title="Import Demo Content" href="/wp-admin/admin-ajax.php?action=vwdemo_start_import&amp;width=50%&amp;height=50%">Import Demo</a>' ).insertBefore( $( '#redux-opts-header .clear' ) );
			$( document ).ready( function ($) {
				// var template_directory = '<?php echo get_template_directory_uri() ?>';
				$( '#vw_import_demo' ).click( function( e ) {
					if ( ! confirm( 'Are you sure to import demo content? The existing content may be replaced' ) ) {
						e.stopPropagation();
						return false;
					}
				} )
			} );
		})( jQuery, window , document );
		//]]>
		</script>
		<?php
	}
}