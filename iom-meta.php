<?php
/*
Plugin Name: IOM Meta
Plugin URI: https://nicolajreck.dk
Description: A plugin that creates a custom post type with meta fields
Version: 1.0
Author: Nicolaj Reck
Author URI: http://nicolajreck.dk
Text Domain: iom-meta
*/

/*Init cmb2*/
if ( file_exists( dirname( __FILE__ ) . '/includes/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/includes/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/includes/CMB2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/includes/CMB2/init.php';
}

/*Add custom post type */
function create_iom_post_type() {
    register_post_type( 'iom',
        array(
            'labels' => array(
                'name' => __( 'IOM meta' ),
                'singular_name' => __( 'IOM meta' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}
add_action( 'init', 'create_iom_post_type' );

/*Add CMB2 meta fields*/
add_action( 'cmb2_admin_init', 'iom_meta_fields' );

function iom_meta_fields() {

    $prefix = 'iomMeta_';

    $cmb = new_cmb2_box( array(
        'id'            => 'iom_metabox',
        'title'         => __( 'IOM meta fields', 'cmb2' ),
        'object_types'  => array( 'iom', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

    $cmb->add_field( array(
        'name'    => 'Test Text',
        'desc'    => 'field description (optional)',
        'id'      => $prefix .'text',
        'type'    => 'text',
    ) );

    $cmb->add_field( array(
        'name' => 'Test Text Email',
        'id'   => $prefix .'email',
        'type' => 'text_email',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Website URL', 'cmb2' ),
        'id'   => $prefix .'url',
        'type' => 'text_url',
        // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    ) );

    $cmb->add_field( array(
        'name' => 'Test Text Area',
        'desc' => 'field description (optional)',
        'id' => $prefix .'textarea',
        'type' => 'textarea'
    ) );

    $cmb->add_field( array(
        'name' => 'Test Time Picker',
        'id' => $prefix .'texttime',
        'type' => 'text_time',
        'time_format' => 'H:m'
    ) );

    $cmb->add_field( array(
        'name'    => 'Test Color Picker',
        'id'      => $prefix .'colorpicker',
        'type'    => 'colorpicker',
        'default' => '#ffffff',
    ) );

    $cmb->add_field( array(
        'name' => 'Test Checkbox',
        'desc' => 'field description (optional)',
        'id'   => $prefix .'checkbox',
        'type' => 'checkbox',
    ) );

    $cmb->add_field( array(
        'name'             => 'Test Radio',
        'id'               => $prefix .'radio',
        'type'             => 'radio',
        'show_option_none' => true,
        'options'          => array(
            'Option one is selected' => __( 'Option One', 'cmb2' ),
            'Option two is selected'   => __( 'Option Two', 'cmb2' ),
            'Option three is selected'     => __( 'Option Three', 'cmb2' ),
        ),
    ) );

    $cmb->add_field( array(
        'name'             => 'Test Select',
        'desc'             => 'Select an option',
        'id'               => $prefix .'select',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => 'custom',
        'options'          => array(
            'Option one is selected' => __( 'Option One', 'cmb2' ),
            'Option two is selected'   => __( 'Option Two', 'cmb2' ),
            'Option three is selected'     => __( 'Option Three', 'cmb2' ),
        ),
    ) );

    $cmb->add_field( array(
        'name'    => 'Test wysiwyg',
        'desc'    => 'field description (optional)',
        'id'      => $prefix .'editor',
        'type'    => 'wysiwyg',
        'options' => array(),
    ) );

    $cmb->add_field( array(
        'name'    => 'Single image or file',
        'desc'    => 'Upload an image or enter an URL.',
        'id'      => $prefix .'file',
        'type'    => 'file',
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb->add_field( array(
        'name' => 'Multiple images of files',
        'desc' => '',
        'id'   => $prefix .'files',
        'type' => 'file_list',
        'preview_size' => array( 130, 130 ),
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb->add_field( array(
        'name' => 'Embed',
        'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
        'id'   => $prefix .'embed',
        'type' => 'oembed',
    ) );

}

/*If single-iom.php doesn't exist in theme folder, it will check plugin folder*/
add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'iom' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-iom.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-iom.php';
            }
        }
    }
    return $template_path;
}