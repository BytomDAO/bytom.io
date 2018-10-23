<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package freddo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="bytom icon" href="<?php echo get_template_directory_uri(); ?>/images/bytom_new.ico">
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">  
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-store, must-revalidate">     
    <meta name="keywords" content="bytom"/>
    <meta name="description" content="A digital asset layer protocol is the infrastructure of asset Internet." />
     <!--  <script>
            if(!window.name){        
             var str = Math.random().toString(36).substr(2);//随机字符串         
             window.location.href += '?S='+ str;//兼容微信浏览器刷新
             window.name = 'isreload';    
              }
      </script>   -->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.lazyload.js"></script>
	 <?php if($post->post_name === '/'):?>
	    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/willesPlay.js"></script>
	 <?php endif;?>
     <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/demo.css" type="text/css" media="screen" />
     <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/iconfont.css" type="text/css" media="screen" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if(freddo_options('_show_loader', '0') == 1 ) : ?>
	<div class="freddoLoader">
		<?php freddo_loadingPage(); ?>
	</div>
<?php endif; ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'freddo' ); ?></a>

	<?php $menuFixedMobile = freddo_options('_menu_fixed_mobile', ''); ?>
	<header id="masthead" class="site-header <?php echo $menuFixedMobile ? 'yesMobileFixed' : 'noMobileFixed' ?>">
		

		<div class="mainHeader">
			<div class="mainLogo">
				<div class="freddoSubHeader title">
					<div class="site-branding">
						<?php
						if ( function_exists( 'the_custom_logo' ) ) : ?>
						<!-- <div class="freddoLogo" itemscope itemtype="http://schema.org/Organization">
							<?php the_custom_logo(); ?>
							<?php endif; ?>
							<div class="freddoTitleText">
								<?php if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;

								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
								<?php
								endif; ?>
							</div>
						</div> -->
						<div class="freddoLogo" itemscope="">
							<a href="https://bytom.io/" class="custom-logo-link" rel="home" itemprop="url">
							    <img width="1463" height="374" src="//bytom.io/wp-content/uploads/2018/04/logo-white-v.png" 
								class="custom-logo" alt="BYTOM" itemprop="logo" sizes="(max-width: 1463px) 100vw, 1463px">
							</a>												
							<div class="freddoTitleText">
							    <p class="site-title"><a href="https://bytom.io/" rel="home">BYTOM</a></p>
							</div>
						</div>
					</div><!-- .site-branding -->
				</div>
			</div>
			<?php if ( is_active_sidebar( 'sidebar-push' ) ) : ?>
				<div class="hamburger-menu">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
			<?php endif; ?>
			<?php $showSearchButton = freddo_options('_search_button', '1');
			if ($showSearchButton) : ?>
			<div class="search-button">
				<div class="search-circle"></div>
				<div class="search-line"></div>
			</div>
			<?php endif; ?>
			<div class="freddoHeader">
				<div class="freddoSubHeader">
					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-lg fa-bars" aria-hidden="true"></i></button>
						<?php
							if(strstr($_SERVER['REQUEST_URI'], 'active')){
								wp_nav_menu( array(
									'theme_location' => 'active',
									'menu_id'        => 'primary-menu',
								) );
							}else{
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								) );
							}
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php if (is_home()) : ?>
		<?php
			$pageID = get_option('page_for_posts');
			if ('' != get_the_post_thumbnail($pageID)) : 
			$effectFeatImage = freddo_options('_effect_featimage', 'withZoom');
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageID ), 'freddo-the-post-big' );
		?>
			<div class="freddoBox">
				<div class="freddoBigImage <?php echo esc_attr($effectFeatImage); ?>" style="background-image: url(<?php echo esc_url($image[0]); ?>);">
					<div class="freddoImageOp">
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (is_singular(array( 'post', 'page' )) && '' != get_the_post_thumbnail() && !is_page_template('template-onepage.php') ) : ?>
		<?php while ( have_posts() ) : 
		the_post(); ?>
		<?php 
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'freddo-the-post-big');
			$showScrollDownButton = freddo_options('_scrolldown_button', '1');
			$effectFeatImage = freddo_options('_effect_featimage', 'withZoom');
		?>
		<div class="freddoBox">
			<div class="freddoBigImage <?php echo esc_attr($effectFeatImage); ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);">
				<div class="freddoImageOp">
				</div>
			</div>
			<div class="freddoBigText freddoBigText_gg">
				<header class="entry-header">
					<?php if($post->post_name === '/'):?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php endif;?>
					<?php if($post->post_name == 'blog'):?>
                         <h1 class="entry-title entry-title-blog">We push tech and operation weekly report,message and article about Bytom will synchronous update.</h1>
					    
					<?php endif;?>
					<?php if($post->post_name == 'team'):?>
                         <h1 class="entry-title entry-title-team">Gathering notable and skilled people from blockchain, traditional financial industry.</h1>
					     
					<?php endif;?>
					<?php if($post->post_name == 'features'):?>
					<h1 class="entry-title entry-title-fea"><b>Bytom</b> is the infrastructure of asset Internet. <br>	Any peer-to-peer financial applications and asset applications<br> from institutions and individuals could be built on Bytom chain.</h1>
					<p class="line"></p>
					<div class="freddoButton aboutus features" style="margin-top: 4em">
                        <img src="/wp-content/themes/freddo/images/demo/icon_PDF_1.svg" style="">
                        <span>Technical White Paper</span>
				    	<a  class="fiex_w" href="<?php echo get_template_directory_uri();?>/book/BytomWhitePaperV1.0.pdf" target="_blank" style="margin:0 1em">中文</a>
				    	<a class="fiex_w"  href="<?php echo get_template_directory_uri();?>/book/BytomWhitePaperV1.0_En.pdf" target="_blank" style="margin:0 1em">English</a>
				    </div><br>
				    <div class="freddoButton aboutus features" style="">
                        <img src="/wp-content/themes/freddo/images/demo/icon_PDF_1.svg" style="">
                        <span style="width: 234px;display: inline-block;">Tensority-v1.2</span>
				    	<a  class="fiex_w" href="<?php echo get_template_directory_uri();?>/book/tensority-v1.2.pdf" target="_blank" style="margin:0 1em">English</a>
				    </div>
				    <?php endif;?>
					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php freddo_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php if ($showScrollDownButton) : ?>
						<?php $scrollText = freddo_options('_post_scrolldown_text', __('Scroll Down', 'freddo')); ?>
						<div class="scrollDown"><span><?php echo esc_html($scrollText); ?></span></div>
					<?php endif; ?>
					<?php else: ?>
						<?php if ($showScrollDownButton) : ?>
							<?php $scrollText = freddo_options('_post_scrolldown_text', __('Scroll Down', 'freddo')); ?>
							<div class="scrollDown"><span><?php echo esc_html($scrollText); ?></span></div>
						<?php endif; ?>
					<?php endif; ?>
				</header><!-- .entry-header -->
			</div>
		</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<div id="content" class="site-content content_w">
