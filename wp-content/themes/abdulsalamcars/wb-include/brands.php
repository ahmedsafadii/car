<?php
/**
 * @throws Exception
 */
function brands_element(): void
{
    vc_map(array(
        'name' => 'العلامات التجارية',
        'base' => 'car-brands',
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
            )
        ),
    ));
}

add_action('vc_before_init', 'brands_element');


/**
 * Shortcode to display brands
 *
 * @param $data
 * @return string HTML content.
 */
function brands_shortcode($data): string
{

    $data = shortcode_atts(array(
        'section_title' => '',
        'section_subtitle' => ''
    ), $data, 'car-brands');

    $terms = get_terms(array(
        'taxonomy' => 'brand',
        'parent' => 0
    ));

    $terms_data = '';

    foreach ($terms as $term) {

        $image = get_field('car-logo', $term->taxonomy . '_' . $term->term_id);

        $terms_data .= '<div class="categories__card--style3 text-center">
              <a class="categories__card--link" href="/?s=&car_brand_id='.$term->term_id.'">
                <div class="categories__thumbnail">
                  <img
                    class="categories__thumbnail--img"
                    src="' . esc_url($image['url']) . '"
                    alt="categories-img"
                  />
                </div>
                <div class="categories__content style3">
                  <h2 class="categories__content--title">' . esc_attr($term->name) . '</h2>
                </div>
              </a>
            </div>';

    }

    return '<section class="categories__section section--padding ">
        <div class="container">
        <div class="row">
          <div class="col-md-6">
          <div class="section__heading  mb-30">
            <span>'.$data["section_subtitle"].'</span>
            <h2 class="section__heading--maintitle">
            '.$data["section_title"].'
            </h2>
          </div>
          </div>
        </div>
          <div class="categories__inner--style3 d-flex">
          ' . $terms_data . '
          </div>
        </div>
      </section>';
}

add_shortcode('car-brands', 'brands_shortcode');