document.addEventListener('DOMContentLoaded', function(e) {

  function iOS() {
    return [
        'iPad Simulator',
        'iPhone Simulator',
        'iPod Simulator',
        'iPad',
        'iPhone',
        'iPod'
      ].includes(navigator.platform)
      // iPad on iOS 13 detection
      ||
      (navigator.userAgent.includes("Mac") && "ontouchend" in document)
  }

  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    const regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  const POPUP_MARKER_ID = getParameterByName('markerid');
  const enableFullscreen = (!iOS() && oum_enable_fullscreen) ? true : false;

  // init map and add fulscreen option
  const map = L.map(map_el, {
    gestureHandling: true,
    minZoom: (oum_minimum_zoom_level) ? oum_minimum_zoom_level : '',
    fullscreenControl: enableFullscreen,
    fullscreenControlOptions: {
      position: 'topleft',
      fullscreenElement: document.querySelector('.open-user-map .map-wrap'),
    }
  });

  // Handle "Add Location" popup DOM placement on fullscreen mode
  const addLocationPopup = document.querySelector('#add-location-overlay');
  const originalContainer = addLocationPopup.parentElement;
  const fullscreenContainer = document.querySelector('.open-user-map .map-wrap');

  map.on('enterFullscreen', function () {
    fullscreenContainer.appendChild(addLocationPopup);
  });

  map.on('exitFullscreen', function () {
    originalContainer.appendChild(addLocationPopup);
  });
  

  //make map reloadable (oumMap.invalidateSize()) after some preloader is ready
  oumMap = map;

  const mapWidth578Ratio = document.getElementById(map_el).offsetWidth / 578;
  const mapHeight408Ratio = document.getElementById(map_el).offsetHeight / 408;
  const zoomOffset = 1.2;
  let inititalMapBounds = [];

  // Render map
  (function() {
    let mapZoom = parseFloat(start_zoom) + parseFloat(Math.min(mapWidth578Ratio, mapHeight408Ratio)) - parseFloat(zoomOffset);
    mapZoom = mapZoom > 20 ? 20 : mapZoom < 0 ? 0 : mapZoom

    // Center map
    map.setView([start_lat, start_lng], mapZoom);

    inititalMapBounds = map.getBounds().pad(0.1); //+10% tolerance

    // Bound map to fixed position
    if (oum_enable_fixed_map_bounds) {
      map.setMaxBounds(inititalMapBounds);
    }

    // Set map style
    if (mapStyle == 'Custom1') {
      L.tileLayer('http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png').addTo(map);
      L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
        tileSize: 512,
        zoomOffset: -1
      }).addTo(map);
    } else if (mapStyle == 'Custom2') {
      L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}.png').addTo(map);
      L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
        tileSize: 512,
        zoomOffset: -1
      }).addTo(map);
    } else if (mapStyle == 'Custom3') {
      L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}.png').addTo(map);
      L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
        tileSize: 512,
        zoomOffset: -1
      }).addTo(map);
    } else {
      // Default
      L.tileLayer.provider(mapStyle).addTo(map);
    }

    // Render locations

    // Parent Layer (has subgroups of markers)
    let markers;
    if (!oum_enable_cluster) {
      markers = L.layerGroup({
        chunkedLoading: true
      });
    } else {
      markers = L.markerClusterGroup({
        showCoverageOnHover: false,
        removeOutsideVisibleBounds: false,
        maxClusterRadius: 40,
        chunkedLoading: true
      });
    }

    markers.addTo(map);

    // Control: Legend (toggle marker subgroups)
    const legendControl = L.control.layers(null, null, {
      collapsed: oum_collapse_filter,
      position: 'bottomright'
    });

    // Control: get current location
    if (oum_enable_currentlocation) {
      L.control.locate({
        flyTo: true,
        initialZoomLevel: 12,
        drawCircle: false,
        drawMarker: false
      }).addTo(map);
    }

    // Control: search address
    if (oum_enable_searchaddress) {
      const searchControl = new GeoSearch.GeoSearchControl({
        style: 'bar',
        showMarker: false,
        provider: new GeoSearch.OpenStreetMapProvider(),
        searchLabel: oum_searchaddress_label,
        updateMap: false,
      });
      map.addControl(searchControl);
    }

    //Event: click on geosearch result
    map.on('geosearch/showlocation', function(e) {
      let isInBounds = inititalMapBounds.contains(e.marker._latlng);
      const searchBar = document.querySelector(`#${map_el} .leaflet-geosearch-bar form`);

      if(!isInBounds && oum_enable_fixed_map_bounds) {
        console.log('This search result is out of reach.');
        searchBar.style.boxShadow = "0 0 10px rgb(255, 111, 105)";
        setTimeout(function() {
          searchBar.style.boxShadow = "0 1px 5px rgba(255, 255, 255, 0.65)";
        }, 2000);
      }else{
        map.flyToBounds(e.location.bounds);
      }
    });

    // Handle locations grouped by types
    if(locations_by_type.length > 0) {

      let markerGroups = [];

      //add legend
      legendControl.addTo(map);
      
      //create marker groups (empty)
      locations_by_type.forEach(function(typeGroup, index) {
        markerGroups[index] = L.featureGroup.subGroup(markers); //group1, group2, ...
        legendControl.addOverlay(markerGroups[index], `<img src="${typeGroup.icon}">${typeGroup.name}`);
      });

      locations_by_type.forEach(function(typeGroup, index){
        
        //add locations to each marker group
        for (let i = 0; i < typeGroup.locations.length; i++) {
          let marker = L.marker(
            [
              typeGroup.locations[i].lat,
              typeGroup.locations[i].lng
            ], {
              post_id: typeGroup.locations[i].post_id,
              icon: L.icon({
                iconUrl: typeGroup.locations[i].icon,
                iconSize: [26, 41],
                iconAnchor: [13, 41],
                popupAnchor: [0, -25],
                shadowUrl: marker_shadow_url,
                shadowSize: [41, 41],
                shadowAnchor: [13, 41]
              })
            }
          );
          marker.bindPopup(typeGroup.locations[i].content);
          marker.addTo(markerGroups[index]);
        }

        //add marker group to map
        markerGroups[index].addTo(map);

        //open marker popup on ?markerid=123
        markerGroups[index].eachLayer(function(layer){
          if(layer.options.post_id && layer.options.post_id == POPUP_MARKER_ID){
            if(!layer._icon) {
              map.fitBounds(layer.__parent._bounds);
            }else{
              map.setView(layer.getLatLng(), 9);
            }
            layer.openPopup();
          }
        });
      });

    }

    // Handle locations without types
    if(locations_without_type.length > 0) {
      let markerGroup = L.featureGroup.subGroup(markers);

      for (let i = 0; i < locations_without_type.length; i++) {
        let marker = L.marker(
          [
            locations_without_type[i].lat,
            locations_without_type[i].lng
          ], {
            post_id: locations_without_type[i].post_id,
            icon: L.icon({
              iconUrl: locations_without_type[i].icon,
              iconSize: [26, 41],
              iconAnchor: [13, 41],
              popupAnchor: [0, -25],
              shadowUrl: marker_shadow_url,
              shadowSize: [41, 41],
              shadowAnchor: [13, 41]
            })
          }
        );
        marker.bindPopup(locations_without_type[i].content);
        marker.addTo(markerGroup);
      }

      //add marker group to map
      markerGroup.addTo(map);

      //open marker popup on ?markerid=123
      markerGroup.eachLayer(function(layer){
        if(layer.options.post_id && layer.options.post_id == POPUP_MARKER_ID){
          if(!layer._icon) {
            map.fitBounds(layer.__parent._bounds);
          }else{
            map.setView(layer.getLatLng(), 9);
          }
          layer.openPopup();
        }
      });
    }


  })();

  // Event: "Add location" Button click
  if (document.getElementById('open-add-location-overlay') != null) {
    //init form map
    const map2 = L.map('mapGetLocation', {
      gestureHandling: true,
      minZoom: (oum_minimum_zoom_level) ? oum_minimum_zoom_level : '',
    });

    // Activate Map inside overlay
    (function() {

      let markerIsVisible = false;

      // Set map style
      if (mapStyle == 'Custom1') {
        L.tileLayer('http://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png').addTo(map2);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
          tileSize: 512,
          zoomOffset: -1
        }).addTo(map2);
      } else if (mapStyle == 'Custom2') {
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}.png').addTo(map2);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
          tileSize: 512,
          zoomOffset: -1
        }).addTo(map2);
      } else if (mapStyle == 'Custom3') {
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_nolabels/{z}/{x}/{y}.png').addTo(map2);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_only_labels/{z}/{x}/{y}{r}.png', {
          tileSize: 512,
          zoomOffset: -1
        }).addTo(map2);
      } else {
        // Default
        L.tileLayer.provider(mapStyle).addTo(map2);
      }

      const search = new GeoSearch.GeoSearchControl({
        style: 'bar',
        showMarker: false,
        provider: new GeoSearch.OpenStreetMapProvider(),
        searchLabel: oum_searchaddress_label,
        updateMap: false,
      });
      map2.addControl(search);

      // Add control: get current location
      if (oum_enable_currentlocation) {
        L.control.locate({
          flyTo: true,
          initialZoomLevel: 12,
          drawCircle: false,
          drawMarker: false
        }).addTo(map2);
      }

      //define marker

      // Marker Icon
      let markerIcon = L.icon({
        iconUrl: marker_icon_url,
        iconSize: [26, 41],
        iconAnchor: [13, 41],
        popupAnchor: [0, -25],
        shadowUrl: marker_shadow_url,
        shadowSize: [41, 41],
        shadowAnchor: [13, 41]
      });

      let locationMarker = L.marker([0, 0], {
        icon: markerIcon
      }, {
        'draggable': true
      });

      //initial map view
      map2.setView([start_lat, start_lng], start_zoom);

      // Bound map to fixed position
      if (oum_enable_fixed_map_bounds) {
        map2.setMaxBounds(inititalMapBounds);
      }

      //Event: click on map to set marker OR location found
      map2.on('click locationfound', function(e) {
        let coords = e.latlng;

        locationMarker.setLatLng(coords);

        if (!markerIsVisible) {
          locationMarker.addTo(map2);
          markerIsVisible = true;
        }

        setLocationLatLng(coords);
      });

      //Event: geosearch success
      map2.on('geosearch/showlocation', function(e) {
        let coords = e.marker._latlng;
        let label = e.location.label;
        let isInBounds = inititalMapBounds.contains(coords);
        const searchBar = document.querySelector(`#mapGetLocation .leaflet-geosearch-bar form`);

        if(!isInBounds && oum_enable_fixed_map_bounds) {
          console.log('This search result is out of reach.');
          searchBar.style.boxShadow = "0 0 10px rgb(255, 111, 105)";
          setTimeout(function() {
            searchBar.style.boxShadow = "0 1px 5px rgba(255, 255, 255, 0.65)";
          }, 2000);
        }else{
          map2.flyToBounds(e.location.bounds);
          
          locationMarker.setLatLng(coords);

          if (!markerIsVisible) {
            locationMarker.addTo(map2);
            markerIsVisible = true;
          }

          setLocationLatLng(coords);
          setAddress(label);
        }
      });

      //Event: drag marker
      locationMarker.on('dragend', function(e) {
        setLocationLatLng(e.target.getLatLng());
      });

      //Validation for required checkbox groups
      jQuery('#oum_add_location input[type="submit"]').on('click', function() {
        let required_fieldsets = jQuery('#oum_add_location fieldset.is-required');

        required_fieldsets.each(function() {
          $cbx_group = jQuery(this).find('input:checkbox');
          $cbx_group.prop('required', true);
          if($cbx_group.is(":checked")){
            $cbx_group.prop('required', false);
          }
        });
      });

      //set lat & lng input fields
      function setLocationLatLng(markerLatLng) {
        console.log(markerLatLng);

        jQuery('#oum_location_lat').val(markerLatLng.lat);
        jQuery('#oum_location_lng').val(markerLatLng.lng);
      }

      //set address field
      function setAddress(label) {
        jQuery('#oum_location_address').val(label);
      }

    })();

    document.getElementById('open-add-location-overlay').addEventListener('click', function(event) {

      // show overlay
      document.getElementById('add-location-overlay').classList.add('active');

      // scroll to top of overlay
      window.scrollTo(0, document.getElementById('add-location-overlay').getBoundingClientRect().top + scrollY);

      //reposition map
      setTimeout(function() {
        map2.invalidateSize();
        map2.setView([start_lat, start_lng], start_zoom);
      }, 0);
    });

    // Event: click on "notify on publish"
    if (document.getElementById('oum_location_notification') != null) {
      document.getElementById('oum_location_notification').addEventListener('change', function(event) {
        if (this.checked) {
          document.getElementById('oum_author').classList.add('active');
        } else {
          document.getElementById('oum_author').classList.remove('active');
        }
      });
    }

    // Events: close "Add location" overlay
    if (document.getElementById('close-add-location-overlay') != null) {
      
      // Event: Close "Add location" popup on X
      document.getElementById('close-add-location-overlay').addEventListener('click', function(event) {
        document.getElementById('add-location-overlay').classList.remove('active');
      });

      // Event: Close "Add location" popup on ESC key
      document.onkeydown = function(evt) {
        evt = evt || window.event;
        if(evt.key === "Escape") {
            document.getElementById('close-add-location-overlay').click();
        }
      };

      // Event: CLose "Add location" popup on click on backdrop
      document.getElementById('add-location-overlay').addEventListener('click', function(event) {
        if (event.target !== this) return;
        document.getElementById('close-add-location-overlay').click();
      });
    }

    // Event: Remove uploaded image
    if (document.getElementById('oum_remove_image') != null) {
      document.getElementById('oum_remove_image').addEventListener('click', function() {
        document.getElementById('oum_location_image').value = '';
        document.getElementById('oum_location_image').nextElementSibling.classList.remove('active');
        document.getElementById('oum_location_image').nextElementSibling.querySelector('span').textContent = '';
      });
    }

    // Event: Remove uploaded audio
    if (document.getElementById('oum_remove_audio') != null) {
      document.getElementById('oum_remove_audio').addEventListener('click', function() {
        document.getElementById('oum_location_audio').value = '';
        document.getElementById('oum_location_audio').nextElementSibling.classList.remove('active');
        document.getElementById('oum_location_audio').nextElementSibling.querySelector('span').textContent = '';
      });
    }

    // Event: add another location
    if (document.getElementById('oum_add_another_location') != null) {
      document.getElementById('oum_add_another_location').addEventListener('click', function() {
        document.getElementById('oum_add_location').style.display = 'block';
        document.getElementById('oum_add_location_error').style.display = 'none';
        document.getElementById('oum_add_location_thankyou').style.display = 'none';
  
        //reposition map
        setTimeout(function() {
          map2.invalidateSize();
          map2.setView([start_lat, start_lng], start_zoom);
        }, 0);
  
        //reset media previews
        if(document.getElementById('oum_location_image')) {
          document.getElementById('oum_location_image').value = '';
          document.getElementById('oum_location_image').nextElementSibling.classList.remove('active');
          document.getElementById('oum_location_image').nextElementSibling.querySelector('span').textContent = '';
        }
  
        if(document.getElementById('oum_location_audio')) {
          document.getElementById('oum_location_audio').value = '';
          document.getElementById('oum_location_audio').nextElementSibling.classList.remove('active');
          document.getElementById('oum_location_audio').nextElementSibling.querySelector('span').textContent = '';
        }
      });
    }

    if(document.getElementById('oum_location_image') != null) {
      document.getElementById('oum_location_image').addEventListener('change', updatePreview);
    }

    if(document.getElementById('oum_location_audio') != null) {
      document.getElementById('oum_location_audio').addEventListener('change', updatePreview)
    }

    function updatePreview() {
      this.nextElementSibling.classList.add('active');
      this.nextElementSibling.querySelector('span').textContent = this.files[0].name;
    }
  }

});
