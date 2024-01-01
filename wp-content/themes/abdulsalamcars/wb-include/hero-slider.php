<?php
/**
 * @throws Exception
 */
function hero_slider_element(): void
{
    vc_map(array(
        'name' => 'هيرو سلايدر',
        'base' => 'car-hero-slider',
        'category' => 'Abdulsalamcars Theme Car',
        'params' => array(
            array(
                'type' => 'param_group',
                'param_name' => 'slider',
                'heading' => 'السلايدر',
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
        )
    ));
}

add_action('vc_before_init', 'hero_slider_element');


/**
 * Shortcode to display hero slider
 *
 * @param $data
 * @return string HTML content.
 */
function hero_slider_shortcode($data): string
{
    // Extract and sanitize the shortcode attributes

    extract(shortcode_atts(array(
        'slider' => ''
    ), $data));

    $slider_data = vc_param_group_parse_atts($slider);

    $sliders = '';

    foreach ($slider_data as $slider) {
        $image_field = $slider['image_field'] ? wp_get_attachment_url($slider['image_field']) : '';
        $sliders .= '<div class="swiper-slide">
            <div class="hero__slider--items__style2 home2-slider1-bg row align-items-center">
              <div class="slider__content style2 col-md-5">
                <h2 class="slider__maintitle--style2 h1">
                ' . $slider['title_field'] . '
                </h2>
                <p class="slider__desc">
                ' . $slider['description_field'] . '
                </p>
              </div>
              <div class="hero__slider--layer__style2 col-md-7">
                <img
                  class="slider__layer--img"
                  src="' . $image_field . '"
                  alt="slider-img"
                />
              </div>
            </div>
          </div>
          ';
    }

    return '<div class="container">
      <div class="hero__slisder--inner hero__slider--activation swiper my-5">
        <div class="hero__slider--wrapper swiper-wrapper">
        ' . $sliders . '
        </div>
      <div class=" swiper__navs mt-md-5">
      <div class="swiper__nav--btn swiper-button-next">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="-chevron-right">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </div>
        <div class="swiper__nav--btn swiper-button-prev">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="-chevron-left" >
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </div>
      </div>
        </div>
      </div>';
}

add_shortcode('car-hero-slider', 'hero_slider_shortcode');