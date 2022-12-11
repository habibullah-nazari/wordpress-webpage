<?php
/**
* Register blog Options
*
* @return void
* @since 1.0.0
*
* @package Guten_Learn WordPress theme
*/
function guten_learn_blog_options(){	
	Guten_Learn_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
		    'id'       => 'blog-section',
		    'title'    => esc_html__( 'Blog Options' ,'guten-learn' ),
		    'priority' => 25
		),
		'fields'  => array(
			array(
				'id'	=> 'meta-sections-order',
				'label' => esc_html__( 'Archive Meta Order', 'guten-learn' ),
				'description' => esc_html__( 'Please make sure that you have enabled all sections under "Post Options"', 'guten-learn' ),
				'type'  => 'guten-learn-section-order',
				'default' =>json_encode(array(
					'title', 'date', 'category', 'excerpt', 'comment'
				)),
				'choices' => array(
					'title' => esc_html__( 'Title', 'guten-learn' ),
					'date' => esc_html__( 'Date', 'guten-learn' ),
					'category' => esc_html( 'Category', 'guten-learn' ),
					'excerpt' => esc_html__( 'Excerpt', 'guten-learn' ),
					'comment' => esc_html__( 'Comment', 'guten-learn' )
				),
				'transport'   => 'refresh'
			),
		),			
	));
}
add_action( 'init', 'guten_learn_blog_options' );
