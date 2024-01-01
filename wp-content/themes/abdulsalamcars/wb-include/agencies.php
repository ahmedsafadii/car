<?php
/**
 * @throws Exception
 */
function agencies_element(): void
{
    vc_map(array(
        'name' => 'جهات التمويل',
        'base' => 'car-agencies',
        'category' => 'Abdulsalamcars Theme Car',
        'params' => array(
            array(
                'type' => 'textfield',
                'param_name' => 'section_title',
                'heading' => 'عنوان القسم',
            )
        ),
    ));
}

add_action('vc_before_init', 'agencies_element');


/**
 * Shortcode to display financing agencies
 *
 * @param $data
 * @return string HTML content.
 */
function agencies_shortcode($data): string {
    // Extract and sanitize the shortcode attributes
    $data = shortcode_atts(array(
        'section_title' => ''
    ), $data, 'car-agencies');

    // Prepare arguments for get_posts
    $args = array(
        'post_type' => 'financing-agencies',
        'posts_per_page' => -1
    );

    $agencies = get_posts($args);

    $agencies_lists = '';

    foreach ($agencies as $post) {
        $agency_url = get_post_meta($post->ID, 'financing-agencies-link', true);
        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');

        $agencies_lists .= '<div class="brang__logo--items">
<a target="_blank" href="' . esc_url($agency_url) . '">
            <img class="brang__logo--img" src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($post->post_title) . '">
            </a>
            </div>';
    }

    // Return the complete HTML structure
    return '<div class="brand__section section--padding pt-0">
        <div class="container">
        <div class="section__heading mb-30">
            <h2 class="section__heading--maintitle">' . esc_html($data['section_title']) . '</h2>
          </div>  
            <div class="brand__section--inner d-flex align-items-center">' . $agencies_lists . '</div>
        </div>
    </div>';
}

add_shortcode('car-agencies', 'agencies_shortcode');