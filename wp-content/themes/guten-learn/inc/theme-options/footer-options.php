<?php
if( !function_exists( 'guten_learn_acb_footer' ) ):
    /**
    * Active callback function of footer
    *
    * @static
    * @access public
    * @return boolen
    * @since 1.0.0
    *
    * @package Guten Learn WordPress Theme
    */
    function guten_learn_acb_footer( $control ){
        $value = $control->manager->get_setting( Guten_learn_Helper::with_prefix( 'enable-footer' ) )->value();
        return $value;
    }
endif;

/**
 * Creates option for footer
 *
 * Register footer Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Guten Learn WordPress Theme
 */

function guten_learn_footer_options(){
	Guten_Learn_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Footer Options
		'section' => array(
		    'id'    => 'footer',
		    'title' => esc_html__( 'Footer Options','guten-learn' ),
		),
		# Theme Option > Header > settings
		'fields' => array(
			array(
				'id'      => 'enable-footer',
				'label'   => esc_html__( 'Enable Footer', 'guten-learn' ),
				'default' => true,
				'description' => esc_html__( 'If this option is disabled, footer will disabled on entire site. Or you can enable this and manage via pages setting for respective page', 'guten-learn' ),
				'type'    => 'guten-learn-toggle'
			),
			array(
			    'id'      	  => 'layout-footer',
			    'label'   	  => esc_html__( 'Footer Layout', 'guten-learn' ),
			    'description' => esc_html__( 'Add widget to display in footer.', 'guten-learn' ),
			    'type'    	  => 'guten-learn-radio-image',
			    'active_callback' => array( 'fn_name' => 'guten_learn_acb_footer' ),
			    'default' 	  => '4',
			    'choices' 	  => array(
			        '1' => array(
			            'label' => esc_html__( 'One widget', 'guten-learn' ),
						'url'   => Guten_Learn_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-1.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M100,0V50H0V0Z"></path></svg>'
			        ),
			        '2' => array(
			            'label' => esc_html__( 'Two widget', 'guten-learn' ),
						'url'   => Guten_Learn_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-2.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M49,0V50H0V0Z M100,0V50H51V0Z"></path></svg>'
			        ),
			        '3' => array(
			            'label' => esc_html__( 'Thee widget', 'guten-learn' ),
						'url'   => Guten_Learn_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-3.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M32,0V50H0V0Z M66,0V50H34V0Z M100,0V50H68V0Z"></path></svg>'
			        ),
			        '4' => array(
			            'label' => esc_html__( 'Four widget', 'guten-learn' ),
						'url'   => Guten_Learn_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-4.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M23.5,0V50H0V0Z M49,0V50H25.5V0Z M74.5,0V50H51V0Z M100,0V50H76.5V0Z"></path></svg>'
			        ) 
			    )
			),
			array(
				'id'      => 'footer-copyright-text',
				'label'   => esc_html__( 'Copyright Text', 'guten-learn' ),
				'default' => esc_html__( 'Copyright &copy; All right reserved', 'guten-learn' ),
				'type'    => 'textarea',
			    'partial' =>	array(
			    	'selector'	=>	'span#gutenlearn-copyright'
				)
			),
			array(
				'id'      => 'footer-social-menu',
				'label'   => esc_html__( 'Show Social Menu', 'guten-learn' ),
				'description' => esc_html__( 'Please add Social menus for enabling Social menus. Go to Menus for setting up', 'guten-learn' ),
				'default' => true,
				'type'    => 'guten-learn-toggle',
			)
		)
	));
}
# use widgets_init hook as we need default value of layout-footer while registering sidebar.
# init hook is too late
add_action( 'widgets_init', 'guten_learn_footer_options' );