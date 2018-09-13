<?php
/*
Plugin Name: Advanced Custom Fields Hide Field Option
Plugin URI: https://github.com/ptouch718/acf-hidden-field-option
Description: Adds an option to make text fields hidden on Post edit pages
Version: 1.0.0
Author: Powell May 
Author URI: powell.may@gmail.com
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace ptouch718\acf_hide_field_option;

if( ! defined( 'ABSPATH' ) ) exit; 

if( ! class_exists('acf_hide_field_option') ) :

class acf_hide_field_option
{
    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        add_action('acf/render_field_settings/type=text', [$this, 'render_field_settings'], 10, 3);
        add_filter('acf/prepare_field', [$this, 'prepare_field'], 10, 3);
    }

    public function render_field_settings($field)
    {
        acf_render_field_setting( $field, [
            'label'         => __('Hidden?'),
            'instructions'  => '',
            'name'          => '_is_hidden',
            'type'          => 'true_false',
            'ui'            => 1,
        ], true);   
    }

    public function prepare_field($field)
    {
        if ($field['_is_hidden'])
        {
            $field_selector = '.acf-field-'.substr($field['key'], 6);
            ?>
            <style type="text/css">
                <?= $field_selector; ?> label:after{
                    display: none;
                }
            </style>
            <?php
        }
        return $field;
    }
}

new acf_hide_field_option();

 endif;