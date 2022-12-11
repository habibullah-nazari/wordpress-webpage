<?php
/**
 * Template part for displaying page content in index.php and archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since 1.0.0
 * @package Guten Learn WordPress Theme
 */
?>
<article <?php Guten_Learn_Helper::schema_body( 'article' ); ?> id="post-<?php the_ID(); ?>" <?php post_class( Guten_Learn_Helper::with_prefix( 'post' ) ); ?> >
	<a href="<?php the_permalink() ?>">		
		<div class="image-full post-image" style="<?php Guten_Learn_Theme::the_default_image( get_the_ID() ); ?>">
			<?php Guten_Learn_Helper::post_format_icon() ?>
		</div>	
	</a>
	
	<div class="post-content-wrap">
		<?php 
			$order = guten_learn_get( 'meta-sections-order' );

			if( '' != $order ){
				$order = json_decode( $order );
				foreach ( $order as $o ) {
					if( 'title' == $o ){
						Guten_Learn_Helper::get_title();
					}elseif( 'date' == $o ){
						get_template_part( 'templates/meta', 'info' );
					}elseif( 'excerpt' == $o ){
						the_excerpt();	
					}elseif( 'category' == $o ){
						$category = guten_learn_get( 'post-category' );
						if(  'post' === get_post_type() && $category ){
							echo Guten_Learn_Helper::the_category();
						}
					}elseif( 'comment' == $o ){
						Guten_Learn_Helper::get_comment_number();
					}
				}
			}
		?>
	</div>
</article>