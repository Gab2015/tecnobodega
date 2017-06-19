<?php
$vc_layout_sub_controls = array(
  array( 'link_post', __( 'Link to post', __PW_POST_LAYOUT_TEXTDOMAN__  ) ),
  array( 'no_link', __( 'No link', __PW_POST_LAYOUT_TEXTDOMAN__  ) ),
  array( 'link_image', __( 'Link to bigger image', __PW_POST_LAYOUT_TEXTDOMAN__  ) )
);

vc_map( array(
            "name" => __("PW Boxes", __PW_POST_LAYOUT_TEXTDOMAN__ ),
            "description" => __("Boxes Post Layout", __PW_POST_LAYOUT_TEXTDOMAN__ ),
            "base" => "pw_vc_box",
            "class" => "",
            "controls" => "full",
            "icon" => PW_PS_PL_URL_BOXES.'/assets/images/icons/box.png',
            "category" => __('PW Post Layout', __PW_POST_LAYOUT_TEXTDOMAN__ ),
            //'admin_enqueue_js' => array(plugins_url('vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
           // 'admin_enqueue_css' => array(plugins_url('/assets/css/icon-styles.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __("Title", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_title",
								"value" => '',
								"description" => __("Enter Title.", __PW_POST_LAYOUT_TEXTDOMAN__ )
							),
							array(
								'type' => 'loop',
								'heading' => __( 'Your Query', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'param_name' => 'pw_query',
								'settings' => array(
								  'size' => array( 'hidden' => false, 'value' => 10 ),
								  'order_by' => array( 'value' => 'date' ),
								),
								'description' => __( 'Create WordPress loop, to populate content from your site.', __PW_POST_LAYOUT_TEXTDOMAN__ )
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Link Target",__PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_link_target",
								"value" =>array( __( 'Same window', __PW_POST_LAYOUT_TEXTDOMAN__ ) => '_self', __( 'New window', __PW_POST_LAYOUT_TEXTDOMAN__ ) => "_blank"),
								"description" => __("Choose link target", __PW_POST_LAYOUT_TEXTDOMAN__ )
							),						
							

							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Excerpt/Content Length", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_excerpt_length",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter number of item per view.<strong>Recommended:</strong> Enter number small than post count", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								'type' => 'checkbox',
								'heading' => __( 'Hide Excerpt in items', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'param_name' => 'pw_box_item_hide_excerpt',
								'description' => __( 'If "YES" item Excerpt will be removed.', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'value' => array( __( 'Yes, please', __PW_POST_LAYOUT_TEXTDOMAN__ ) => 'yes' ),
								"holder" => "div",
							),
							
							array(
								'type' => 'textfield',
								'heading' => __( 'Thumbnail size', 'js_composer' ),
								'param_name' => 'pw_image_thumb_size',
								'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __("Date Format", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_date_format",
								"value" => '',
								"description" => __("Enter Date Format.Show More Info <a href='http://codex.wordpress.org/Formatting_Date_and_Time' target='_new'>Here</a>", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Image Effect", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_image_effect",
								"value" =>array(
									__("None", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"none",
									__("Zoom In", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"zoomin-eff",
									__("Zoom Out", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"zoomout-eff",
									__("Rotate Right", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"roundright-eff"
									),
								"description" => __("Choose image effect", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Icon Effect", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_icon_effect",
								"value" =>array(
									__("None", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"none",
									__("Dropdown", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"pl-dropup",
									__("DropUp", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"pl-dropdown",
									__("Scale", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"pl-scale-eff"
									),
								"description" => __("Choose icon effect", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							
							array(
								"type" => "pw_image_radio",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Type"),
								"param_name" => "pw_box_type",
								"value" =>array(
									"<img src='".PW_PS_PL_URL_BOXES.'/assets/images/layout1.png'."' />"=>"layout1",
									"<img src='".PW_PS_PL_URL_BOXES.'/assets/images/layout2.png'."' />"=>"layout2",
									"<img src='".PW_PS_PL_URL_BOXES.'/assets/images/layout3.png'."' />"=>"layout3"),
								"description" => __("Choose Box Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),

							array(
								'type' => 'checkbox',
								"heading" => __("Display Item in Carousel Mode", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_box_carousel_item",
								'description' => __( 'If YES item will be diplay in carousel mode.', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'value' => array( __( 'Yes, please', __PW_POST_LAYOUT_TEXTDOMAN__ ) => 'yes' ),
								"holder" => "div",
							),
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Item Per View", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_box_carousel_pre_view",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter number of item per view.<strong>Recommended:</strong> Enter number small than post count", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'dependency' => array(
									'element' => 'pw_box_carousel_item',
									'value' => array( 'yes' )
								)									
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Speed", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_box_speed",
								"value" =>array(
									__("1 Second", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"1000",
									__("2 Seconds", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"2000",
									__("3 Seconds", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"3000",
									__("4 Seconds", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"4000",
									__("5 Seconds", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"5000"
									),
								"description" => __("Enter speed for Carousel", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'dependency' => array(
									'element' => 'pw_box_carousel_item',
									'value' => array( 'yes' )
								),
							),
							array(
								'type' => 'checkbox',
								'heading' => __( 'Hide prev/next buttons', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'param_name' => 'pw_box_slider_hide_prev_next_buttons',
								'description' => __( 'If "YES" prev/next control will be removed.', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'value' => array( __( 'Yes, please', __PW_POST_LAYOUT_TEXTDOMAN__ ) => 'yes' ),
								"holder" => "div",
								'dependency' => array(
									'element' => 'pw_box_carousel_item',
									'value' => array( 'yes' )
								),
							),
							array(
								'type' => 'checkbox',
								'heading' => __( 'Slider loop', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'param_name' => 'pw_box_slider_loop',
								'description' => __( 'Enables loop mode.', __PW_POST_LAYOUT_TEXTDOMAN__ ),
								'value' => array( __( 'Yes, please', __PW_POST_LAYOUT_TEXTDOMAN__ ) => 'yes' ),
								"holder" => "div",
								'dependency' => array(
									'element' => 'pw_box_carousel_item',
									'value' => array( 'yes' )
								),
							),
							
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Border Top Size", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_top_size",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter Border Top Size for box", __PW_POST_LAYOUT_TEXTDOMAN__ ),									
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Top Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_top_type",
								"value" =>array(
									__("Solid", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"solid",
									__("Dashed", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dashed",
									__("Dotted", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dotted",
									__("Double", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"double"),
								"description" => __("Choose Border Top Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Top Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_top_color",
								"value" => '',
								"description" => __("Choose Border Top Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Border Right Size", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_right_size",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter Border Right Size for box", __PW_POST_LAYOUT_TEXTDOMAN__ ),									
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Right Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_right_type",
								"value" =>array(
									__("Solid", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"solid",
									__("Dashed", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dashed",
									__("Dotted", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dotted",
									__("Double", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"double"
									),
								"description" => __("Choose Border Right Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Right Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_right_color",
								"value" => '',
								"description" => __("Choose Border Right Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),							
							),	
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Border Bottom Size", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_bottom_size",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter Border Bottom Sizefor box", __PW_POST_LAYOUT_TEXTDOMAN__ ),									
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Bottom Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_bottom_type",
								"value" =>array(
									__("Solid", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"solid",
									__("Dashed", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dashed",
									__("Dotted", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dotted",
									__("Double", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"double"
									),
								"description" => __("Choose Bottom Top Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Bottom Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_bottom_color",
								"value" => '',
								"description" => __("Choose Border Bottom Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Border Left Size", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_left_size",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter Border Left Size for box", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Left Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_left_type",
								"value" =>array(
									__("Solid", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"solid",
									__("Dashed", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dashed",
									__("Dotted", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dotted",
									__("Double", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"double"
									),
								"description" => __("Choose Border Left Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Left Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_border_left_color",
								"value" => '',
								"description" => __("Choose Border Left Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "pw_number",
								"holder" => "div",
								"class" => "",
								"heading" => __("Box Item Border Size", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_item_border_size",
								"value" => '',
								"suffix" =>"",
								"min"=>"0",
								"description" => __("Enter Item Border Size for box`s items", __PW_POST_LAYOUT_TEXTDOMAN__ ),									
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Border Item Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_item_border_type",
								"value" =>array(
									__("Solid", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"solid",
									__("Dashed", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dashed",
									__("Dotted", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"dotted",
									__("Double", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"double"
									),
								"description" => __("Choose Border Item Type for box`s items", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Item Border Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_item_border_color",
								"value" => '',
								"description" => __("Choose Item Border Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Backgroud Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_back_color",
								"value" => '',
								"description" => __("Choose Background Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Item Background Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_item_back_color",
								"value" => '',
								"description" => __("Choose Item Background Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),			
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Thumbnail Border Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_thumb_border_color",
								"value" => '',
								"description" => __("Choose Thumbnail Border Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Link Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_link_color",
								"value" => '',
								"description" => __("Choose Link Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),							
							),	
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Link Hover Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_link_hover_color",
								"value" => '',
								"description" => __("Choose Link Hover Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Meta Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_meta_color",
								"value" => '',
								"description" => __("Choose Meta Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => __("Excerpt Color", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_excerpt_color",
								"value" => '',
								"description" => __("Choose Excerpt Color.Leave blank to ignore", __PW_POST_LAYOUT_TEXTDOMAN__ ),								
							),	
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "",
								"heading" => __("Read More Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
								"param_name" => "pw_readmore_type",
								"value" =>array(
									__("Type 1", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"pl-permalink",
									__("Type 2", __PW_POST_LAYOUT_TEXTDOMAN__ )=>"pl-permalink-t2"
									),
								"description" => __("Choose Read More Type", __PW_POST_LAYOUT_TEXTDOMAN__ ),
							),

						)
			) );
?>