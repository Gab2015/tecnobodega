<meta charset="<?php bloginfo('charset'); ?>">

<link href="//www.google-analytics.com" rel="dns-prefetch">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">

<?php if( vw_get_option( 'site_enable_meta_description' ) ) { ?><meta name="description" content="<?php bloginfo('description'); ?>"><?php } ?>

<?php if( vw_get_option( 'fav_icon_url' ) ) { ?><link rel="shortcut icon" href="<?php echo esc_url( vw_get_option( 'fav_icon_url' ) ); ?>"><?php } ?>
		
<?php if( vw_get_option( 'fav_icon_iphone_url' ) ) { ?><link rel="apple-touch-icon" href="<?php echo esc_url( vw_get_option( 'fav_icon_iphone_url' ) ); ?>"><?php } ?>

<?php if( vw_get_option( 'fav_icon_iphone_retina_url' ) ) { ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( vw_get_option( 'fav_icon_iphone_retina_url' ) ); ?>"><?php } ?>

<?php if( vw_get_option( 'fav_icon_ipad_url' ) ) { ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( vw_get_option( 'fav_icon_ipad_url' ) ); ?>"><?php } ?>

<?php if( vw_get_option( 'fav_icon_ipad_retina_url' ) ) { ?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( vw_get_option( 'fav_icon_ipad_retina_url' ) ); ?>"><?php } ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>