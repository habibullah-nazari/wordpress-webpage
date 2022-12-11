import 'core-js';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { Dashicon } from '@wordpress/components';

const { TextControl } = wp.components;
const { SelectControl } = wp.components;

registerBlockType( 'open-user-map/map', {
    apiVersion: 2,
    title: __( 'Open User Map', 'open-user-map' ),
    description: __('Let your visitors add locations directly from within the map.', 'open-user-map'),
    icon: 'location-alt',
    category: 'widgets',
    example: {},
    attributes: {
        lat: {
            type: 'string',
        },
        long: {
            type: 'string',
        },
        zoom: {
            type: 'string',
        },
        types: {
            type: 'string',
        },
        ids: {
            type: 'string',
        },
        size: {
            type: 'string',
        },
        size_mobile: {
            type: 'string',
        },
        height: {
            type: 'string',
        },
        height_mobile: {
            type: 'string',
        },
    },
    edit: ({attributes, setAttributes}) => {
        const blockProps = useBlockProps();

        // Render
        return ([
            <div { ...blockProps }>
                <div class="hint">
                    <h5>{ __('Open User Map', 'open-user-map') }</h5>
                    <p>
                        { __('This block will show your', 'open-user-map') } <a href="edit.php?post_type=oum-location">{ __('Locations', 'open-user-map') }</a> { __('on a map in the front end.', 'open-user-map') } <a class="link-oum-settings" href="options-general.php?page=open_user_map"><Dashicon icon="admin-generic" />{ __('Settings', 'open-user-map') }</a>
                    </p>
                    <div class="oum-custom-settings">
                        <p class="custom-settings-label">
                            <strong>{ __('Custom settings (optional):', 'open-user-map') }</strong>
                            { __('Feel free to customize initial map position (Latitude, Longitude & Zoom) or filter locations by categories or ids. This will override the general configuration from the', 'open-user-map') } <a href="options-general.php?page=open_user_map">{ __('settings', 'open-user-map') }</a>.<br /><br />
                        </p>
                        <div class="flex">
                            <TextControl 
                                label="Latitude"
                                value={attributes.lat}
                                onChange={(val) => setAttributes({ lat: val })}
                                placeholder="e.g. 51.50665732176545"
                            /> 
                            <TextControl 
                                label="Longitude"
                                value={attributes.long}
                                onChange={(val) => setAttributes({ long: val })}
                                placeholder="e.g. -0.12752251529432854"
                            /> 
                            <TextControl 
                                label="Zoom"
                                value={attributes.zoom}
                                onChange={(val) => setAttributes({ zoom: val })}
                                placeholder="e.g. 13"
                            />
                        </div>
                        <div class="flex">
                            <TextControl 
                                label="Filter by Marker Categories [PRO]"
                                value={attributes.types}
                                onChange={(val) => setAttributes({ types: val })}
                                placeholder="separate multiple slugs with |"
                            />
                            <TextControl 
                                label="Filter by Post IDs"
                                value={attributes.ids}
                                onChange={(val) => setAttributes({ ids: val })}
                                placeholder="separate multiple IDs with |"
                            />
                        </div>
                        <div class="flex">
                            <SelectControl 
                                label="Size"
                                value={attributes.size}
                                onChange={(val) => setAttributes({ size: val })}
                                options={ [
                                    { label: '', value: '' },
                                    { label: 'Content Width', value: 'default' },
                                    { label: 'Full Width', value: 'fullwidth' },
                                ] }
                            />
                            <SelectControl 
                                label="Size (mobile)"
                                value={attributes.size_mobile}
                                onChange={(val) => setAttributes({ size_mobile: val })}
                                options={ [
                                    { label: '', value: '' },
                                    { label: 'Square', value: 'square' },
                                    { label: 'Landscape', value: 'landscape' },
                                    { label: 'Portrait', value: 'portrait' },
                                ] }
                            />
                        </div>
                        <div class="flex">
                            <TextControl 
                                label="Height"
                                value={attributes.height}
                                onChange={(val) => setAttributes({ height: val })}
                                placeholder="px"
                            />
                            <TextControl 
                                label="Height (mobile)"
                                value={attributes.height_mobile}
                                onChange={(val) => setAttributes({ height_mobile: val })}
                                placeholder="px"
                            />
                        </div>
                    </div>
                </div>
            </div>
        ]);
    },
    save: () => { 
        return null // use PHP
    } 
} );