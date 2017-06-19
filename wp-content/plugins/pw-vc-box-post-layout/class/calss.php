<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('VCExtendAddonClass_BOXES')) {
	class VCExtendAddonClass_BOXES extends WPBakeryShortCode {
		
		function __construct() {
			//
			add_action( 'after_setup_theme', array( $this, 'createShortcodes' ), 5 );
			
			// We safely integrate with VC with this hook
			add_action( 'init', array( $this, 'integrateWithVC' ) );

			// Use this when creating a shortcode addon
			add_shortcode( 'pw_vc_box', array( $this, 'pw_vc_box' ) );
			
				
		}
	 
		public function integrateWithVC() {
			// Check if Visual Composer is installed
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				// Display notice that Visual Compser is required
				add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
				return;
			}
			
			add_shortcode_param('pw_number' , array($this, 'pw_number_settings_field' ) );
			add_shortcode_param('pw_image_radio',array($this,'pw_image_radio_settings_field'));
						
			//apply_filters( 'vc_shortcode_output',array($this,'vc_theme_after_vc_single_image'));
		}
		
		/*
		Add your Visual Composer logic here.
		Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.
	
		More info: http://kb.wpbakery.com/index.php?title=Vc_map
		*/

		// Function generate param type "number"
		function pw_number_settings_field($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';		   
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . '  " name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}		

		public function vc_theme_after_vc_single_image($atts, $content = null) {
		   return '<div><p>Append this div before shortcode</p></div>';
		}
		
		public function pw_image_radio_settings_field($settings, $value) {
			$param_line='';
			$dependency = vc_generate_dependencies_attributes($settings);

			$param_line = '<input name="'.$settings['param_name']
					 .'" class="wpb_vc_param_value wpb-textinput '
					 .$settings['param_name'].' '.$settings['type'].' '.$settings['class'].'" id="pw_box_type" type="hidden" value="'
					 .$value.'" ' . $dependency . '/>';
					 
			$current_value =  $value;
			$values = $settings['value'];
			foreach ( $values as $label => $v ) {
				$checked = ($v==$current_value) ? ' checked="checked"' : '';
				$param_line .= ' <input style="width: auto !important;" value="' . $v . '" class="pw_box_type_radio" name="mm" type="radio" '.$checked.'> ' . __($label, "js_composer");
			}
           $param_line.= '<script type="text/javascript">
							jQuery(document).ready(function(){								
								jQuery(".pw_box_type_radio").click(function(){
									jQuery("#pw_box_type").val(jQuery(this).val());									
								});
							});
						</script>';
			
			return $param_line;
		}

		public function pw_vc_box( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'pw_title'							  => '',
				'pw_query'							  => 'size:5|order_by:date|order:ASC|post_type:posts',				
				'pw_link_target'						=> 'slider',
				'pw_post_layout'						=> '',
				
				'pw_border_top_size'                    => '',
				'pw_border_top_type'                    => '',
				'pw_border_top_color'                   => '',
			
				'pw_border_right_size'                  => '',
				'pw_border_right_type'                  => '',
				'pw_border_right_color'                 => '',
				
				'pw_border_bottom_size'                 => '',
				'pw_border_bottom_type'                 => '',
				'pw_border_bottom_color'                => '',
				
				'pw_border_left_size'                   => '',
				'pw_border_left_type'                   => '',
				'pw_border_left_color'                  => '',
				
				'pw_item_border_size'                   => '',
				'pw_item_border_type'                   => '',
				'pw_item_border_color'                  => '',
				
				'pw_back_color'                      	 => '#ffffff',
				'pw_item_back_color'                    => '',
				'pw_item_height'                     	=> '',
				
				'pw_thumb_border_color'                 => '',
				
				'pw_link_color'                         => '',
				'pw_link_hover_color'                   => '',
				'pw_meta_color'                         => '',
				'pw_excerpt_color'                      => '',
				'pw_readmore_type'                      => '',
				
				'pw_box_carousel_item'                  => '',
				'pw_box_speed'                          => '',
				'pw_box_carousel_pre_view'              => '3',
				'pw_box_slider_hide_prev_next_buttons'  => 'no',
				'pw_box_slider_loop'                    => 'yes',
				
				'pw_grid_type'					      => 'pl-standard-grid',
				'pw_grid_desktop_columns_count'		 => 'pl-col-md-12',
				'pw_grid_tablet_columns_count'		  => 'pl-col-sm-12',
				'pw_grid_mobile_columns_count'		  => 'pl-col-xs-12',
				'pw_skin_type'			              => 'pl-gridskin-one',
				'pw_grid_skin_effect'				   => 'pl-gst-effect-1',
				'pw_grid_page_navigation'			   => '100%',
				'pw_grid_filter_by'					 => '',
				'pw_grid_order_by'					  => '',
				'pw_list_type'					      => '',
				'pw_marquee_type'					   => '',
				'pw_marquee_position'				   => '',
				'pw_marquee_height'				     => '',
				'pw_marquee_border_size'	     		=> '',
				'pw_marquee_border_radius'	     	  => '',
				'pw_marquee_border_type'	     		=> '',
				'pw_marquee_border_color'	     	   => '',
				'pw_marquee_direction'	     		  => '',
				'pw_marquee_title_fontsize'	     	 => '',
				'pw_marquee_title_width'	     	    => '',
				'pw_marquee_title_background'           => '', 
				'pw_marquee_content_background'         => '',
				'pw_marquee_content_fontsize'	       => '',
				'pw_marquee_content_showdate'	       => '',
				'pw_date_format'	      				=> 'D m',
				'pw_marquee_text_colour'			    => '',
				'pw_marquee_text_colour_hover'		  => '',
				'pw_text_align'				         => '',
				'pw_teasr_layout_img'				   => '',
				'pw_image_thumb_size'				   => 'medium',
				'pw_excerpt_length'				     => '20',
				'pw_carousel_pre_view'				  => '',
				'pw_image_effect'					   => '',
				'pw_icon_effect'		      	        => '',
				'pw_overlay'					        => '',
				'pw_box_type'						   => '',
				
				'pw_image_type'					     => '',
				'pw_image_carousel_item'			    => '',
				'pw_image_carousel_pre_view'		    => '',
				'pw_image_speed'					    => '1000',
				'pw_image_slider_hide_prev_next_buttons'=> 'no',
				'pw_image_slider_loop'				  => 'yes',
				'pw_image_columns_count'				=> '3',
				
				'pw_speed'							  => '2000',
				'pw_slider_caption_type'				=> '',
				'pw_slider_type'						=> '',
				'pw_slider_elastic_animation'		   => '',
				'pw_slider_hide_pagination_control'	 => 'no',
				'pw_slider_hide_prev_next_buttons'	  => 'no',
				'pw_slider_loop'					    => 'yes',
				'pw_hide_excerpt'					   => 'no',
				'pw_hide_readmore'					  => 'no',
				'pw_marquee_icon'					   => '',
				'pw_slider_overlay_background'          => '',
				'pw_slider_link_fontsize'       		   => '',
				'pw_slider_excerpt_fontsize'            => '',
				'pw_box_item_hide_excerpt'              => 'no',

			), $atts ) );
			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
			
			//global 
			$GLOBALS['output']="";
			
			$slider_class = new VC_PW_boxes(
				$pw_title,
				$pw_query,
				$pw_link_target,
				$pw_teasr_layout_img,
				$pw_image_thumb_size,
				$pw_excerpt_length,
				$pw_image_effect,
				$pw_icon_effect,
				
				$pw_box_type,
				$pw_border_top_size,
				$pw_border_top_type,
				$pw_border_top_color,
				
				$pw_border_right_size,
				$pw_border_right_type,
				$pw_border_right_color,
				
				$pw_border_bottom_size,
				$pw_border_bottom_type,
				$pw_border_bottom_color,
				
				$pw_border_left_size,
				$pw_border_left_type,
				$pw_border_left_color,
				
				$pw_item_border_size,
				$pw_item_border_type,
				$pw_item_border_color,
				
				$pw_back_color,
				$pw_item_back_color,
				
				$pw_thumb_border_color,
				
				$pw_link_color,
				$pw_link_hover_color,
				$pw_meta_color,
				$pw_excerpt_color,
				$pw_readmore_type,
				
				$pw_box_carousel_item,
				$pw_box_speed,
				$pw_box_carousel_pre_view,
				$pw_box_slider_hide_prev_next_buttons,
				$pw_box_slider_loop,
				$pw_date_format,
				$pw_box_item_hide_excerpt
				
			);
			
			return $GLOBALS['output'];
		}

		public function createShortcodes() {	

			require_once("admin-ui.php");						
		}
		
		public function excerpt($excerpt,$limit) {
			$excerpt = explode(' ', $excerpt, $limit);
			if (count($excerpt)>=$limit) {
				array_pop($excerpt);
				$excerpt = implode(" ",$excerpt).'...';
			} else {
				$excerpt = implode(" ",$excerpt);
			} 
			$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
			return $excerpt;
		}

	}
	// Finally initialize code
	$GLOBALS['VCExtendAddonClass_BOXES'] = new VCExtendAddonClass_BOXES;
}

?>