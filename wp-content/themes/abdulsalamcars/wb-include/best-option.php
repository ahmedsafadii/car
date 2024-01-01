<?php
/**
 * @throws Exception
 */
function best_option_element(): void
{
    vc_map(array(
        'name' => 'لماذا تختارنا',
        'base' => 'car-best-option',
        'category' => 'Abdulsalamcars Theme Car',
        'params' => array(
            array(
                'type' => 'textfield',
                'param_name' => 'section_title',
                'heading' => 'عنوان القسم',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'section_subtitle',
                'heading' => 'عنوان فرعي',
            ),
            array(
                'type' => 'param_group',
                'param_name' => 'boxes',
                'heading' => 'الصناديق',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image_field',
                        'heading' => 'صورة',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title_field',
                        'heading' => 'عنوان',
                    ),
                    array(
                        'type' => 'textarea',
                        'param_name' => 'description_field',
                        'heading' => 'وصف',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'url_field',
                        'heading' => 'رابط',
                    ),
                ),
            ),
        ),
    ));
}

add_action('vc_before_init', 'best_option_element');


/**
 * Shortcode to display best option
 *
 * @param $data
 * @return string HTML content.
 */
function best_option_shortcode($data): string
{
    // Extract and sanitize the shortcode attributes

    $data = shortcode_atts(array(
        'boxes' => '',
        'section_title' => '',
        'section_subtitle' => '',
    ), $data, 'car-best-option');

    $sections_data = vc_param_group_parse_atts($data["boxes"]);

    $boxes = '';

    foreach ($sections_data as $section) {
        $image_field = $section['image_field'] ? wp_get_attachment_url($section['image_field']) : '';
        $boxes .= ' <div class="shipping__items style2">
                    <div class="shipping__icon mb-5">  
                        <img src="' . $image_field . '" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">' . $section["title_field"] . '</h2>
                        <p class="shipping__content--desc">' . $section["description_field"] . '</p>
                    <a href="' . $section["url_field"] . '" class="text-primary h4">اقرأ المزيد</a>
                      </div>
                </div>';
    }

    return '<div class="container">
      <section class="shipping__section pb-5 pt-5">
        <div class="section__heading pb-5 pt-5 text-center">
            <span>'. $data["section_subtitle"] .'</span>
            <h2 class="section__heading--maintitle">
            '. $data["section_title"] .'
            </h2>
          </div>
            <div class="shipping__inner style2 d-flex">
              ' . $boxes . '
            </div>
        </div>
';
}

add_shortcode('car-best-option', 'best_option_shortcode');