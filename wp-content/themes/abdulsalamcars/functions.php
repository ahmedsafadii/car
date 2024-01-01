<?php

function my_enqueue_scripts() {
    wp_enqueue_script('ajax-form-handler', get_template_directory_uri() . '/assets/js/ajax-form-handler.js', array('jquery'), null, true);
    wp_localize_script('ajax-form-handler', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('form_submission_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

require_once get_template_directory() . '/ajax-functions.php';

class Top_Menu_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='header__sub--menu'>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Determine if the menu item is the current item
        $active_class = '';
        if ($item->current || $item->current_item_ancestor || $item->current_item_parent) {
            $active_class = 'active';
        }

        $output .= $indent . '<li class="header__menu--items ' . $active_class . '">';

        $title = apply_filters('the_title', $item->title, $item->ID);
        $url = $item->url;
        $output .= '<a class="header__menu--link ' . $active_class . '" href="' . esc_url($url) . '">' . esc_html($title);

        if (in_array('menu-item-has-children', $item->classes)) {
            $output .= ' <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12" height="7.41" viewBox="0 0 12 7.41"><path d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"></path></svg>';
        }

        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

class Responsive_Menu_Walker_Nav_Menu extends Walker_Nav_Menu
{

    // Start of a submenu level
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='offcanvas__sub_menu'>\n";
    }

    // Start of a menu element
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Check if menu item is active
        $active_class = '';
        if ($item->current || $item->current_item_ancestor || $item->current_item_parent) {
            $active_class = 'active';
        }

        $class_names = 'offcanvas__menu_li ' . $active_class;
        $output .= $indent . '<li class="' . $class_names . '">';

        // Menu item title and URL
        $title = apply_filters('the_title', $item->title, $item->ID);
        $url = $item->url;
        $output .= '<a class="offcanvas__menu_item" href="' . esc_url($url) . '">' . esc_html($title) . '</a>';
    }

    // End of a menu element
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

function top_menu()
{
    register_nav_menus(array(
        'top-menu' => __('القائمة العليا', 'cartheme')
    ));
}

add_action('after_setup_theme', 'top_menu');

require_once get_template_directory() . '/wb-include/agencies.php';
require_once get_template_directory() . '/wb-include/distributor.php';
require_once get_template_directory() . '/wb-include/request-purchase.php';
require_once get_template_directory() . '/wb-include/best-option.php';
require_once get_template_directory() . '/wb-include/hero-slider.php';
require_once get_template_directory() . '/wb-include/brands.php';
require_once get_template_directory() . '/wb-include/slider.php';
require_once get_template_directory() . '/wb-include/services.php';
require_once get_template_directory() . '/wb-include/auctions.php';
require_once get_template_directory() . '/wb-include/contact.php';
require_once get_template_directory() . '/wb-include/companies-request.php';
require_once get_template_directory() . '/wb-include/individual-request.php';
