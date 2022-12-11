<?php

/**
 * @package OpenUserMapPlugin
 */
namespace OpenUserMapPlugin\Pages;

use  OpenUserMapPlugin\Base\BaseController ;
class Frontend extends BaseController
{
    public function register()
    {
        // Shortcodes
        add_action( 'init', array( $this, 'set_shortcodes' ) );
    }
    
    /**
     * Setup Shortcodes
     */
    public function set_shortcodes()
    {
        // EXIT if inside Elementor Backend
        // Check if Elementor installed and activated
        if ( did_action( 'elementor/loaded' ) ) {
            
            if ( \Elementor_OUM_Addon\Plugin::is_elementor_backend() ) {
                error_log( 'OUM: prevented shortcode rendering inside Elementor' );
                return;
            }
        
        }
        // Render Map
        add_shortcode( 'open-user-map', array( $this, 'render_block_map' ) );
    }

}