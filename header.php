<!DOCTYPE html><!-- HTML 5 -->
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php /* Embeds HTML5shiv to support HTML5 elements in older IE versions plus CSS Backgrounds */ ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php themezee_wrapper_before(); // hook before #wrapper ?>
<div id="wrapper" class="hfeed">
	
	<?php themezee_header_before(); // hook before #header ?>
	<div id="header-wrap">
	
		<header id="header" class="container clearfix" role="banner">

			<div id="logo">
			
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php // Display Logo Image or Site Title
				$options = get_option('zeedynamic_options');
				if ( isset($options['themeZee_general_logo']) and $options['themeZee_general_logo'] <> "" ) : ?>
					<img class="logo-image" src="<?php echo esc_url($options['themeZee_general_logo']); ?>" alt="Logo" /></a>
			<?php else: ?>
					<h1 class="site-title"><?php bloginfo('name'); ?></h1>
			<?php endif; ?>
				</a>
				
			<?php if(isset($options['themeZee_general_tagline']) and $options['themeZee_general_tagline'] == 'true') : ?>
				<h2 class="site-description"><?php echo bloginfo('description'); ?></h2>
			<?php endif; ?>
			
			</div>
			
		<?php // Check if there is Header Content to display
		if(isset($options['themeZee_general_header_content']) and $options['themeZee_general_header_content'] <> "nothing" ) : ?>
			<div id="header-content" class="clearfix">
				<?php locate_template('/includes/header-content.php', true); ?>
			</div>
		<?php endif; ?>

		</header>
	
	</div>
	<?php themezee_header_after(); // hook after #header ?>
	
	<div id="navi-wrap">
		<nav id="mainnav" class="container clearfix" role="navigation">
			<?php 
				// Get Navigation out of Theme Options
				wp_nav_menu(array('theme_location' => 'main_navi', 'container' => false, 'menu_id' => 'mainnav-menu', 'echo' => true, 'fallback_cb' => 'themezee_default_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0));
			?>
		</nav>
	</div>
	
	<?php // Display Custom Header Image
		themezee_display_custom_header(); ?>
		