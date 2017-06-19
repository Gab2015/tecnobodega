<?php
class smartBreadcrumbsFrontpage {

    public $options; // array containing the optionsions
    private $smartBreadcrumbs;
    public $curr_style;

    function __construct() {
        // plugin class
        $this->smartBreadcrumbs = $GLOBALS['smartBreadcrumbs_plugin'];
        
        $this->options = array(
            'url_home' => home_url("/"),
            'link_current_item' => $this->smartBreadcrumbs->get_option('_config_' . 'link_current_item'),
            'posttitle_maxlen' => $this->smartBreadcrumbs->get_option('_config_' . 'posttitle_maxlen'),
            'singleblogpost_category_display' => $this->smartBreadcrumbs->get_option('_config_' . 'singleblogpost_category_display')
        ); 
        foreach ($this->options  as $key => $value){
            if($value == 'true'){
                $this->options[$key] = true;
            }
            if($value == 'false'){
                $this->options[$key] = false;
            }
        }
    }

    function display() {
		global $wpdb, $post, $wp_query;
	
		/* -------- CURRENT ITEM -------- */
		$curitem_urlprefix = '';
		$curitem_urlsuffix = '';
		if ($this->options['link_current_item']) {
			$curitem_urlprefix = '<li><a title="' . $this->options['current_item_urltitle'] . '" href="' . $_SERVER['REQUEST_URI'] . '">';
			$curitem_urlsuffix = '</a></li>';
		}
		
		if ( is_search() ) 								$swg_type = 'search';		// Search
		elseif ( is_page() ) 							$swg_type = 'page';			// Page
        elseif ( is_home() ) 							$swg_type = 'home';			// Home
		elseif ( is_single() )							$swg_type = 'singlepost';	// Single post page
		elseif ( is_archive() && is_category() )		$swg_type = 'categories';	// Weblog Categories
		elseif ( is_archive() && !is_category() )		$swg_type = 'blogarchive';	// Weblog Archive
		elseif ( is_404() )								$swg_type = '404';			// 404
		else											$swg_type = 'else';			// Everything else (should be weblog article list only)
	
	
		/* *************************************************
			Here we set the initial array $result_array. We use this for being able
			to apply styles, anchors etc. to each element.
			Default is set to false.
		************************************************* */
		$result_array = array(
			'middle' => false,	// The part between "Home" and the last element of the breadcrumb.
			'last' => array(	// The last element of the breadcrumb
					'prefix' => false,	// prefix
					'title' => false,	// text
					'suffix' => false	// suffix
				  ) 
			);
	
	
		switch ($swg_type) {
	
		case 'page':
			$bcn_pagetitle = trim(wp_title('', false));	// page title
			$bcn_theparentid = $post->post_parent;	// id of the parent page
			
			$bcn_loopcount = 0;	// counter for the array
			while( 0 != $bcn_theparentid ) {
				// Get the row of the parent's page;
				// 	*** Regarding performance this is not a perfect solution since this query is inside a loop ! ***
				//		However, the number of queries is reduced to the number of parents.
				$mylink = $wpdb->get_row("SELECT post_title, post_parent FROM $wpdb->posts WHERE ID = '$bcn_theparentid;'");
	
				// Title of parent into array incl. current permalink (via $bcn_theparentid, 
				// since we set this variable below we can use it here as current id!)
				$bcn_titlearray[$bcn_loopcount] = '<li><a href="' . get_permalink($bcn_theparentid) . '" title="' . $mylink->post_title. '">' . $mylink->post_title . '</a></li>';
	
				// New parent ID of parent
				$bcn_theparentid = $mylink->post_parent;
	
				$bcn_loopcount++;	
			}	// while
	
			if (is_array($bcn_titlearray)) {
				// Reverse the array since it is in a reverse order 
				$bcn_titlearray = array_reverse($bcn_titlearray);
		
				// Prepare the output by looping thru the array. We use $sep for not adding the separator before the first element
				$count = 0;
				foreach ($bcn_titlearray as $val) {
					$sep = '';
					if (0 != $count)
						$sep = $this->options['separator'];

					$page_result = $page_result . $sep . $val;
					
					$count++;
				}
			}

			// Result			
			// If we have a front page named 'Home' (or similar), we do not want to display the Breadcrumb like this: Home / Home
			// Therefore do not display the Home Link if such certain page is being displayed.
			if( strtolower($bcn_pagetitle) != strtolower($this->options['title_home']) ) {  // Check if we are not on home
				if ($page_result != '') $result_array['middle'] = $page_result;
				$result_array['last']['title'] = "<li>" . $bcn_pagetitle . "</li>";
			}
	
			break; // end of case 'page'
	
		case 'search':
			$result_array['last']['title'] =  "<li>" . htmlentities($_REQUEST['s']) . "</li>";
			break; // end of case 'search'
		case 'singlepost':
			$bcn_pagetitle = trim(wp_title('', false));
			$result_array['middle'] = $bcn_bloglink;

			// Add category
			if($this->options['singleblogpost_category_display'] === true) {
                $categories = get_the_category();
                if(count($categories) > 0){
                    foreach ($categories  as $key => $value){
                        $result_array['middle'] .= "<li><a href='".(get_category_link($value->term_id))."'>".($value->cat_name)."</a></li>";
                    }
                }
            }
            
			// Restrict the length of the title... 
			$bcn_post_title = $bcn_pagetitle;
			if ( ($this->options['posttitle_maxlen'] >= 1) and ( strlen($bcn_post_title) > $this->options['posttitle_maxlen']) )  
				$bcn_post_title = substr($bcn_post_title, 0, $this->options['posttitle_maxlen']-1) . '...';
			$result_array['last']['title'] = "<li>" . $bcn_post_title . "</li>";

			break;
	
		case 'categories':
			$result_array['middle'] = $bcn_bloglink;
			$object = $wp_query->get_queried_object();
			// Get parents of current category
			$parent_id  = $object->category_parent;
			$cat_breadcrumbs = '';
			while ($parent_id) {
				$category   = get_category($parent_id);
				$cat_breadcrumbs = '<li><a href="' . get_category_link($category->cat_ID) . '" title="' . $category->cat_name . '">' . $category->cat_name . '</a></li>' . $cat_breadcrumbs;
				$parent_id  = $category->category_parent;
			}

			// Current Category 
			$result_array['last']['title'] = "<li>" . $object->cat_name . "</li>";
			break;

	
		case 'blogarchive':
			$result_array['middle'] = "<li>" . $bcn_bloglink . "</li>";
	
			if (is_day()) {
				// -- Archive by day
				$result_array['last']['title'] = "<li>" . get_the_time('d') . '. ' . get_the_time('F') . ' ' . get_the_time('Y'). "</li>";

			} elseif (is_month()) {
				// -- Archive by month
				$result_array['last']['title'] = "<li>" . get_the_time('F') . ' ' . get_the_time('Y'). "</li>";
			} else if (is_year()) {
				// -- Archive by year
				$result_array['last']['title'] = "<li>" . get_the_time('Y'). "</li>";
			}
	
			break;
	
		case '404':
			$result_array['last']['title'] = "<li>404</li>";
			break;
        case 'home':
			break;
		case 'else':
			$result_array['last']['title'] = "<li>Home</li>";

		} // end switch



		// echo the result

		//		get middle part and add separator(s)
		$middle_part = '';		
		if ($result_array['middle'] === false) {
			// there is no middle part...
		
			if ($result_array['last']['title'] === false)
				$first_sep = ''; // we are on home.

		} else {
			// There is a middle part...
			$middle_part = $result_array['middle'] . $this->options['separator'];
		}


		// LAST PART
		$last_part = '';
		if ($result_array['last']['prefix'] !== false)
			$last_part .= $result_array['last']['prefix'];

		if ($result_array['last']['title'] !== false)
			$last_part .= $curitem_urlprefix . $result_array['last']['title'] . $curitem_urlsuffix;

		if ($result_array['last']['suffix'] !== false)
			$last_part .= $result_array['last']['suffix'];

		if ($this->options['static_frontpage'] === false) {
			if ( ($swg_type === 'page') or ($swg_type === 'search') or ($swg_type === '404') ) {
				$result .= $bcn_bloglink . $this->options['separator'];
			}
		}
  
		$result .= $bcn_homelink . $first_sep . $middle_part . $this->options['current_item_style_prefix'] . $last_part . $this->options['current_item_style_suffix'] . "\n";

        // smartBreadcrumbs_config_style
        // get current style
        $curr_style = str_replace("preview.png", '', $this->smartBreadcrumbs->get_option('_config_' . 'style'));
        
        $model = str_replace("/", '', str_replace("style", '', $curr_style));
        $this->curr_style = $this->smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'styles' . '/' . $curr_style . 'css.css';
       
        $htmlresponse  = '<link rel="stylesheet" type="text/css" media="all" href="' . $this->curr_style . '" />';
        $htmlresponse .= '<style type="text/css">';
        $htmlresponse .=    'ul#breadcrumbs.breadcrumbs-' . ($model) . ' {border-color: ' . ($this->smartBreadcrumbs->get_option('_config_' . 'border_color')) . ';}';
        $htmlresponse .=    'ul#breadcrumbs.breadcrumbs-' . ($model) . ' li {font-size: ' . ( (int) $this->smartBreadcrumbs->get_option('_config_' . 'font_size') ) . 'px; color: ' . ($this->smartBreadcrumbs->get_option('_config_' . 'curr_fontcolor')) . ';}';
        
        $htmlresponse .=    'ul#breadcrumbs.breadcrumbs-' . ($model) . ' li a:link, ul#breadcrumbs.breadcrumbs-' . ($model) . ' li a:visited {color: ' . ($this->smartBreadcrumbs->get_option('_config_' . 'link_fontcolor')) . ';}';
        $htmlresponse .=    'ul#breadcrumbs.breadcrumbs-' . ($model) . ' li a:hover {color: ' . ($this->smartBreadcrumbs->get_option('_config_' . 'hover_fontcolor')) . ';}';
        
         if($this->smartBreadcrumbs->get_option('_config_' . 'fontfamily') != 'arial'){
            echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' . $this->smartBreadcrumbs->get_option('_config_' . 'fontfamily') . '">';
        }
        
        
        if($this->smartBreadcrumbs->get_option('_config_' . 'border_show') != 1){
            $htmlresponse .= 'ul#breadcrumbs.breadcrumbs-' . ($model) . ' {border: none}';
        }
        $htmlresponse .= "
            ul#breadcrumbs.breadcrumbs-{$model} li {
                font-family: '".($this->smartBreadcrumbs->get_option('_config_' . 'fontfamily'))."', Arial, serif;
            }
        ";
        $htmlresponse .= '</style>'; 
        
        $htmlresponse .= '<ul id="breadcrumbs" class="breadcrumbs-' . $model . '">';
        
        $curr_icon = $this->smartBreadcrumbs->get_option('_config_' . 'homeicon');
        
        if($swg_type == 'home'){
            $htmlresponse .= '<li><a style="background-image: none;" href="'.(home_url("/")).'">';
        }else{
            $htmlresponse .= '<li><a href="'.(home_url("/")).'">';
        }
        if(trim($curr_icon) != "" && in_array($model, array('model-1', 'model-3'))){
            $htmlresponse .= '<img src="'.($curr_icon).'" width="14" class="icon"/>';
        }
        
        $htmlresponse .= 'Home</a></li>';
        $htmlresponse .= $result;
        $htmlresponse .= '</ul>';
		echo $htmlresponse;
	}
}