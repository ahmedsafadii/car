<?php
/**
 * @throws Exception
 */
function distributor_element(): void
{
    vc_map(array(
        'name' => 'موزع معتمد',
        'base' => 'car-distributor',
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

add_action('vc_before_init', 'distributor_element');


/**
 * Shortcode to display distributor
 *
 * @param $data
 * @return string HTML content.
 */
function distributor_shortcode($data): string
{
    // Extract and sanitize the shortcode attributes
    $data = shortcode_atts(array(
        'section_title' => '',
        'section_subtitle' => ''
    ), $data, 'car-distributor');

    $results = array();
    $vat = get_field('as-vat', 'option');

    $terms = get_terms(array(
        'taxonomy' => 'brand',
        'parent' => 0
    ));

    foreach ($terms as $term) {
        $args = array(
            'post_type' => 'car',
            'posts_per_page' => 4,
            'tax_query' => array(
                array(
                    'taxonomy' => 'brand',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ),
            ),
        );

        $query = new WP_Query($args);
        $cars = array();

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $permalink = get_permalink();

            $car_detail = get_field('as-car-details');
            $discount = $car_detail['as-car-discount'];
            $amount = $car_detail['as-car-price'];
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

            if ((floatval($discount) != 0) && isset($discount)) {
                $discounted_price = $amount - ($amount * ($discount / 100));
                $final_price_with_vat = $discounted_price * (1 + $vat);
                $price_html = '<span class="current__price">' . $discounted_price . ' ريال</span>
                   <span class="old__price old__price2">' . $amount . ' ريال</span>
                   <span class="final__price d-block">' . $final_price_with_vat . ' ريال بعد الضريبة</span>';
            } else {
                $final_price_with_vat = $amount * (1 + $vat);
                $price_html = '<span class="current__price">' . $amount . ' ريال</span>
                   <span class="final__price d-block">' . $final_price_with_vat . ' ريال بعد الضريبة</span>';
            }

            $cars[] = array(
                'id' => $post_id,
                'title' => $post_title,
                'permalink' => $permalink,
                'price' => $price_html,
                'image' => $featured_img_url,
                'car_style' => $car_detail['as-car-style'],
                'car_transmission' => $car_detail['as-car-transmission'],
                'car_engine_system' => $car_detail['as-car-engine-system'],
                'car_drive_type' => $car_detail['as-car-drive-type']
            );
        }

        $result = array(
            'title' => $term->name,
            'slug' => $term->slug,
            'cars' => $cars
        );

        $results[] = $result;
    }

    $car_brands = '';
    $car_brands_cars = '';

    foreach ($results as $key => $result) {
        $is_active = $key == 0 ? 'active' : '';
        $car_brands .= '<li class="tab__btn--item" role="presentation">
                    <button
                      class="tab__btn--link ' . $is_active . '"
                      data-bs-toggle="tab"
                      data-bs-target="#' . $result["slug"] . '"
                      type="button"
                      role="tab"
                      aria-selected="true"
                    >
                    ' . $result["title"] . '
                    </button>
                 </li>';

        $car_brands_cars .= '<div id="' . $result["slug"] . '" class="tab-pane fade show ' . $is_active . '" role="tabpanel">
                <div class="product__wrapper">
                  <div class="row mb--n30">';


        foreach ($result['cars'] as $car) {

            $car_brands_cars .= '<div class="col-6 col-md-3 mb-30">
                      <article class="product__card">
                        <div class="product__card--thumbnail">
                          <a class="product__card--thumbnail__link display-block" href="' . $car["permalink"] . '">
                            <img
                              class="product__card--thumbnail__img product__primary--img"
                              src="' . $car["image"] . '"
                              alt="product-img"
                            />
                          </a>
                        </div>
                        <div class="product__card--content">
                          <h3 class="product__card--title ">
                            <a href="' . $car["permalink"] . '">
                            ' . esc_html($car['title']) . '
                            </a>
                          </h3>
                          <div class="product__card--price">
                          ' . $car["price"] . '
                          </div>
                          <div class="product__card--footer">
                            <a class="product__card--btn primary__btn" href="' . $car["permalink"] . '">
                            عرض التفاصيل
                            </a>
                          </div>
                        </div>
                      </article>
                    </div>';

        }
        $car_brands_cars .= '</div>
                </div>
              </div>';
    }

    return '<section class="product__section section--padding pt-0">
        <div class="container">
        <div class="section__heading  mb-30 ">
            <span>' . esc_html($data['section_subtitle']) . '</span>
            <h2 class="section__heading--maintitle">
            ' . esc_html($data['section_title']) . '
            </h2>
          </div>  
        <div
            class=" mb-30 pb-0">
            <div class="jquery-horizontal-scroll-wrap">
            <button id="slide" class="d-none" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-chevron-right">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg></button>
            <button id="slideBack"  class="d-none" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-chevron-left">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg></button>
 
      <div class="jquery-horizontal-scroll" id="container">
            <ul class="nav tab__btn--wrapper" role="tablist" id="tab__btn--wrapper">
            ' . $car_brands . '
            </ul>
</div>
</div>
          </div>
          <div class="product__section--inner">
            <div class="tab-content" id="nav-tabContent">
                    ' . $car_brands_cars . '
            </div>
          </div>
        </div>
      </section>';
}

add_shortcode('car-distributor', 'distributor_shortcode');