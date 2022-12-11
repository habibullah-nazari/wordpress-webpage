<?php
/**
 * Content for header
 *
 * @since 1.0.0
 *
 * @package Guten Learn WordPress Theme
 */ ?>
<div class="<?php echo Guten_Learn_Helper::with_prefix( 'bottom-header-wrapper' ); ?>">
	<div class="container">
		<section class="<?php echo Guten_Learn_Helper::with_prefix( 'bottom-header' ); ?>">

			<div class="<?php echo Guten_Learn_Helper::with_prefix( 'header-search' ); ?>">


				<button class="circular-focus screen-reader-text" data-goto=".gutenlearn-header-search .gutenlearn-toggle-search"><?php esc_html_e( 'Circular focus', 'guten-learn' ); ?></button>

				<?php get_search_form(); ?>

				<button type="button" class="close <?php echo Guten_Learn_Helper::with_prefix( 'toggle-search' ); ?>">
					<i class="fa fa-times" aria-hidden="true"></i>
				</button>

				<button class="circular-focus screen-reader-text" data-goto=".gutenlearn-header-search .search-field"><?php esc_html_e( 'Circular focus', 'guten-learn' ); ?></button>

			</div>
			
			<div class="site-branding">
				<div>
					<?php the_custom_logo(); ?>
					<div>
						<?php if ( is_front_page() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="<?php echo Guten_Learn_Helper::with_prefix( 'navigation-n-options' ); ?>">
				<nav class="gutenlearn-main-menu" id="site-navigation">
					<?php Guten_Learn_Helper::get_menu( 'primary', true ); ?>
				</nav> 			
				<?php do_action( Guten_Learn_Helper::fn_prefix( 'after_primary_menu' ) ); ?>
			</div>				
		 
		</section>

	</div>
</div>
<!-- nav bar section end -->