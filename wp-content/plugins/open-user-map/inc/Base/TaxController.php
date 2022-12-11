<?php
/**
 * @package OpenUserMapPlugin
 */

namespace OpenUserMapPlugin\Base;

use OpenUserMapPlugin\Base\BaseController;

class TaxController extends BaseController
{
    public $settings;

    public function register()
    {
        // Taxonomy: type
        add_action('init', array($this, 'type_tax'));
        add_action('oum-type_add_form_fields', array($this, 'type_tax_add_custom_fields'));
        add_action('oum-type_edit_form_fields', array($this, 'type_tax_edit_custom_fields'), 10, 2);
        add_action('edited_oum-type', array($this, 'type_tax_save'));
        add_action('create_oum-type', array($this, 'type_tax_save'));
        add_action('add_meta_boxes', array($this, 'add_type_tax_meta_box_to_location'));
        add_action('save_post', array($this, 'save_type_tax_with_location'));
    }

    /**
     * Taxonomy: oum-type
     */

    public static function type_tax()
    {
        $labels = array(
            'name' => __('Marker Categories', 'open-user-map'),
            'singular_name' => __('Marker Category', 'open-user-map'),
            'menu_name' => __('Marker Categories', 'open-user-map'),
            'all_items' => __('All Marker Categories', 'open-user-map'),
            'edit_item' => __('Edit Marker Category', 'open-user-map'),
            'view_item' => __('Show Marker Category', 'open-user-map'),
            'update_item' => __('Update Marker Category', 'open-user-map'),
            'add_new_item' => __('Add new Marker Category', 'open-user-map'),
            'new_item_name' => __('New Type name', 'open-user-map'),
            'search_items' => __('Search Marker Categories', 'open-user-map'),
            'choose_from_most_used' => __('Choose from the most used Marker Categories', 'open-user-map'),
            'popular_items' => __('Popular Marker Categories', 'open-user-map'),
            'add_or_remove_items' => __('Add or remove Marker Categories', 'open-user-map'),
            'separate_items_with_commas' => __('Separate Marker Categories with commas', 'open-user-map'),
            'back_to_items' => __('Back to Marker Categories', 'open-user-map'),
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus' => false,
            'show_admin_column' => true,
            'show_in_quick_edit' => false,
            'meta_box_cb' => false,
            'hierarchical' => false,
            'show_in_rest' => true,
        );

        register_taxonomy('oum-type', 'oum-location', $args);
    }

    public function type_tax_add_custom_fields($term)
    {
        wp_nonce_field('oum_location', 'oum_location_nonce');

        // render view
        require_once "$this->plugin_path/templates/page-backend-add-type.php";

        wp_enqueue_script('oum_backend_type_js', $this->plugin_url . 'src/js/backend-type.js', array('wp-polyfill'), $this->plugin_version);
    }

    public function type_tax_edit_custom_fields($tag, $taxonomy)
    {
			wp_nonce_field('oum_location', 'oum_location_nonce');

			// render view
			require_once "$this->plugin_path/templates/page-backend-edit-type.php";

			wp_enqueue_script('oum_backend_type_js', $this->plugin_url . 'src/js/backend-type.js', array('wp-polyfill'), $this->plugin_version);

    }

    public function type_tax_save($term_id)
    {
        // Dont save without nonce
        if (!isset($_POST['oum_location_nonce'])) {
            return $term_id;
        }

        // Dont save if nonce is incorrect
        $nonce = $_POST['oum_location_nonce'];
        if (!wp_verify_nonce($nonce, 'oum_location')) {
            return $term_id;
        }

        // Dont save if wordpress just auto-saves
        if (defined('DOING AUTOSAVE') && DOING_AUTOSAVE) {
            return $term_id;
        }

        if (isset($_POST['oum_marker_icon'])) {
            // Validation
            $oum_marker_icon_validated = sanitize_text_field($_POST['oum_marker_icon']);
            if (!$oum_marker_icon_validated) {
                $oum_marker_icon_validated = '';
            }

            if ($oum_marker_icon_validated) {
                update_term_meta($term_id, 'oum_marker_icon', $oum_marker_icon_validated);
            }
        }

				if (isset($_POST['oum_marker_user_icon'])) {
					// Validation
					$oum_marker_user_icon_validated = sanitize_text_field($_POST['oum_marker_user_icon']);
					if (!$oum_marker_user_icon_validated) {
							$oum_marker_user_icon_validated = '';
					}

					if ($oum_marker_user_icon_validated) {
							update_term_meta($term_id, 'oum_marker_user_icon', $oum_marker_user_icon_validated);
					}
			}
    }

    public function add_type_tax_meta_box_to_location()
    {
        add_meta_box(
            'taxonomy_box', 
            __('Type', 'content-hub'), 
            array($this, 'render_type_tax_meta_box'), 
            'oum-location',
            'side'
        );
    }

    public function render_type_tax_meta_box($post)
    {
        $terms = get_terms( array(
            'taxonomy' => 'oum-type',
            'hide_empty' => false
        ));
    
        $currentType = (get_the_terms($post->ID, 'oum-type'))? get_the_terms($post->ID, 'oum-type')[0] : false;

        // render view
		require_once "$this->plugin_path/templates/page-backend-select-type.php";

        wp_enqueue_script('oum_backend_type_js', $this->plugin_url . 'src/js/backend-type.js', array('wp-polyfill'), $this->plugin_version);
    }

    public function save_type_tax_with_location($post_id)
    {
        if( isset($_POST['oum_marker_icon'])) {
            wp_set_object_terms(
                $post_id, 
                (int)sanitize_text_field( $_POST['oum_marker_icon'] ), 
                'oum-type'
            );
        }
    }
}
