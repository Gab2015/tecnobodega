<?php
	
	define ('PW_PS_PL_URL_BOXES',plugins_url('', __FILE__));
	
	define ('PW_PS_PL_VER_NOTIC_BOXES','<div class="updated"><p>'.__("The", __PW_POST_LAYOUT_TEXTDOMAN__ ).' <strong>'.__("PW Box Post Layout for Visual Composer", __PW_POST_LAYOUT_TEXTDOMAN__ ).'</strong> '.__("plugin requires", __PW_POST_LAYOUT_TEXTDOMAN__ ).' <strong>'.__("Visual Composer", __PW_POST_LAYOUT_TEXTDOMAN__ ).'</strong> '.__("version 3.6.0 or greater", __PW_POST_LAYOUT_TEXTDOMAN__ ).'.</p></div>');
	
	if (!class_exists('VC_PW_POST_LAYOUT_BOXES')) {
		
		class VC_PW_POST_LAYOUT_BOXES extends WPBakeryShortCode {
			
			public function __construct() {			
				register_activation_hook( __FILE__ , array( $this, 'on_activation' ) );
				register_deactivation_hook( __FILE__ , array(  $this, 'on_deactivation' ) );
				$this->includes();
				add_filter( 'plugin_action_links_' . PW_PS_PL_BASENAME_BOXES , array( $this, 'action_links_woo_tabs' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'pw_register_css_js' ) );
				add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ) );				
			}
			
			
			function includes()
			{
				$required_vc = '3.6';
				if(defined('WPB_VC_VERSION')){
					if( version_compare( $required_vc, WPB_VC_VERSION, '>' )){
						add_action( 'admin_notices', array($this, 'pw_admin_notice_for_version'));
					}else
					{
						//require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
					}
				} 

				include_once( 'class/calss.php' );
				include_once( 'inc/function.php' );
				
				include_once( 'class/frontend-ui.php' );
								
			}
			
			function pw_admin_notice_for_version()
			{
				echo PW_PS_PL_VER_NOTIC_BOXES;	
			}

			public function loadTextDomain() {
				load_plugin_textdomain( __PW_POST_LAYOUT_TEXTDOMAN__ , false, basename( dirname( __FILE__ ) ) . '/languages/' );
			}	
						
			public function action_links_woo_tabs( $links ) {
				return array_merge( array(
					'<a target="_blank" href="' . esc_url( apply_filters( 'woocommerce_docs_url', 'http://proword.net/Vc_Post_Layout/documentation/Box_Post_Layout/', 'woocommerce' ) ) . '">' . __( 'Docs', __PW_POST_LAYOUT_TEXTDOMAN__ ) . '</a>',
		
				), $links );
			}	

			public function pw_register_css_js(){
				wp_enqueue_style('pw-pl-fontawesome-style',     PW_PS_PL_URL_BOXES . '/css/fontawesome/font-awesome.css', array() , null);
				wp_enqueue_style('pw-pl-framework-style',     PW_PS_PL_URL_BOXES . '/css/framework/bootstrap.css', array() , null);
				wp_enqueue_style('pw-pl-layouts-style',       PW_PS_PL_URL_BOXES . '/css/layouts/layouts.css', array() , null);
				wp_enqueue_style('pw-pl-responsive-style',        PW_PS_PL_URL_BOXES . '/css/responsive.css', array() , null);
				wp_enqueue_style('pw-pl-slider-style',       PW_PS_PL_URL_BOXES . '/css/slick-slider/jquery.bxslider.css', array() , null);
				wp_enqueue_style('pw-pl-lightbox-style',       PW_PS_PL_URL_BOXES . '/css/lightbox/lightbox.css', array() , null);
				
			
				wp_enqueue_script('jquery');
				wp_enqueue_script( 'pw-pl-slider-script',       PW_PS_PL_URL_BOXES . '/js/slick-slider/jquery.bxslider.js', array( 'jquery' ));
				wp_enqueue_script( 'pw-pl-lightbox-script',        PW_PS_PL_URL_BOXES . '/js/lightbox/lightbox-2.6.min.js', array( 'jquery' ));
				
			}
			
			
			public function on_deactivation(){
			}			

			public function on_activation() {
			}			
		}
	}	
	new VC_PW_POST_LAYOUT_BOXES;

?>