<div class="wrap">
<h1>Open User Map</h1>

<form method="post" action="options.php">
    

    <?php 

if ( !get_option( 'oum_wizard_usecase_done' ) && !get_option( 'oum_enable_add_location' ) ) {
    ?>

      <?php 
    settings_fields( 'open-user-map-settings-group-wizard-1' );
    ?>
      <?php 
    do_settings_sections( 'open-user-map-settings-group-wizard-1' );
    ?>

      <div class="oum-wizard">
        <div class="hero">
          <div class="logo">Open User Map</div>
          <div class="overline">Quick Setup (2/3)</div>
          <h1>What kind of map do you need?</h1>
          <ul class="steps">
            <li class="done"></li>
            <li class="done"></li>
            <li></li>
          </ul>
        </div>
        <div class="step-content">
          <div class="intro">Open User Map can be used in different ways! Do you want to create an interactive map so that site visitors can add new markers themselves? Or do you just need a good looking map to show your own locations. Don't worry, you can change this later in the settings.</div>
          <div class="option">
            <label>
              <input type='radio' name='oum_wizard_usecase' value='1' checked>
              <h2>Interactive Map</h2>
              <p>Build a map based community! Your audience will be enabled to add new markers themselves. Then you will get noticed and approve each location before it gets published.</p>
            </label>
          </div>
          <div class="option">
            <label>
              <input type='radio' name='oum_wizard_usecase' value='2'>
              <h2>Simple Map</h2>
              <p>Use a good looking map to just show your own locations. No one else can add new markers.</p>
            </label>
          </div>

          <input type="hidden" name="oum_wizard_usecase_done" value="1">

          <?php 
    submit_button(
        'Next',
        'primary',
        'submit',
        false
    );
    ?>
        </div>
      </div>

    <?php 
} elseif ( !get_option( 'oum_wizard_finish_done' ) && !get_option( 'oum_enable_add_location' ) ) {
    ?>

      <?php 
    settings_fields( 'open-user-map-settings-group-wizard-2' );
    ?>
      <?php 
    do_settings_sections( 'open-user-map-settings-group-wizard-2' );
    ?>

      <div class="oum-wizard">
        <div class="hero">
          <div class="logo">Open User Map</div>
          <div class="overline">Quick Setup (3/3)</div>
          <h1>🎉 Yeah, complete!</h1>
          <ul class="steps">
            <li class="done"></li>
            <li class="done"></li>
            <li class="done"></li>
          </ul>
        </div>
        <div class="step-content">

          <h3>Your next steps:</h3>

          <?php 
    
    if ( get_option( 'oum_wizard_usecase' ) == '1' ) {
        ?>
          
            <ol class="next-steps">
              <li>Use Gutenberg or Elementor to insert the Block/Widget <b>Open User Map</b> into a page. <br>A shortcode <code>[open-user-map]</code> is also available.</li>
              <li>Your site visitors get an "Add location" button at the top right of the map to propose their own markers. New location proposals will have status "pending" to wait for your approval the “OUM Locations” menu.</li>
              <li>Customize Styles, activate Features and find Help under <a href="options-general.php?page=open_user_map">Settings > Open User Map</a></li>
            </ol>

          <?php 
    } elseif ( get_option( 'oum_wizard_usecase' ) == '2' ) {
        ?>

            <ol class="next-steps">
              <li>Add your first location under <a href="post-new.php?post_type=oum-location">OUM Locations > Add Location</a></li>
              <li>Use Gutenberg or Elementor to insert the Block/Widget <b>Open User Map</b> into a page. <br>A shortcode <code>[open-user-map]</code> is also available.</li>
              <li>Customize Styles, activate Features and find Help under <a href="options-general.php?page=open_user_map">Settings > Open User Map</a></li>
            </ol>

          <?php 
    }
    
    ?>

          <input type="hidden" name="oum_wizard_finish_done" value="1">

          <?php 
    submit_button(
        'Okay, got it',
        'primary',
        'submit',
        false
    );
    ?>
        </div>
      </div>

    <?php 
} else {
    ?>

      <?php 
    settings_fields( 'open-user-map-settings-group' );
    ?>
      <?php 
    do_settings_sections( 'open-user-map-settings-group' );
    ?>

      <!-- NAV -->
      <nav class="nav-tab-wrapper">
        <a href="#tab-1" class="nav-tab nav-tab-active"><?php 
    echo  __( 'Map Settings', 'open-user-map' ) ;
    ?></a>
        <a href="#tab-2" class="nav-tab"><?php 
    echo  __( 'Form Settings', 'open-user-map' ) ;
    ?></a>
        <a href="#tab-3" class="nav-tab"><?php 
    echo  __( 'Advanced', 'open-user-map' ) ;
    ?></a>
        <a href="#tab-4" class="nav-tab"><?php 
    echo  __( 'Import & Export', 'open-user-map' ) ;
    ?></a>
        <a href="#tab-5" class="nav-tab"><?php 
    echo  __( 'Help & Getting Started', 'open-user-map' ) ;
    ?></a>
      </nav>


      <!-- TABS -->
      <div class="tab-content">
        
        <div id="tab-1" class="tab-pane active">
          <table class="form-table">

            <tr valign="top">
              <?php 
    $oum_enable_add_location = get_option( 'oum_enable_add_location', 'on' );
    $oum_plus_button_label = get_option( 'oum_plus_button_label' );
    ?>
              <th scope="row">
                <?php 
    echo  __( 'Show „Add location“ Button', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <input class="oum-switch" type="checkbox" id="oum_enable_add_location" name="oum_enable_add_location" <?php 
    echo  ( $oum_enable_add_location == 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_add_location"></label><br><br>
                <span class="description"><?php 
    echo  __( 'This is the main feature of Open User Map. It enables your visitors to add new locations to your map.', 'open-user-map' ) ;
    ?></span><br>
                <span class="description"><?php 
    echo  __( 'However, you can always disable it and add locations just by yourself.', 'open-user-map' ) ;
    ?></span><br>
                <span class="description"><?php 
    echo  __( 'All Locations can be managed <a href="edit-tags.php?taxonomy=oum-type&post_type=oum-location">here</a>.', 'open-user-map' ) ;
    ?></span><br><br>
                <div id="plus_button_label">
                  <strong><?php 
    echo  __( 'Custom Label:', 'open-user-map' ) ;
    ?></strong><br>
                  <input class="regular-text" type="text" name="oum_plus_button_label" id="oum_plus_button_label" placeholder="<?php 
    echo  __( 'Add location', 'open-user-map' ) ;
    ?>" value="<?php 
    echo  $oum_plus_button_label ;
    ?>"></input><br>
                </div>              
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Map Style', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <div class="map_styles">
                <?php 
    $map_style = ( get_option( 'oum_map_style' ) ? get_option( 'oum_map_style' ) : 'Esri.WorldStreetMap' );
    $items = $this->map_styles;
    //pro map styles
    $pro_items = $this->pro_map_styles;
    foreach ( $items as $val => $label ) {
        $selected = ( $map_style == $val ? 'checked' : '' );
        echo  "<label class='{$selected}'><div class='map_style_preview' data-style='{$val}'></div><input type='radio' name='oum_map_style' {$selected} value='{$val}'></label>" ;
    }
    ?>

                <?php 
    foreach ( $pro_items as $val => $label ) {
        $selected = ( $map_style == $val ? 'checked' : '' );
        echo  "<label class='{$selected}'><div class='map_style_preview' data-style='{$val}'></div><input type='radio' name='oum_map_style' {$selected} value='{$val}'></label>" ;
    }
    ?>
                </div>

              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Marker Icon', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <div class="marker_icons">
                  <?php 
    $marker_icon = ( get_option( 'oum_marker_icon' ) ? get_option( 'oum_marker_icon' ) : 'default' );
    $items = $this->marker_icons;
    foreach ( $items as $val ) {
        $selected = ( $marker_icon == $val ? 'checked' : '' );
        echo  "<label class='{$selected}'><div class='marker_icon_preview' data-style='{$val}'></div><input type='radio' name='oum_marker_icon' {$selected} value='{$val}'></label>" ;
    }
    ?>

                  <?php 
    ?>

                  <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>

                    <?php 
        //pro marker icons
        $pro_items = $this->pro_marker_icons;
        foreach ( $pro_items as $val ) {
            echo  "<label class='pro-only label_marker_user_icon'><div class='marker_icon_preview' data-style='{$val}'></div>" ;
            echo  "\n                        <div class='icon_upload'>\n                          <button disabled class='button button-secondary'>" . __( 'Upload Icon', 'open-user-map' ) . "</button>\n                          <p class='description'>PNG, 50 x 82 Pixel</p>\n                        </div>\n                      " ;
            echo  "<a class='oum-gopro-text' href='" . oum_fs()->get_upgrade_url() . "'>" . __( 'Upgrade to PRO to use custom icons.', 'open-user-map' ) . "</a>" ;
            echo  "</label>" ;
        }
        ?>

                  <?php 
    }
    
    ?>

                </div>
              </td>
            </tr>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>

              <tr valign="top" class="oum-gopro-tr">
                <?php 
        $oum_ui_color = $this->oum_ui_color_default;
        ?>
                <th scope="row">
                  <?php 
        echo  __( 'UI Elements color', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to set a custom color for buttons and icons.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <div id="oum_ui_color_wrap">
                    <input disabled type="text" class="oum_colorpicker" value="<?php 
        echo  esc_attr( $oum_ui_color ) ;
        ?>" placeholder="<?php 
        echo  esc_attr( $oum_ui_color ) ;
        ?>"></input>
                  </div>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Map size', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <select name="oum_map_size" id="oum_map_size">
                  <?php 
    $map_size = ( get_option( 'oum_map_size' ) ? get_option( 'oum_map_size' ) : 'default' );
    $oum_map_height = get_option( 'oum_map_height' );
    $items = $this->oum_map_sizes;
    foreach ( $items as $val => $label ) {
        $selected = ( $map_size == $val ? 'selected' : '' );
        echo  "<option value='{$val}' {$selected}>{$label}</option>" ;
    }
    ?>
                </select>
                <br><br>
                <strong><?php 
    echo  __( 'Custom Height:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_map_height" id="oum_map_height" placeholder="e.g. 400px" value="<?php 
    echo  esc_attr( $oum_map_height ) ;
    ?>">
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Map size (mobile)', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <select name="oum_map_size_mobile" id="oum_map_size_mobile">
                  <?php 
    $map_size = ( get_option( 'oum_map_size_mobile' ) ? get_option( 'oum_map_size_mobile' ) : 'default' );
    $oum_map_height_mobile = get_option( 'oum_map_height_mobile' );
    $items = $this->oum_map_sizes_mobile;
    foreach ( $items as $val => $label ) {
        $selected = ( $map_size == $val ? 'selected' : '' );
        echo  "<option value='{$val}' {$selected}>{$label}</option>" ;
    }
    ?>
                </select>
                <br><br>
                <strong><?php 
    echo  __( 'Custom Height:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_map_height_mobile" id="oum_map_height_mobile" placeholder="e.g. 400px" value="<?php 
    echo  esc_attr( $oum_map_height_mobile ) ;
    ?>">
              </td>
            </tr>

            <tr class="top">
              <th scope="row">
                <label for="lat"><?php 
    echo  __( 'Set initial map view', 'open-user-map' ) ;
    ?></label>
              </th>
              <td>
                <?php 
    $start_lat = get_option( 'oum_start_lat' );
    $start_lng = get_option( 'oum_start_lng' );
    $start_zoom = get_option( 'oum_start_zoom' );
    ?>
                <div class="form-field geo-coordinates-wrap">
                    <div class="map-wrap">
                        <div id="mapGetInitial" class="leaflet-map map-style_<?php 
    echo  esc_attr( $map_style ) ;
    ?>"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="latlng-wrap" style="display: none">
                            <div class="form-field lat-wrap">
                                <label class="meta-label" for="lat">
                                    <?php 
    echo  __( 'Lat', 'open-user-map' ) ;
    ?>
                                </label>
                                <input type="text" readonly class="widefat" id="oum_start_lat" name="oum_start_lat" value="<?php 
    echo  ( esc_attr( $start_lat ) ? esc_attr( $start_lat ) : '' ) ;
    ?>"></input>
                            </div>
                            <div class="form-field lng-wrap">
                                <label class="meta-label" for="lng">
                                    <?php 
    echo  __( 'Lng', 'open-user-map' ) ;
    ?>
                                </label>
                                <input type="text" readonly class="widefat" id="oum_start_lng" name="oum_start_lng" value="<?php 
    echo  ( esc_attr( $start_lng ) ? esc_attr( $start_lng ) : '' ) ;
    ?>"></input>
                            </div>
                            <div class="form-field zoom-wrap">
                                <label class="meta-label" for="zoom">
                                    <?php 
    echo  __( 'Zoom', 'open-user-map' ) ;
    ?>
                                </label>
                                <input type="number" readonly min="0" max="19" class="widefat" id="oum_start_zoom" name="oum_start_zoom" value="<?php 
    echo  ( esc_attr( $start_zoom ) ? esc_attr( $start_zoom ) : '' ) ;
    ?>"></input>
                            </div>
                        </div>

                        <div class="geo-coordinates-hint">
                            <strong><?php 
    echo  __( 'How to adjust the initial view:', 'open-user-map' ) ;
    ?></strong>
                            <ol>
                                <li><?php 
    echo  __( 'Use the map on the left to find your spot', 'open-user-map' ) ;
    ?></li>
                                <li><?php 
    echo  __( 'Zoom and move the map to find the perfect view', 'open-user-map' ) ;
    ?></li>
                            </ol>
                        </div>
                    </div>

                    <script>
                    const lat = '<?php 
    echo  ( esc_attr( $start_lat ) ? esc_attr( $start_lat ) : '0' ) ;
    ?>';
                    const lng = '<?php 
    echo  ( esc_attr( $start_lng ) ? esc_attr( $start_lng ) : '0' ) ;
    ?>';
                    const zoom = '<?php 
    echo  ( esc_attr( $start_zoom ) ? esc_attr( $start_zoom ) : '1' ) ;
    ?>';
                    const mapStyle = '<?php 
    echo  $map_style ;
    ?>';
                    </script>

                    <?php 
    wp_enqueue_script(
        'oum_backend_settings_js',
        $this->plugin_url . 'src/js/backend-settings.js',
        array( 'wp-polyfill', 'oum_leaflet_geosearch_js' ),
        $this->plugin_version
    );
    ?>
                    
                </div>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_fixed_map_bounds = get_option( 'oum_enable_fixed_map_bounds' );
    ?>
              <th scope="row">
                <?php 
    echo  __( 'Keep map focus in fixed position', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <input class="oum-switch" type="checkbox" id="oum_enable_fixed_map_bounds" name="oum_enable_fixed_map_bounds" <?php 
    echo  ( $oum_enable_fixed_map_bounds == 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_fixed_map_bounds"></label><br><br>
                <span class="description"><?php 
    echo  __( 'If enabled, the visible map will try to stay in the boundaries like set above (Initial Map View).', 'open-user-map' ) ;
    ?></span><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_minimum_zoom_level = get_option( 'oum_minimum_zoom_level' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Minimum zoom level', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="small-text" type="number" min="1" max="15" name="oum_minimum_zoom_level" id="oum_minimum_zoom_level" value="<?php 
    echo  $oum_minimum_zoom_level ;
    ?>"></input><br><br>
                <span class="description"><?php 
    echo  __( 'Set a value between 1 (far away) and 15 (very close).', 'open-user-map' ) ;
    ?></span><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_cluster = get_option( 'oum_enable_cluster', 'on' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Pins Clustering (group nearby markers)', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="oum-switch" type="checkbox" name="oum_enable_cluster" id="oum_enable_cluster" <?php 
    echo  ( $oum_enable_cluster === 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_cluster"></label><br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_fullscreen = get_option( 'oum_enable_fullscreen', 'on' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Full Screen Button', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="oum-switch" type="checkbox" name="oum_enable_fullscreen" id="oum_enable_fullscreen" <?php 
    echo  ( $oum_enable_fullscreen === 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_fullscreen"></label><br><br>
              </td>
            </tr>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>

              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( '"Show me where I am" Button', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO and display a button to get the users current location.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <tr valign="top">
              <?php 
    $oum_enable_searchaddress = get_option( 'oum_enable_searchaddress', 'on' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Enter address“ searchbar', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="oum-switch" type="checkbox" name="oum_enable_searchaddress" id="oum_enable_searchaddress" <?php 
    echo  ( $oum_enable_searchaddress === 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_searchaddress"></label><br><br>
              </td>
            </tr>

          </table>
        </div>

        <div id="tab-2" class="tab-pane">

          <table class="form-table">

            <tr valign="top">
              <?php 
    $oum_form_headline = get_option( 'oum_form_headline' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Headline', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="regular-text" type="text" name="oum_form_headline" id="oum_form_headline" placeholder="<?php 
    echo  __( 'Add a new location', 'open-user-map' ) ;
    ?>" value="<?php 
    echo  $oum_form_headline ;
    ?>"></input><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_title = get_option( 'oum_enable_title', 'on' );
    $oum_title_required = get_option( 'oum_title_required', 'on' );
    $oum_title_label = get_option( 'oum_title_label' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Title“ field', 'open-user-map' ) ;
    ?></th>
              <td>
                <div class="oum_2cols">
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_enable_title" id="oum_enable_title" <?php 
    echo  ( $oum_enable_title == 'on' ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_enable_title"><?php 
    echo  __( 'Enable', 'open-user-map' ) ;
    ?></label>
                  </div>
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_title_required" id="oum_title_required" <?php 
    echo  ( $oum_title_required ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_title_required"><?php 
    echo  __( 'Required', 'open-user-map' ) ;
    ?></label>
                  </div>
                  <div>
                    <input class="small-text oum_title_maxlength" type="number" min="0" name="oum_title_maxlength" value="<?php 
    echo  ( isset( $oum_title_maxlength ) ? esc_attr( $oum_title_maxlength ) : '' ) ;
    ?>" />
                    <label for="oum_title_maxlength"><?php 
    echo  __( 'Max. length', 'open-user-map' ) ;
    ?></label>
                  </div>
                </div>
                <br>
                <strong><?php 
    echo  __( 'Custom Label:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_title_label" id="oum_title_label" placeholder="<?php 
    echo  esc_attr( $this->oum_title_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_title_label ) ;
    ?>">
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_map_label = get_option( 'oum_map_label' );
    $oum_searchaddress_label = get_option( 'oum_searchaddress_label' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Map“ field', 'open-user-map' ) ;
    ?></th>
              <td>
                <strong><?php 
    echo  __( 'Custom Label:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_map_label" id="oum_map_label" placeholder="<?php 
    echo  esc_attr( $this->oum_map_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_map_label ) ;
    ?>">
                <br><br>
                <strong><?php 
    echo  __( 'Custom Label for Search field:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_searchaddress_label" id="oum_searchaddress_label" placeholder="<?php 
    echo  esc_attr( $this->oum_searchaddress_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_searchaddress_label ) ;
    ?>">
                <br><br>
              </td>
            </tr>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>

              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Filterable Marker Categories', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO and use marker categories. Each category can have a custom marker icon.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label><?php 
        echo  __( 'Enable', 'open-user-map' ) ;
        ?></label>
                  <br>
                  <br>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label><?php 
        echo  __( 'Allow empty selection', 'open-user-map' ) ;
        ?></label>
                  <br>
                  <br>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label><?php 
        echo  __( 'Collapsed filterbox design (on map)', 'open-user-map' ) ;
        ?></label>
                  <br>
                  <br>
                  <strong><?php 
        echo  __( 'Custom Label:', 'open-user-map' ) ;
        ?></strong><br>
                  <input disabled class="regular-text" type="text" value="" placeholder="<?php 
        echo  esc_attr( $this->oum_marker_types_label_default ) ;
        ?>">
                  <br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Custom fields', 'open-user-map' ) ;
    ?>
                <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>

                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to use various field types like links, checkboxes, radio buttons and dropdowns', 'open-user-map' ) ;
        ?></a>

                <?php 
    }
    
    ?>
              </th>
              <td>
                <div class="oum_custom_fields_wrapper">
                  <?php 
    $oum_custom_fields = get_option( 'oum_custom_fields' );
    ?>
                  <table>
                    <thead>
                      <tr>
                        <th><?php 
    echo  __( 'Label', 'open-user-map' ) ;
    ?></th>
                        <th><?php 
    echo  __( 'Required', 'open-user-map' ) ;
    ?></th>
                        <th><?php 
    echo  __( 'Private', 'open-user-map' ) ;
    ?></th>
                        <th><?php 
    echo  __( 'Max. length', 'open-user-map' ) ;
    ?></th>
                        <th><?php 
    echo  __( 'Field type', 'open-user-map' ) ;
    ?> <span class="oum-pro">PRO</span></th>
                        <th><?php 
    echo  __( 'Options', 'open-user-map' ) ;
    ?></th>
                        <th><?php 
    echo  __( 'Description', 'open-user-map' ) ;
    ?></th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php 
    
    if ( is_array( $oum_custom_fields ) ) {
        ?>
                      <?php 
        foreach ( $oum_custom_fields as $index => $custom_field ) {
            ?>
                        <tr>
                          <td>
                            <input type="text" class="field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][label]" placeholder="<?php 
            echo  __( 'Enter label', 'open-user-map' ) ;
            ?>" value="<?php 
            echo  esc_attr( $custom_field['label'] ) ;
            ?>" />
                          </td>
                          <td>
                            <input class="oum-switch field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" id="oum_custom_fields_<?php 
            echo  $index ;
            ?>_required" type="checkbox" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][required]" <?php 
            echo  ( isset( $custom_field['required'] ) ? 'checked' : '' ) ;
            ?> /><label class="field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" for="oum_custom_fields_<?php 
            echo  $index ;
            ?>_required"></label>
                          </td>
                          <td>
                            <input class="oum-switch field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" id="oum_custom_fields_<?php 
            echo  $index ;
            ?>_private" type="checkbox" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][private]" <?php 
            echo  ( isset( $custom_field['private'] ) ? 'checked' : '' ) ;
            ?> /><label class="field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" for="oum_custom_fields_<?php 
            echo  $index ;
            ?>_private"></label>
                          </td>
                          <td>
                            <input class="small-text field-type-text field-type-link" type="number" min="0" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][maxlength]" value="<?php 
            echo  ( isset( $custom_field['maxlength'] ) ? esc_attr( $custom_field['maxlength'] ) : '' ) ;
            ?>" />
                          </td>
                          <td>
                            <select class="oum-custom-field-fieldtype" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][fieldtype]">
                              <?php 
            $available_field_types = $this->oum_custom_field_fieldtypes;
            ?>

                              <?php 
            ?>

                              <?php 
            foreach ( $available_field_types as $value => $label ) {
                ?>
                                <?php 
                $selected = ( isset( $custom_field['fieldtype'] ) && $custom_field['fieldtype'] == $value ? 'selected' : '' );
                ?>

                                <option value="<?php 
                echo  $value ;
                ?>" <?php 
                echo  $selected ;
                ?>><?php 
                echo  $label ;
                ?></option>

                              <?php 
            }
            ?>
                            </select>
                          </td>
                          <td>
                            <input type="text" class="regular-text field-type-checkbox field-type-radio field-type-select" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][options]" placeholder="Red|Blue|Green" value="<?php 
            echo  ( isset( $custom_field['options'] ) ? esc_attr( $custom_field['options'] ) : '' ) ;
            ?>" />
                            <label class="field-type-select oum-custom-field-allow-empty"><input class="field-type-select" type="checkbox" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][emptyoption]" <?php 
            echo  ( isset( $custom_field['emptyoption'] ) ? 'checked' : '' ) ;
            ?> ><?php 
            echo  __( 'add empty option', 'open-user-map' ) ;
            ?></label>
                            <textarea class="regular-text field-type-html" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][html]" placeholder="Enter HTML here"><?php 
            echo  ( isset( $custom_field['html'] ) ? esc_attr( $custom_field['html'] ) : '' ) ;
            ?></textarea>
                          </td>
                          <td>
                            <input type="text" class="field-type-text field-type-link field-type-checkbox field-type-radio field-type-select" name="oum_custom_fields[<?php 
            echo  $index ;
            ?>][description]" placeholder="<?php 
            echo  __( 'Enter description (optional)', 'open-user-map' ) ;
            ?>" value="<?php 
            echo  ( isset( $custom_field['description'] ) ? esc_attr( $custom_field['description'] ) : '' ) ;
            ?>" />
                          </td>
                          <td class="actions">
                            <a class="up" href="#"><span class="dashicons dashicons-arrow-up"></span></a>
                            <a class="down" href="#"><span class="dashicons dashicons-arrow-down"></span></a>
                            <a class="remove_button" href="#"><span class="dashicons dashicons-trash"></span></a>
                          </td>
                        </tr>
                      <?php 
        }
        ?>
                    <?php 
    }
    
    ?>
                    </tbody>

                  </table>

                </div>
                <div>
                  <a href="#" class="oum_add_button button" title="Add field">Add field</a>
                </div>
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_address = get_option( 'oum_enable_address', 'on' );
    $oum_hide_address = get_option( 'oum_hide_address' );
    $oum_enable_gmaps_link = get_option( 'oum_enable_gmaps_link', 'on' );
    $oum_address_label = get_option( 'oum_address_label' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Address“ field', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="oum-switch" type="checkbox" name="oum_enable_address" id="oum_enable_address" <?php 
    echo  ( $oum_enable_address === 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_address"><?php 
    echo  __( 'Enable', 'open-user-map' ) ;
    ?></label><br>

                <input class="oum-switch" type="checkbox" name="oum_hide_address" id="oum_hide_address" <?php 
    echo  ( $oum_hide_address ? 'checked' : '' ) ;
    ?>>
                <label for="oum_hide_address"><?php 
    echo  __( 'Don\'t show address inside location info', 'open-user-map' ) ;
    ?></label><br>
                
                <input class="oum-switch" type="checkbox" name="oum_enable_gmaps_link" id="oum_enable_gmaps_link" <?php 
    echo  ( $oum_enable_gmaps_link === 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_gmaps_link"><?php 
    echo  __( 'Link address to Google Maps', 'open-user-map' ) ;
    ?></label><br>

                <strong><?php 
    echo  __( 'Custom Label:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_address_label" id="oum_address_label" placeholder="<?php 
    echo  esc_attr( $this->oum_address_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_address_label ) ;
    ?>">
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_description = get_option( 'oum_enable_description', 'on' );
    $oum_description_required = get_option( 'oum_description_required' );
    $oum_description_label = get_option( 'oum_description_label' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Description“ field', 'open-user-map' ) ;
    ?></th>
              <td>
                <div class="oum_2cols">
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_enable_description" id="oum_enable_description" <?php 
    echo  ( $oum_enable_description === 'on' ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_enable_description"><?php 
    echo  __( 'Enable', 'open-user-map' ) ;
    ?></label>
                  </div>
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_description_required" id="oum_description_required" <?php 
    echo  ( $oum_description_required ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_description_required"><?php 
    echo  __( 'Required', 'open-user-map' ) ;
    ?></label>
                  </div>
                </div>
                <br>
                <strong><?php 
    echo  __( 'Custom Label:', 'open-user-map' ) ;
    ?></strong><br>
                <input class="regular-text" type="text" name="oum_description_label" id="oum_description_label" placeholder="<?php 
    echo  esc_attr( $this->oum_description_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_description_label ) ;
    ?>">
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_image = get_option( 'oum_enable_image', 'on' );
    $oum_image_required = get_option( 'oum_image_required' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Image upload', 'open-user-map' ) ;
    ?></th>
              <td>
                <div class="oum_2cols">
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_enable_image" id="oum_enable_image" <?php 
    echo  ( $oum_enable_image === 'on' ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_enable_image"><?php 
    echo  __( 'Enable', 'open-user-map' ) ;
    ?></label>
                  </div>
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_image_required" id="oum_image_required" <?php 
    echo  ( $oum_image_required ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_image_required"><?php 
    echo  __( 'Required', 'open-user-map' ) ;
    ?></label>
                  </div>
                </div>
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <?php 
    $oum_enable_audio = get_option( 'oum_enable_audio', 'on' );
    $oum_audio_required = get_option( 'oum_audio_required' );
    ?>
              <th scope="row"><?php 
    echo  __( 'Audio upload', 'open-user-map' ) ;
    ?></th>
              <td>
                <div class="oum_2cols">
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_enable_audio" id="oum_enable_audio" <?php 
    echo  ( $oum_enable_audio === 'on' ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_enable_audio"><?php 
    echo  __( 'Enable', 'open-user-map' ) ;
    ?></label>
                  </div>
                  <div>
                    <input class="oum-switch" type="checkbox" name="oum_audio_required" id="oum_audio_required" <?php 
    echo  ( $oum_audio_required ? 'checked' : '' ) ;
    ?>>
                    <label for="oum_audio_required"><?php 
    echo  __( 'Required', 'open-user-map' ) ;
    ?></label>
                  </div>
                </div>
                <br><br>
              </td>
            </tr>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Max upload size', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to set the maximum file size for image and audio uploads.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <div class="oum_2cols">
                    <div>
                      <strong><?php 
        echo  __( 'Image' ) ;
        ?>:</strong><br>
                      <input disabled class="small-text" type="number" min="1" value="10"></input>MB
                    </div>
                    <div>
                      <strong><?php 
        echo  __( 'Audio' ) ;
        ?>:</strong><br>
                      <input disabled class="small-text" type="number" min="1" value="10"></input>MB
                    </div>
                  </div>
                  <br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'User email notification', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to notify your users after their location proposal has been approved!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  
                  <strong><?php 
        echo  __( 'Subject' ) ;
        ?>:</strong><br>
                  <input disabled class="regular-text" type="text" placeholder="<?php 
        echo  __( 'Your location has been approved', 'open-user-map' ) ;
        ?>"></input><br><br>

                  <strong><?php 
        echo  __( 'Message' ) ;
        ?>:</strong><br>
                  <textarea disabled class="regular-text" rows="8" cols="50" placeholder="<?php 
        echo  __( 'Hey %name%! Your location proposal on %website_url% has been published!', 'open-user-map' ) ;
        ?>"></textarea><br><br>
                  <span class="description"><?php 
        echo  __( 'Available tags' ) ;
        ?>: %name%, %website_url%, %website_name%</span>
                  <br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <tr valign="top">
              <?php 
    $oum_submit_button_label = get_option( 'oum_submit_button_label' );
    ?>
              <th scope="row"><?php 
    echo  __( '„Submit“-Button text', 'open-user-map' ) ;
    ?></th>
              <td>
                <input class="regular-text" type="text" name="oum_submit_button_label" id="oum_submit_button_label" placeholder="<?php 
    echo  __( 'Submit location for review', 'open-user-map' ) ;
    ?>" value="<?php 
    echo  $oum_submit_button_label ;
    ?>"></input><br>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php 
    echo  __( 'Action after submit', 'open-user-map' ) ;
    ?></th>
              <td>
                <select name="oum_action_after_submit" id="oum_action_after_submit">
                  <?php 
    $oum_action_after_submit = ( get_option( 'oum_action_after_submit' ) ? get_option( 'oum_action_after_submit' ) : 'text' );
    $items = array(
        'text'     => __( 'Display message', 'open-user-map' ),
        'refresh'  => __( 'Refresh', 'open-user-map' ),
        'redirect' => __( 'Redirect', 'open-user-map' ),
    );
    foreach ( $items as $val => $label ) {
        $selected = ( $oum_action_after_submit == $val ? 'selected' : '' );
        echo  "<option value='{$val}' {$selected}>{$label}</option>" ;
    }
    ?>
                </select>
                <br><br>
                <div id="oum_action_after_submit_text">
                  <?php 
    $oum_thankyou_headline = get_option( 'oum_thankyou_headline' );
    $oum_thankyou_text = get_option( 'oum_thankyou_text' );
    $oum_addanother_label = get_option( 'oum_addanother_label' );
    ?>
                  <input class="regular-text" type="text" name="oum_thankyou_headline" id="oum_thankyou_headline" placeholder="<?php 
    echo  __( 'Thank you!', 'open-user-map' ) ;
    ?>" value="<?php 
    echo  $oum_thankyou_headline ;
    ?>"></input><br><br>
                  <textarea class="regular-text" name="oum_thankyou_text" id="oum_thankyou_text" rows="4" cols="50" placeholder="<?php 
    echo  __( 'We will check your location suggestion and release it as soon as possible.', 'open-user-map' ) ;
    ?>"><?php 
    echo  $oum_thankyou_text ;
    ?></textarea><br><br>
                  <input class="regular-text" type="text" name="oum_addanother_label" id="oum_addanother_label" placeholder="<?php 
    echo  esc_attr( $this->oum_addanother_label_default ) ;
    ?>" value="<?php 
    echo  esc_attr( $oum_addanother_label ) ;
    ?>">
                </div>
                <div id="oum_action_after_submit_redirect">
                  <?php 
    $oum_thankyou_redirect = get_option( 'oum_thankyou_redirect' );
    ?>
                  <input class="regular-text" type="text" name="oum_thankyou_redirect" id="oum_thankyou_redirect" placeholder="<?php 
    echo  'https://loremipsum.com' ;
    ?>" value="<?php 
    echo  $oum_thankyou_redirect ;
    ?>"></input>
                </div>
              </td>
            </tr>

          </table>

        </div>

        <div id="tab-3" class="tab-pane">

          <table class="form-table">

            <tr valign="top">
              <?php 
    $oum_enable_location_date = get_option( 'oum_enable_location_date' );
    ?>
              <th scope="row">
                <?php 
    echo  __( 'Show location date', 'open-user-map' ) ;
    ?>
              </th>
              <td>
                <input class="oum-switch" type="checkbox" id="oum_enable_location_date" name="oum_enable_location_date" <?php 
    echo  ( $oum_enable_location_date == 'on' ? 'checked' : '' ) ;
    ?>>
                <label for="oum_enable_location_date"></label><br><br>
                <span class="description"><?php 
    echo  __( 'Displays the date when the location was published inside the location bubble.', 'open-user-map' ) ;
    ?></span><br>
              </td>
            </tr>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Public pages for locations (Single pages)', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to enable single pages.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  <span class="description"><?php 
        echo  __( 'This will add a "Read more"-Button to the location bubble. It will link to the location\'s single page.', 'open-user-map' ) ;
        ?></span><br>
                  <span class="description"><?php 
        echo  __( 'In the backend on the "Edit location" page an additional content editor will become available. You can use shortcodes to display individual values of a location. <strong>See the Help section for details.</strong>', 'open-user-map' ) ;
        ?></span><br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Restrict „Add location“ to registered users only', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to enable the „Add location“ feature only to logged in users!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label><?php 
        echo  __( 'Redirect „Add location“-Button to registration page' ) ;
        ?></label><br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Auto-publish for registered users', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to auto-publish location proposals from registered users without your approval!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  <span class="description"><?php 
        echo  __( 'This works only for users with "edit posts" capabilities.', 'open-user-map' ) ;
        ?></span><br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Auto-publish for registered users', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to auto-publish location proposals from unregistered users without your approval!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  <span class="description"><strong><?php 
        echo  __( 'USE WITH CAUTION!', 'open-user-map' ) ;
        ?></strong> <?php 
        echo  __( 'Every location proposal will be published directly without your verification. No user registration is necessary.', 'open-user-map' ) ;
        ?></span><br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Extend WordPress user registration form with „Add location“ map', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to allow users to add their location within registration. Create a map of your registered users!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label>
                </td>
              </tr>

            <?php 
    }
    
    ?>

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Admin email notification on new location proposals', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to get notified instantly when a new location proposal has been added!', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <input class="oum-switch" type="checkbox" disabled>
                  <label></label><br><br>
                  
                  <strong><?php 
        echo  __( 'Email address' ) ;
        ?>:</strong><br>
                  <input disabled class="regular-text" type="text" placeholder="<?php 
        echo  __( 'john@doe.com', 'open-user-map' ) ;
        ?>"></input><br><br>
                  
                  <strong><?php 
        echo  __( 'Subject' ) ;
        ?>:</strong><br>
                  <input disabled class="regular-text" type="text" placeholder="<?php 
        echo  __( 'New Open User Map location', 'open-user-map' ) ;
        ?>"></input><br><br>

                  <strong><?php 
        echo  __( 'Message' ) ;
        ?>:</strong><br>
                  <textarea disabled class="regular-text" rows="8" cols="50" placeholder="<?php 
        echo  __( 'A new location with the title "%title%" on %website_url% has been added! Please verify and publish or use the "auto-publish" feature.', 'open-user-map' ) ;
        ?>"></textarea><br><br>
                  <span class="description"><?php 
        echo  __( 'Available tags' ) ;
        ?>: %title%, %website_url%, %website_name%</span>
                  <br><br>
                </td>
              </tr>

            <?php 
    }
    
    ?>

          </table>

        </div>

        <div id="tab-4" class="tab-pane">

          <table class="form-table">

            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Export all Locations', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to export your locations.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <button disabled class="button button-secondary"><?php 
        echo  __( 'Export to CSV', 'open-user-map' ) ;
        ?></button>
                  <br><br>
                  <div class="description">
                    <strong>This is how the export works:</strong><br>
                    <ul>
                      <li>Only published locations will be exported</li>
                      <li>The CSV uses Comma as delimiter</li>
                    </ul>
                  </div>
                </td>
              </tr>

            <?php 
    }
    
    ?>


            <?php 
    ?>

            <?php 
    
    if ( !oum_fs()->can_use_premium_code() ) {
        ?>
              
              <tr valign="top" class="oum-gopro-tr">
                <th scope="row">
                  <?php 
        echo  __( 'Import all Locations', 'open-user-map' ) ;
        ?>
                  <br><span class="oum-pro">PRO</span><br>
                  <a class="oum-gopro-text" href="<?php 
        echo  oum_fs()->get_upgrade_url() ;
        ?>"><?php 
        echo  __( 'Upgrade to PRO to import your locations.', 'open-user-map' ) ;
        ?></a>
                </th>
                <td>
                  <div class="csv_upload">
                    <button disabled class="button button-secondary"><?php 
        echo  __( 'Upload CSV & Import', 'open-user-map' ) ;
        ?></button>
                    <br><br>
                    <div class="description">
                      <strong>This is important to make the import work:</strong><br>
                      <ul>
                        <li>Be aware that every location with matching POST ID will be overwritten. <span style="color: red">Consider creating a DB Backup before!</span></li>
                        <li>To import new locations leave values in the post_id column empty</li>
                        <li>Download an Export file first and use it as template for your import</li>
                        <li>Comma or Semicolon work as delimiter</li>
                        <li>Non-existing Marker Categories will be created automatically</li>
                        <li>Multiselect values need to be written like so: [Red|Green|Blue]</li>
                        <li>All imported locations will have status "Draft". You need to publish them yourself.</li>
                      </ul>
                    </div>
                  </div>
                </td>
              </tr>

            <?php 
    }
    
    ?>

          </table>

        </div>
        
        <div id="tab-5" class="tab-pane">

          <table class="form-table">

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Getting started', 'open-user-map' ) ;
    ?>
              </th>
              <td class="top-padding-20">
                <?php 
    echo  sprintf( __( '<ol><li>Use Gutenberg or Elementor to insert the Block/Widget <b>Open User Map</b> into a page. A shortcode <code>[open-user-map]</code> is also available.</li><li>You can <a href="%s">manage locations</a> in the “OUM Locations” menu.</li><li>Configure styles and features in <a href="%s">Settings > Open User Map</a></li></ol>', 'open-user-map' ), 'edit.php?post_type=oum-location', 'options-general.php?page=open_user_map' ) ;
    ?>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Gutenberg Block', 'open-user-map' ) ;
    ?>
              </th>
              <td class="top-padding-20">
                <?php 
    echo  __( 'Use the Gutenberg Block “Open User Map” to integrate the map inside your page. <br>You can set custom map position and filter for categories and locations inside the block settings.', 'open-user-map' ) ;
    ?>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Elementor Widget', 'open-user-map' ) ;
    ?>
              </th>
              <td class="top-padding-20">
                <?php 
    echo  __( 'Use the Elementor Widget “Open User Map” to integrate the map inside your page. <br>You can set custom map position and filter for categories and locations inside the widget settings.', 'open-user-map' ) ;
    ?>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php 
    echo  __( 'Place the shortcode anywhere in your content or integrate it within your theme template with PHP', 'open-user-map' ) ;
    ?></th>
              <td class="top-padding-20">
                <strong>Shortcode:</strong><br><br>
                <code>[open-user-map]</code><br>
                <p class="hint"><?php 
    echo  __( 'Displays the Map with all locations.', 'open-user-map' ) ;
    ?></p>
                <br><br>

                <strong>PHP:</strong><br><br>
                <code>&lt;?php echo do_shortcode('[open-user-map]'); ?&gt;</code>
                <br><br><br>

                <strong><?php 
    echo  __( 'Shortcode attributes:', 'open-user-map' ) ;
    ?></strong><br><br>

                <code>lat="51.50665732176545" long="-0.12752251529432854" zoom="13"</code><br>
                <p class="hint"><?php 
    echo  __( 'Set an individual map position with lat, long and zoom.', 'open-user-map' ) ;
    ?></p><br><br>
                
                <code>types="food|drinks" ids="123"</code><br>
                <p class="hint"><?php 
    echo  __( 'Filter locations by types (Marker Categories) or <a href="https://gigapress.net/how-to-find-a-page-id-or-post-id-in-wordpress/" target="_blank">Post ID</a>. Separate multiple Types or Post IDs with a | symbol.', 'open-user-map' ) ;
    ?></p><br><br>
                
                <code>size="default|fullwidth" size_mobile="square|landscape|portrait"</code><br>
                <p class="hint"><?php 
    echo  __( 'Set a custom size.', 'open-user-map' ) ;
    ?></p><br><br>
                
                <code>height="400px" height_mobile="300px"</code><br>
                <p class="hint"><?php 
    echo  __( 'Set a custom height.', 'open-user-map' ) ;
    ?></p><br><br>
                
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php 
    echo  __( 'Additional Shortcodes', 'open-user-map' ) ;
    ?></th>
              <td class="top-padding-20">
                <span class="oum-pro">PRO</span> <code>[open-user-map-location value="Favorite color" post_id="12345"]</code> 
                <br><br>
                <span class="hint"><?php 
    echo  __( 'Display specific values from a location. The POST_ID attribute is optional. Alternatively use the PHP function <code>oum_get_location_value( $value, $post_id )</code> in case you just want to return the value.', 'open-user-map' ) ;
    ?></span>
                <br><br>
                <strong><?php 
    echo  __( 'These values are available:', 'open-user-map' ) ;
    ?></strong>
                <ul>
                  <li>title</li>
                  <li>image</li>
                  <li>audio</li>
                  <li>type</li>
                  <li>map</li>
                  <li>address</li>
                  <li>lat</li>
                  <li>lng</li>
                  <li>text</li>
                  <li>notification</li>
                  <li>author_name</li>
                  <li>author_email</li>
                  <li>user_id</li>
                  <li>CUSTOM FIELD LABEL</li>
                </ul>
                <br><br><br>
                <span class="oum-pro">PRO</span> <code>[open-user-map-gallery url="https://mysite.com/" number="10"]</code> 
                <br><br>
                <span class="hint"><?php 
    echo  __( 'Get a nice gallery view of all the location images. Each image is linked to the location marker on the map. Use the URL attribute to link the images to another page. Use the NUMBER attribute to limit the number of images. Both attributes are optional.', 'open-user-map' ) ;
    ?></span>
                <br><br>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php 
    echo  __( 'URL parameters', 'open-user-map' ) ;
    ?></th>
              <td class="top-padding-20">
                <code>?markerid=123</code> <span class="hint"><?php 
    echo  __( '123 can be the post_id of any public location. Add the parameter to the URL to auto-open a specific location.', 'open-user-map' ) ;
    ?></span><br><br>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row"><?php 
    echo  __( 'Conditional Fields (experimental)', 'open-user-map' ) ;
    ?></th>
              <td class="top-padding-20">
                <span class="hint"><?php 
    echo  __( 'Show or Hide a Custom Field based on the selected value of a field.', 'open-user-map' ) ;
    ?></span><br><br>
                <strong><?php 
    echo  __( 'Use this Javascript function in your template:', 'open-user-map' ) ;
    ?></strong><br><br>
                <code class="block">/**
                  * OUM: Conditional Field
                  * 
                  * sourceField   Element that defines the condition
                  * targetField   Element to show or hide
                  * condShow      Array of values that lead to show
                  * condHide      Array of values that lead to hide
                  */
                  oumConditionalField(sourceField, targetField, condShow, condHide);
                </code><br><br>
                <strong><?php 
    echo  __( 'Example:', 'open-user-map' ) ;
    ?></strong><br><br>
                <code>
                  oumConditionalField('[name="oum_marker_icon"]', '[name="oum_location_custom_fields[1645650268221]"]', ['30', '31'], ['']);
                </code>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Troubleshooting', 'open-user-map' ) ;
    ?>
              </th>
              <td class="top-padding-20">
                <?php 
    echo  __( 'Please have a look at the <a href="https://wordpress.org/plugins/open-user-map/#faq" target="_blank">FAQ</a>. We keep it up to date.', 'open-user-map' ) ;
    ?>
              </td>
            </tr>

            <tr valign="top">
              <th scope="row">
                <?php 
    echo  __( 'Debug Info', 'open-user-map' ) ;
    ?>
              </th>
              <td class="top-padding-20">
                <?php 
    echo  __( 'You can copy & paste this info and send it as email to our support in case we need to debug something:', 'open-user-map' ) ;
    ?><br><br>
                <div class="oum-debug-info">
                  <ul>
                    <li>Plugin: <?php 
    echo  get_plugin_data( $this->plugin_path . 'open-user-map.php', false )['Name'] ;
    ?></li>
                    <li>Plugin version: <?php 
    echo  $this->plugin_version ;
    ?></li>
                    <li>Server: <?php 
    echo  $_SERVER['SERVER_NAME'] ;
    ?></li>
                    <li>Server Software: <?php 
    echo  $_SERVER['SERVER_SOFTWARE'] ;
    ?></li>
                    <li>PHP version: <?php 
    echo  phpversion() ;
    ?></li>
                    <li>log_errors: <?php 
    echo  ini_get( 'log_errors' ) ;
    ?></li>
                    <li>output_buffering: <?php 
    echo  ini_get( 'output_buffering' ) ;
    ?></li>
                    <li>memory_limit: <?php 
    echo  ini_get( 'memory_limit' ) ;
    ?></li>
                    <li>upload_max_filesize: <?php 
    echo  ini_get( 'upload_max_filesize' ) ;
    ?></li>
                    <li>max_file_uploads: <?php 
    echo  ini_get( 'max_file_uploads' ) ;
    ?></li>
                    <li>max_input_vars: <?php 
    echo  ini_get( 'max_input_vars' ) ;
    ?></li>
                    <li>post_max_size: <?php 
    echo  ini_get( 'post_max_size' ) ;
    ?></li>
                    <li>
                      <br>
                      Last PHP error/warning:
                      <pre><?php 
    print_r( error_get_last() );
    ?></pre>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>

          </table>

        </div>

      </div>

      <?php 
    submit_button();
    ?>

    <?php 
}

?>

</form>
</div>