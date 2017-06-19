<?php
/**
  Plugin Name: Smart Breadcrumbs - Wordpress plugin
  Plugin URI: http://codecanyon.net/user/AA-Team
  Description: NEW! Breadcrumbs-Wordpress Plugin for your website in just a few clicks. Easy to custumize and the possibilitty to chose from different models. Enjoy! 

  Author: AA-Team
  Version: 1.1
  Author URI: http://codecanyon.net/user/AA-Team
 */

/**
 *   smartBreadcrumbs
 * -------------------
 *    |        |
 *  prefix  theme name
 * */

class smartBreadcrumbs {

    /**
     * Holds an insance of self
     * @var $instance
     */
    private static $instance = NULL;
    public $prefix = 'smartBreadcrumbs';
    public $admin_options;
    public $sitemap_options;
    public $utils = array(
        'author' => '<a target=_blank href="http://codecanyon.net/user/AA-Team">AA Team</a>',
        'author_url' => 'http://codecanyon.net/user/AA-Team',
        'authorname' => 'Andrei Dinca, Alexandra Ipate',
        'themename' => 'smartBreadcrumbs',
        'shortname' => 'Breadcrumbs',
        'shortdes' => 'Smart-Breadcrumbs - administration panel.',
        'icon' => '/smart_framework/images/avatar-thumb.png',
        'thumb' => '/smart_framework/images/breadcrumb-thumb.png'
    );
    public static $cfg;
    public static $modules = array(
    	'dashboard', 'config', 'documentation', 'support', 'install'
    );

    private static $avaibleModules = array();

    /**
     *
     * Return smartBreadcrumbs instance or create intitial instance
     *
     * @access public
     * @params $custom_option (optional)
     *
     * @return object
     *
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new smartBreadcrumbs();
        }
        return self::$instance;
    }

    function __construct() {

		asort(self::$modules);

        // run config
        $this->config();

        // globals utils
        $this->functions();

        // load modules
        $this->load_modules();

        // admin framework
        $this->admin();
        
        // admin frontpage
		//$this->frontpage();

        /* Plugin init hook. */
        do_action("{$this->prefix}_init");
        
        // try redirect
		$this->my_plugin_redirect();
    }

    // Defines the constant paths for use within the theme.
    public function config() {
        global $wpdb;

        self::$cfg['PLUGIN_NAME'] = 'smart-breadcrumbs';
        self::$cfg['PLUGIN_DIR'] = ABSPATH . 'wp-content/plugins/' . self::$cfg['PLUGIN_NAME'];
        self::$cfg['PLUGIN_URI'] = home_url() . '/wp-content/plugins/' . self::$cfg['PLUGIN_NAME'];
        self::$cfg['PLUGIN_LIBRARY'] = self::$cfg['PLUGIN_DIR'];
        self::$cfg['PLUGIN_MODULES'] = self::$cfg['PLUGIN_DIR'] . '/modules/';
        self::$cfg['PLUGIN_MODULES_URL'] = self::$cfg['PLUGIN_URI'] . '/modules/';
        self::$cfg['PLUGIN_INSTALL'] = self::$cfg['PLUGIN_DIR'] . '/install';
        self::$cfg['SMART_FRAMEWORK'] = self::$cfg['PLUGIN_DIR'] . '/smart_framework';
        self::$cfg['SMART_MODS'] = self::$cfg['PLUGIN_DIR'] . '/smart_mods';
        self::$cfg['PLUGIN_FRONTPAGE'] = self::$cfg['PLUGIN_DIR'] . '/frontpage';
        self::$cfg['PLUGIN_FRONTPAGE_URI'] = self::$cfg['PLUGIN_DIR'] . 'frontpage/';
        self::$cfg['PLUGIN_ADMIN'] = self::$cfg['SMART_FRAMEWORK'] . '/admin';
        self::$cfg['PLUGIN_FUNCTIONS'] = self::$cfg['SMART_FRAMEWORK'] . '/functions';
        self::$cfg['PLUGIN_OPTIONS'] = self::$cfg['SMART_MODS'] . '/options';
        self::$cfg['PLUGIN_IMAGES'] = self::$cfg['PLUGIN_URI'] . '/images';
        self::$cfg['ADMIN_IMAGES'] = self::$cfg['PLUGIN_URI'] . '/smart_framework/images';
        self::$cfg['ADMIN_CSS'] = self::$cfg['PLUGIN_URI'] . '/smart_framework/css';
        self::$cfg['ADMIN_JS'] = self::$cfg['PLUGIN_URI'] . '/smart_framework/js';
        self::$cfg['ADMIN_IMAGES'] = self::$cfg['PLUGIN_URI'] . '/smart_framework/images';
        self::$cfg['ADMIN_IMAGES_PATH'] = self::$cfg['PLUGIN_DIR'] . '/smart_framework/images';

        self::$cfg['SUBSCRIBERS_TABLE'] = $wpdb->prefix . "aa_subscribers";
    }

    // Loads the core frontpage functions.
    function functions() {
        
        $GLOBALS['smartBreadcrumbs_plugin'] = $this;
        // utils
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/array_walk_recursive.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/core.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/get_image.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/ajax_upload.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/upload.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/options_generator.php' );
        require_once( self::$cfg['PLUGIN_FUNCTIONS'] . '/save_options.php' );
        
        require_once( self::$cfg['PLUGIN_DIR']       . '/breadcrumbs.class.php' );
    }

    /**
     * Define Getters
     * */
    public function cfg($key) {
        return self::$cfg[$key];
    }


    public function get_option($key, $modules='') {
        $slug = $this->prefix . $modules . $key;
        return get_option($slug);
    }

    public function get_postmeta($id, $key, $single, $modules='') {
        $slug = $this->prefix . $modules . $key;
        return get_post_meta($id, $slug, $single);
    }

    // Load admin files.
    function admin() {
        if (is_admin()) {
            /* Initialize the theme admin functionality and menu. */
            add_action('init', array(&$this, 'admin_init'));

            require_once( self::$cfg['PLUGIN_ADMIN'] . '/options_page_content.php' );
            require_once( self::$cfg['PLUGIN_ADMIN'] . '/save_options.php' );
        }
    }
    

    // Initializes the theme administration functions.
    function admin_init() {

        /* Initialize the theme/theme settings page. */
        add_action('admin_menu', array(&$this, 'menu_init'));
    }

    /* Initializes theme settings */

    function menu_init() {

        /* Create the theme/theme dashboard page. */
        $test = add_object_page(
                $this->utils['shortname'] . ' - dashboard', // page_title
                $this->utils['shortname'], // menu_title
                'administrator', // capability
                $this->prefix, // menu_slug
                $this->prefix . '_create_dashboard_page', // function
                self::$cfg['PLUGIN_URI'] . $this->utils['icon'] // icon_url
        );

        // add submenu to parent menu
        foreach (self::$avaibleModules as $key => $value) {

            $icon_path = self::$cfg['PLUGIN_MODULES'] . '/' . $value . '/app/images/icon.png';
            $icon_url = self::$cfg['PLUGIN_MODULES_URL'] . '/' . $value . '/app/images/icon.png';

            $subicon = is_file($icon_path) ? '<img src="' . ($icon_url) . '" width="16" height="16" style="position:relative; bottom: -4px; margin-right: 4px;" />' : '';
            add_submenu_page('smartBreadcrumbs', "smartBreadcrumbs - " . $value, $subicon . ucfirst(str_replace("_", " ", $value)), 'administrator', 'smartBreadcrumbs_' . $value, 'smartBreadcrumbs_create_' . ( $value ) . '_page');
        }
    }

    // Load admin files.
    function load_modules() {
        foreach (self::$modules as $key => $value) {
            // use temporary for path files from modules
            $_path = '';
            $_name = '';

            // add prefix init file
            $file = $value . "/init.php";

            if (file_exists(self::$cfg['PLUGIN_MODULES'] . $file)) {
                $_path = self::$cfg['PLUGIN_MODULES'] . $value . '/';
                $_instance = $this;
                $_name = $value;
                require_once(self::$cfg['PLUGIN_MODULES'] . $file);

                if ($value != 'dashboard')
                    self::$avaibleModules[] = $value;
            }
        }
    }

     // getter method: get_modules
    function get_modules() {
        return self::$modules;
    }
    
    function my_plugin_redirect(){
		if (get_option($this->prefix  . '_redirect', false)) {
			delete_option($this->prefix  . '_redirect');
            header('location: ' . home_url("/") . 'wp-admin/admin.php?page=smartBreadcrumbs_install');
		}
	}
    
    // call on activate
	// reset all settings to default values
	function activate(){
		global $wpdb;
		
		// set redirect true
		add_option( $this->prefix . '_redirect', true);
        
        // generate allow link
        update_option( $this->prefix . "_config_" . "passLink", home_url("/") . "index.php?allow=" . uniqid());
	}
    
    function deactivate(){ 
		
	}

    public function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function fonts(){
        return array(
            'arial' => 'Arial - default',
	    'Hammersmith One' => ' Hammersmith One',
            'Varela' => 'Varela',
            'Redressed' => 'Redressed',
            'Artifika' => 'Artifika',
            'Playfair Display' => 'Playfair Display',
            'Maven Pro' => 'Maven Pro',
            'Jura' => 'Jura',
            'Play' => 'Play',
            'Megrim' => 'Megrim',
              'Carter One' => 'Carter One',
              'Damion' => 'Damion',
              'Nova Square' => 'Nova Square',
              'Nova Script' => 'Nova Script',
              'Expletus Sans' => 'Expletus Sans',
              'Buda' => 'Buda',
              'Puritan' => 'Puritan',
              'Orbitron' => 'Orbitron',
             'Raleway' => 'Raleway',
              'Allerta Stencil' => 'Allerta Stencil',
              'IM Fell English' => 'IM Fell English',
              'Inconsolata' => 'Inconsolata',
              'Ultra ' => 'Ultra ',
              'Aclonica' => 'Aclonica',      
            'Droid Sans' => 'Droid Sans',
            'Lora' => 'Lora',
            'Nunito' => 'Nunito',
           
            'Dancing Script' => 'Dancing Script',
            'Gruppo' => 'Gruppo',
            'Metrophobic' => 'Metrophobic',
            'Quattrocento Sans' => 'Quattrocento Sans',
            'Josefin Sans' => 'Josefin Sans',
            'PT Sans Caption' => 'PT Sans Caption',
            'Droid Serif' => 'Droid Serif',
            'Lobster' => 'Lobster',
            'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
            'Ubuntu' => 'Ubuntu',
            'Arvo' => 'Arvo',
            'Open Sans' => 'Open Sans',
            'Calligraffitti' => 'Calligraffitti',
            'Tangerine' => 'Tangerine',
            'The Girl Next Door' => 'The Girl Next Door',
            'Crafty Girls' => 'Crafty Girls',
            'Nobile' => 'Nobile',
            'Rock Salt' => 'Rock Salt',
            'Molengo' => 'Molengo',
            'Coming Soon' => 'Coming Soon',
            'Cherry Cream Soda' => 'Cherry Cream Soda',
            'Pacifico' => 'Pacifico',
            'Waiting for the Sunrise' => 'Waiting for the Sunrise',
            'Chewy' => 'Chewy',
            'Vollkorn' => 'Vollkorn',
            'Copse' => 'Copse'
        );
    }

    public function string_limit_words($string, $word_limit) {
        $string = strip_tags($string);
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit)
            array_pop($words);
        return implode(' ', $words);
    }

    public function string_limit_caracters($string, $nbchars) {
        $string = strip_tags($string);
        $str2 = substr($string, 0, $nbchars);
        if (strlen($str2) < strlen($string)) {
            $str2 = $str2;
        }
        return $str2;
    }
}

/* Initialize theme and the smart framework. */
$smartBreadcrumbs = smartBreadcrumbs::getInstance();

/* Make the class works first */
if (isset($smartBreadcrumbs)) {
   register_activation_hook(dirname(__FILE__) . '/plugin.php', array($smartBreadcrumbs, 'activate'));
   register_deactivation_hook(dirname(__FILE__) . '/plugin.php', array($smartBreadcrumbs, 'deactivate'));
}

// register wiget
function widget_breadcrumbsWiget($args) {
    if (class_exists('smartBreadcrumbsFrontpage')) {
        // New breadcrumb object
        $breadcrumb = new smartBreadcrumbsFrontpage;
        // Display the breadcrumb
        $breadcrumb->display();
    } 
}
 
function breadcrumbsWiget_init(){
  register_sidebar_widget(__('Breadcrumbs Wiget'), 'widget_breadcrumbsWiget');
}
add_action("plugins_loaded", "breadcrumbsWiget_init");