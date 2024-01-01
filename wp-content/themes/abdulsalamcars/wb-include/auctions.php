<?php
/**
 * @throws Exception
 */
function auctions_element(): void
{
    vc_map(array(
        'name' => 'مزاد اللوحات',
        'base' => 'car-auctions',
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

add_action('vc_before_init', 'auctions_element');


/**
 * Shortcode to display auctions
 *
 * @param $data
 * @return string HTML content.
 */
function auctions_shortcode($data): string
{
    // Extract and sanitize the shortcode attributes
    $data = shortcode_atts(array(
        'section_title' => ''
    ), $data, 'car-auctions');

    // Prepare arguments for get_posts
    $args = array(
        'post_type' => 'auctions',
        'posts_per_page' => -1
    );

    $auctions = get_posts($args);
    $vat = get_field('as-vat', 'option');

    $agencies_html = '';

    foreach ($auctions as $post) {
        //        $detail_page_url = esc_url(get_permalink(get_page_by_path( "auction")));
        $thumb = get_the_post_thumbnail_url($post->ID, "full");
        $auction_link = "#"; #add_query_arg('id', $post->ID, $detail_page_url);
        $amount = get_post_meta($post->ID, 'as-auction-price', true);
        $discount = get_post_meta($post->ID, 'as-auction-discount', true);
        $privacy = get_post_meta($post->ID, 'as-auction-privacy', true);
        $package = get_post_meta($post->ID, 'as-auction-package', true);
        $package = get_post($package);
        $deposit = get_post_meta($post->ID, 'as-auction-deposit', true);


        if (isset($discount) && (floatval($discount) != 0)) {
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

        $agencies_html .= '                        <div class="col-6 col-lg-3  mb-30">
                            <div class="blog__card">
                                <div class="blog__card--thumbnail">
                                    <a class="blog__card--thumbnail__link" href="#">
                                        <img class="blog__card--thumbnail__img" src="' . $thumb . '" alt=""></a>
                                </div>
                                <div class="blog__card--content">
                                    <span class="blog__card--meta">مبلغ المزايدة</span>
                                    <br/>
                                    ' . $price_html . '
                                    <div class="badges mt-3">
                                        <ul class="">
                                            <li class="d-inline">
                                                <span class="badge text-dark  bg-soft-primary">' . $privacy . '</span>
                                            </li>
                                            <li class="d-inline">
                                                <span class="badge text-dark  bg-soft-primary">' . $package->post_title . '</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <a class="blog__card--btn__link primary__btn text-center w-100"
                                           href="#">مزايدة
                                        </a>
                                    <small>' . ($deposit ? "يتطلب دفع عربون للتمكن من المزايدة" : "") . '</small>
                                    </div>

                                </div>
                            </div>
                        </div>';
    }

    // Return the complete HTML structure
    return '<main class="main__content_wrapper">
    <section class="blog__section section--padding">
        <div class="container">
            <div class="">
                <h2 class=" h2 py-5">' . $data["section_title"] . '</h2>
            </div>
            <div class="shop__right--sidebar">
                <div class="shop__product--wrapper ">
                    <div class="shop__header shop__header2 d-flex align-items-center justify-content-between mb-30">
                        <p class="text-dark h3">' . count($auctions) . ' نتيجة</p>
                    </div>
                </div>
                <div class="blog__section--inner">
                    <div class="row mb--n30">
                    ' . $agencies_html . '
                    </div>
                </div>
            </div>
    </section>
</main>';
}

add_shortcode('car-auctions', 'auctions_shortcode');