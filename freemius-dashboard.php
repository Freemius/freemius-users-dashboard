<?php
    /**
     * Plugin Name: Freemius Users Dashboard
     * Plugin URI:  https://freemius.com/
     * Description: Embeddable Users Dashboard for Freemius powered shops and products.
     * Version:     1.0.0
     * Author:      Freemius
     * Author URI:  https://freemius.com
     * License:     MIT
     */

    /**
     * @package     Freemius Cleanup
     * @copyright   Copyright (c) 2018, Freemius, Inc.
     * @license     https://opensource.org/licenses/mit MIT License
     * @since       1.0.0
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! defined( 'WP_FS__MEMBERS_DASHBOARD_DEBUG' ) ) {
        define( 'WP_FS__MEMBERS_DASHBOARD_DEBUG', false );
    }

    if ( ! defined( 'WP_FS__MEMBERS_DASHBOARD_SUBDOMAIN' ) ) {
        define( 'WP_FS__MEMBERS_DASHBOARD_SUBDOMAIN', WP_FS__MEMBERS_DASHBOARD_DEBUG ?
            'http://users.freemius-local.com:4200/dashboard.js' :
            'https://users.freemius.com/dashboard.js'
        );
    }

    /**
     * Example:
     *  [fs_members store_id="<storeID>" public_key="<storePublicKey>" position="fixed" left="0" right="0" top="195px" bottom="0"]
     *
     * @param      $atts
     * @param null $inner
     *
     * @return string
     */
    function fs_members_dashboard_shortcode( $atts, $inner = null ) {
        $store_id = isset( $atts['store_id'] ) && is_numeric( $atts['store_id'] ) ? $atts['store_id'] : null;
        $public_key = isset( $atts['public_key'] ) && is_string( $atts['public_key'] ) ? $atts['public_key'] : null;

        if ( ! is_numeric( $store_id ) || empty($public_key) ) {
            return '<p style="font-weight: bold; color: red;">You have to specify the store_id and its public_key to embed the Freemius members dashboard securely to your site.</p>';
        }

        $product_id = isset( $atts['product_id'] ) && is_numeric( $atts['product_id'] ) ? $atts['product_id'] : null;

        $css = array(
            'position' => 'relative',
            'top'      => 'auto',
            'bottom'   => 'auto',
            'left'     => 'auto',
            'right'    => 'auto',
            'zIndex'   => '2',
        );

        foreach ( $css as $k => $v ) {
            if ( isset( $atts[ $k ] ) ) {
                $css[ $k ] = $atts[ $k ];
            }
        }

        // Fix props.
        $numeric_props = array( 'top' => true, 'bottom' => true, 'left' => true, 'right' => true );

        foreach ( $css as $k => $v ) {
            if ( ! isset( $numeric_props[ $k ] ) ) {
                continue;
            }

            if ( is_numeric( $v ) ) {
                $css[ $k ] = "{$v}px";
            }
        }

        $cache_killer = WP_FS__MEMBERS_DASHBOARD_DEBUG ?
                // Clear cache every time on debug mode.
                date('Y-m-d H:i:s') :
                // Clear cache on an hourly basis.
                date('Y-m-d H');

        return '
<script type="text/javascript" src="' . WP_FS__MEMBERS_DASHBOARD_SUBDOMAIN . '?ck=' . $cache_killer . '"></script>
<script id="fs_dashboard_anchor" type="text/javascript">
	(function(){
		FS.Members.configure({
			css:        ' . json_encode( $css ) . ',
			public_key: \'' . $public_key . '\',
			' . ( is_numeric( $store_id ) ? "store_id:   '" . $store_id . "'" : '' ) .
               ( is_numeric( $product_id ) ? "product_id: '" . $product_id . "'" : '' ) . '
		}).open();
	})();
</script>
';
    }

    function fs_add_members_dashboard_shortcode() {
        wp_enqueue_style( 'jquery' );
        add_shortcode( 'fs_members', 'fs_members_dashboard_shortcode' );
    }

    add_action( 'init', 'fs_add_members_dashboard_shortcode' );