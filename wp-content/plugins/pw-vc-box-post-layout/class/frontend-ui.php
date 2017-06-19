<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('VC_PW_boxes')) {
	class VC_PW_boxes extends WPBakeryShortCode_VC_Posts_Grid {
		public  $pw_title,
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
				$pw_box_item_hide_excerpt,
				$pw_box_id;
				
				
		function __construct($pw_title,
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
						$pw_box_item_hide_excerpt) {
			$this->pw_title=$pw_title;
			$this->pw_query=$pw_query;
			$this->pw_link_target=$pw_link_target;
			$this->pw_teasr_layout_img=$pw_teasr_layout_img;
			$this->pw_image_thumb_size=$pw_image_thumb_size;
			$this->pw_excerpt_length=$pw_excerpt_length;
			$this->pw_image_effect=$pw_image_effect;
			$this->pw_icon_effect=$pw_icon_effect;
			$this->pw_box_type=$pw_box_type;
			$this->pw_border_top_size = $pw_border_top_size;
			$this->pw_border_top_type = $pw_border_top_type;
			$this->pw_border_top_color = $pw_border_top_color;
			
			$this->pw_border_right_size = $pw_border_right_size;
			$this->pw_border_right_type = $pw_border_right_type;
			$this->pw_border_right_color = $pw_border_right_color;
			
			$this->pw_border_bottom_size = $pw_border_bottom_size;
			$this->pw_border_bottom_type = $pw_border_bottom_type;
			$this->pw_border_bottom_color = $pw_border_bottom_color;
			
			$this->pw_border_left_size = $pw_border_left_size;
			$this->pw_border_left_type = $pw_border_left_type;
			$this->pw_border_left_color = $pw_border_left_color;
			
			$this->pw_item_border_size = $pw_item_border_size;
			$this->pw_item_border_type = $pw_item_border_type;
			$this->pw_item_border_color = $pw_item_border_color;
			
			$this->pw_back_color = $pw_back_color;
			$this->pw_item_back_color = $pw_item_back_color;
			
			$this->pw_thumb_border_color = $pw_thumb_border_color;
			
			$this->pw_link_color = $pw_link_color;
			$this->pw_link_hover_color = $pw_link_hover_color;
			$this->pw_meta_color = $pw_meta_color;
			$this->pw_excerpt_color = $pw_excerpt_color;
			$this->pw_readmore_type = $pw_readmore_type;
			
			$this->pw_box_carousel_item = $pw_box_carousel_item;
			$this->pw_box_speed = $pw_box_speed;
			$this->pw_box_carousel_pre_view = $pw_box_carousel_pre_view;
			$this->pw_box_slider_hide_prev_next_buttons = $pw_box_slider_hide_prev_next_buttons;
			$this->pw_box_slider_loop = $pw_box_slider_loop;
			$this->pw_date_format=$pw_date_format;
			$this->pw_box_item_hide_excerpt=$pw_box_item_hide_excerpt;
			
			$this->pw_front_end();
			
			$this->pl_box_custom_color();
			
			
			//add_action('wp_enqueue_scripts',array( $this, 'pl_custom_color' ));
			
		}
		
		function pw_front_end()
		{
			global $VCExtendAddonClass_BOXES,$output;
			$this->pw_box_id = rand(0,1000);
			$loop=$this->pw_query;
			$grid_link = $grid_layout_mode = $title = $filter= '';
			$posts = array();
			if(empty($loop)) return;
			$this->getLoop($loop);
			$my_query = $this->query;
			$args = $this->loop_args;
			$img_id=array();
			$output = '';
			$post_counter = 0;
			$img_counter = 0;
			$rand_id = rand(6000,7000);
			$output .= '<h2 class="pl-itemtitle">'.$this->pw_title.'</h2>';
			$output .= '<div class="pl-boxlayout '. $this->pw_box_type .'" id="pl_box_id_'.$this->pw_box_id.'" >';
			while ( $my_query->have_posts() ) {
				$my_query->the_post(); // Get post from query
				$post_counter++;
				$post = new stdClass(); // Creating post object.
				$post->id = get_the_ID();
				$post->link = get_permalink($post->id);
				
				$img_id[]=get_post_meta( $post->id , '_thumbnail_id' ,true );
				
				$post_thumbnail = wpb_getImageBySize(array( 'post_id' => $post->id, 'thumb_size' => $this->pw_image_thumb_size ));
				$current_img_large = $post_thumbnail['thumbnail'];
				$current_img_full = wp_get_attachment_image_src( $img_id[$img_counter++] , 'full' );
				
				
				$post_type = get_post_type( $post->id );
				$post_taxonomies = get_object_taxonomies($post_type);
				$tax_counter = 0;
				
				if ($this->pw_box_type=='layout1'){
					if ($post_counter==1){
						$output .= '
						<div class="pl-list-t2 pl-boxlayout-fitem">
							<div class="pl-itemcnt">
								<div class="pl-thumbcnt '. $this->pw_image_effect .'">
									'.$current_img_large.'
									<div class="pl-overally fadein-eff">
										 <a href="'. $current_img_full[0] .'"  class="pl-zoom-icon pl-not-alone '. $this->pw_icon_effect .'  example-image" data-lightbox="image-set" ></a>
										 <a href="'. $post->link .'" target="'. $this->pw_link_target .'" class="pl-link-icon pl-not-alone '. $this->pw_icon_effect .'" target="'. $this->pw_link_target .'" ></a>                                   
									</div>	
								</div>
							</div>		
							<div class="pl-detailcnt">
								<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
								
								$output .= pw_get_post_meta($post->id , $post_taxonomies);
								$output .= '<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>
								<div class="pl-postcomment"><a href="'. get_comments_link() .'" ><i class="fa fa-comments"></i>'.get_comments_number( '0', '1', '% responses' ) .'</a></div>
								<a class="'.$this->pw_readmore_type.'" href="'. $post->link .'" target="'. $this->pw_link_target .'" >'.__('Read More',__PW_POST_LAYOUT_TEXTDOMAN__ ).'<i class="fa fa-angle-right"></i></a>
							</div>
						</div>';
					}//if $post_counter == 1
					
					if ( $post_counter == 2 ){
						$output .= '<div class="layout-1-oitems "  >';
							if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<ul class="pl-bxslider pl-box-car" id="boxcar-'.$rand_id.'" >';
					}
					
					if ($post_counter >= 2)	{
						if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<li><div>';
					
						$output .= '
							<div class="pl-list-t1 pl-boxlayout-oitem">
								<div class="pl-col-xs-4 pl-col-md-4">
									<div class="pl-itemcnt">
										<div class="pl-thumbcnt '. $this->pw_image_effect .'">
											'.$current_img_large.'
											<div class="pl-overally fadein-eff">
												 <a href="'. $post->link .'" class="pl-link-icon '. $this->pw_icon_effect .'" target="'. $this->pw_link_target .'" ></a>                                   
											</div>	
										</div>
									</div>	
								</div>
								<div class="pl-col-xs-8">
									<div class="pl-detailcnt">
										<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
										$output .= pw_get_post_meta($post->id , $post_taxonomies);
										if ($this->pw_box_item_hide_excerpt!='yes')
											$output .= '<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>';
								$output .=	'
									</div>
								</div>
							</div>';
							if ($this->pw_box_carousel_item == 'yes')	
								$output .= '</div></li>';
					
					}//end if >=2
					
				}//if $this->pw_box_type=='layout1'
				
				else if ($this->pw_box_type=='layout2'){
					if ($post_counter==1){
						$output .= '
						<div class="pl-list-t1 pl-boxlayout-fitem">
							<div class="pl-col-xs-12 pl-col-sm-5 pl-col-md-5 ">
								<div class="pl-itemcnt">
									<div class="pl-thumbcnt '. $this->pw_image_effect .'">
										'.$current_img_large.'
										<div class="pl-overally fadein-eff">
											 <a href="'. $current_img_full[0] .'" class="pl-zoom-icon pl-not-alone '. $this->pw_icon_effect .'  example-image" data-lightbox="image-set" ></a>
											 <a href="'. $post->link .'" target="'. $this->pw_link_target .'" class="pl-link-icon pl-not-alone '. $this->pw_icon_effect .'" target="'. $this->pw_link_target .'" ></a>                                   
										</div>	
									</div>
								</div>
							</div>		
							<div class=" pl-col-xs-12 pl-col-sm-7 pl-col-md-7">
								<div class="pl-detailcnt">
									<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
								$output .= pw_get_post_meta($post->id , $post_taxonomies);	
								$output .='
									<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>
									<div class="pl-postcomment"><a href="'. get_comments_link() .'" ><i class="fa fa-comments"></i>'.get_comments_number( '0', '1', '% responses' ) .'</a></div>
									<a class="'.$this->pw_readmore_type.'" href="'. $post->link .'" target="'. $this->pw_link_target .'" >'.__('Read More',__PW_POST_LAYOUT_TEXTDOMAN__ ).'<i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>';
					}//if $post_counter == 1
					
					if ( $post_counter == 2 ){
						$output .= '<div class="layout-2-oitems" >';
						if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<ul class="pl-bxslider pl-box-car" id="boxcar-'.$rand_id.'" >';
					}
					
					if ($post_counter >= 2)	{
						if (($post_counter%2) == 0){
							if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<li><div>';
							$output .= '<div class="pl-boxlayout-twiceitem ">';
						}
						$output .= '
							<div class="pl-col-xs-12 pl-col-sm-12 pl-col-md-6  pl-list-t1 ">
								<div class="pl-col-xs-4 pl-col-md-4">
									<div class="pl-itemcnt">
										<div class="pl-thumbcnt '. $this->pw_image_effect .'">
											'.$current_img_large.'
											<div class="pl-overally fadein-eff">
												 <a href="'. $post->link .'" class="pl-link-icon '. $this->pw_icon_effect .'" target="'. $this->pw_link_target .'" ></a>                                   
											</div>	
										</div>
									</div>	
								</div>
								<div class="pl-col-xs-8">
									<div class="pl-detailcnt">
										<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
								$output .= pw_get_post_meta($post->id , $post_taxonomies);
								if ($this->pw_box_item_hide_excerpt!='yes')
											$output .= '<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>';
								$output .='
									</div>
								</div>
							</div>';
						if (($post_counter%2) == 1){
							$output .= '</div>';//end twice-item
							if ($this->pw_box_carousel_item == 'yes')	
								$output .= '</div></li>';
						}
					}//end if >=2
					
				}//if $this->pw_box_type=='layout2'
				
				else if ($this->pw_box_type=='layout3'){
					if ($post_counter==1){
						$output .= '
						<div class="pl-col-xs-12 pl-col-sm-12 pl-col-md-6 pl-layout3-fitem">
							<div class="pl-blogcnt pl-list-t2">
								<div class="pl-itemcnt">
									<div class="pl-thumbcnt '. $this->pw_image_effect .'">
										'.$current_img_large.'
										<div class="pl-overally fadein-eff">
											 <a href="'. $current_img_full[0] .'" class="pl-zoom-icon pl-not-alone '. $this->pw_icon_effect .'  example-image" data-lightbox="image-set" ></a>
											 <a href="'. $post->link .'" target="'. $this->pw_link_target .'"  class="pl-link-icon pl-not-alone '. $this->pw_icon_effect .'" ></a>                                   
										</div>	
									</div>
								</div>		
								<div class="pl-detailcnt">
									<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
									$output .= pw_get_post_meta($post->id , $post_taxonomies);
									$output .= '<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>
									<div class="pl-postcomment"><a href="'. get_comments_link() .'" ><i class="fa fa-comments"></i>'.get_comments_number( '0', '1', '% responses' ) .'</a></div>
									<a class="'.$this->pw_readmore_type.'" href="'. $post->link .'" target="'. $this->pw_link_target .'" >'.__('Read More',__PW_POST_LAYOUT_TEXTDOMAN__ ).'<i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>';
					}//if $post_counter == 1
					
					if ( $post_counter == 2 ){
						$output .= '<div class="pl-col-xs-12 pl-col-sm-12 pl-col-md-6 pl-layout3-oitem" >';
						if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<ul class="pl-bxslider pl-box-car"  id="boxcar-'.$rand_id.'" >';
					}
					if ($post_counter >= 2)	{
						if ($this->pw_box_carousel_item == 'yes')	
								$output .= '<li><div>';
					
						$output .= '
							<div class="pl-list-t1 pl-boxlayout-oitem" >
								<div class="pl-col-xs-4 pl-col-md-4">
									<div class="pl-itemcnt">
										<div class="pl-thumbcnt '. $this->pw_image_effect .'">
											'.$current_img_large.'
											<div class="pl-overally fadein-eff">
												 <a href="'. $post->link .'" class="pl-link-icon  '. $this->pw_icon_effect .'" target="'. $this->pw_link_target .'" ></a>                                   
											</div>	
										</div>
									</div>	
								</div>
								<div class="pl-col-xs-8">
									<div class="pl-detailcnt">
										<h4 class="pl-title left-txt"><span class="pl-date">'. get_the_date($this->pw_date_format).'</span><a href="'. $post->link .'" target="'. $this->pw_link_target .'" >'. get_the_title() .'</a></h4>';
									$output .= pw_get_post_meta($post->id , $post_taxonomies);	
									if ($this->pw_box_item_hide_excerpt!='yes')
											$output .= '<p class="pl-text left-txt">'. $VCExtendAddonClass_BOXES->excerpt(get_the_excerpt(),$this->pw_excerpt_length).' </p>';
									$output .='
									</div>
								</div>
							</div>';
						if ($this->pw_box_carousel_item == 'yes')	
								$output .= '</div></li>';
					
					}//end if >=2
					
				}//if $this->pw_box_type=='type1'
				
				
				
			}
			//in layout2 if count of post is odd must have an additionall </div> 
			if (($this->pw_box_type=='layout2') && ($post_counter%2 == 0)){
				$output .= '</div>';
				if ($this->pw_box_carousel_item == 'yes')	
					$output .= '</div></li>';
			}
			
			if ($this->pw_box_carousel_item == 'yes')	{
				$output .= '</ul>';
			}
			if ($post_counter!=1)
				$output .='</div>';
			$output .= '</div>';//end div.pl-boxlayout
			wp_reset_query();
			$output .="<script type='text/javascript'>
                jQuery(document).ready(function() {
                     slider" . $rand_id ." =
					 jQuery('#boxcar-" . $rand_id ."').bxSlider({ 
						  mode : 'vertical',
						  touchEnabled : true ,
						  adaptiveHeight : true ,
						  slideMargin : 10 , 
						  wrapperClass : 'pl-bx-wrapper pl-box-car' ,
						  infiniteLoop:".($this->pw_box_slider_loop=='yes'?'true':'false') .",
						  pager:false,
						  controls:".($this->pw_box_slider_hide_prev_next_buttons=='yes'?'false':'true').",
						  minSlides: ". $this->pw_box_carousel_pre_view.",
						  moveSlides: 1,
						  auto: true,
						  pause : ". $this->pw_box_speed."	,
						  autoHover  : true , 
 						  autoStart: true
					 });
					 jQuery('.pl-bx-wrapper .pl-bx-controls-direction a').click(function(){
						  slider" . $rand_id .".startAuto();
					 });
                });	
            </script>";
			
			
		}
			
		function pl_box_custom_color() {
			
			wp_enqueue_style('pw-pl-custom-style', PW_PS_PL_URL_BOXES . '/css/custom.css', array() , null); 
			
			$box_border_top = $this->pw_border_top_size.'px '. $this->pw_border_top_type . ' ' . $this->pw_border_top_color;
			$box_border_right = $this->pw_border_right_size.'px '. $this->pw_border_right_type . ' ' . $this->pw_border_right_color;
			$box_border_bottom = $this->pw_border_bottom_size.'px '. $this->pw_border_bottom_type . ' ' . $this->pw_border_bottom_color;
			$box_border_left = $this->pw_border_left_size.'px '. $this->pw_border_left_type . ' ' . $this->pw_border_left_color;
			
			$box_back_color = $this->pw_back_color;
			$item_border = $this->pw_item_border_size.'px '. $this->pw_item_border_type . ' ' . $this->pw_item_border_color;
			$item_back_color = $this->pw_item_back_color;
			$thumb_border = $this->pw_thumb_border_color;
			$link_color = $this->pw_link_color;
			$link_hover_color = $this->pw_link_hover_color;
			$meta_color = $this->pw_meta_color;
			$excerpt_color = $this->pw_excerpt_color;
			
			$custom_css = '
				#pl_box_id_'.$this->pw_box_id.'{ 
					border-top: '. $box_border_top .';
					border-right: '. $box_border_right .';
					border-bottom: '. $box_border_bottom .';
					border-left: '. $box_border_left .';
					
					background : '.$box_back_color.';
				}
				#pl_box_id_'.$this->pw_box_id.' .pl-blogcnt{
					background : '.$box_back_color.';
				}
				#pl_box_id_'.$this->pw_box_id.' .layout-1-oitems , #pl_box_id_'.$this->pw_box_id.' .layout-2-oitems , #pl_box_id_'.$this->pw_box_id.' .pl-layout3-oitem  {
					background : '.$item_back_color.';
				}
				
				#pl_box_id_'.$this->pw_box_id.' .pl-itemcnt {
					border-color: '.$thumb_border.';
				}
				#pl_box_id_'.$this->pw_box_id.' .pl-title a , #pl_box_id_'.$this->pw_box_id.' .pl-detailcnt .pl-permalink-t2 {
					color : '.$link_color.';
				} 
					#pl_box_id_'.$this->pw_box_id.' .pl-title a:hover ,  #pl_box_id_'.$this->pw_box_id.' .pl-detailcnt .pl-permalink-t2:hover , #pl_box_id_'.$this->pw_box_id.' .pl-permalink:hover , #pl_box_id_'.$this->pw_box_id.' .pl-postcomment a:hover  {
						color : '.$link_hover_color.';
					} 
				#pl_box_id_'.$this->pw_box_id.' .pl-title .pl-date , #pl_box_id_'.$this->pw_box_id.' .pl-permalink  {
					background : '.$link_hover_color.';
				} 
				#pl_box_id_'.$this->pw_box_id.' .pl-postmeta , #pl_box_id_'.$this->pw_box_id.' .pl-postmeta a ,  #pl_box_id_'.$this->pw_box_id.' .pl-postcomment a{
					color : '.$meta_color.';
				}
				#pl_box_id_'.$this->pw_box_id.' .pl-postmeta a:hover   { 
					background:'.$link_hover_color.'; 
					color:#fff;
				}
				#pl_box_id_'.$this->pw_box_id.' .pl-permalink{ 
					border:1px solid '.$link_hover_color.' ;
				}
				#pl_box_id_'.$this->pw_box_id.'  li , #pl_box_id_'.$this->pw_box_id.'  li ,#pl_box_id_'.$this->pw_box_id.'  li ,#pl_box_id_'.$this->pw_box_id.' .pl-layout3-oitem > .pl-boxlayout-oitem , #pl_box_id_'.$this->pw_box_id.' .layout-2-oitems > .pl-boxlayout-twiceitem , #pl_box_id_'.$this->pw_box_id.' .layout-1-oitems > .pl-boxlayout-oitem , #pl_box_id_'.$this->pw_box_id.'.layout1 .pl-boxlayout-fitem  { 
					border-bottom : '.$item_border.';
				}
				#pl_box_id_'.$this->pw_box_id.' .layout-2-oitems { 
					border-top: '. $this->pw_item_border_color .';
				}
				 
				#pl_box_id_'.$this->pw_box_id.' .pl-layout3-oitem:before{ 
					background:'.$this->pw_item_border_color.'; 
				}
				#pl_box_id_'.$this->pw_box_id.' .pl-text{
					color : '.$excerpt_color.';
				}
				';
			
			wp_add_inline_style( 'pw-pl-custom-style', $custom_css );
			
		}
		
	}	
}
?>
