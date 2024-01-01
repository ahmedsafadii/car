<?php
ob_start();
get_header();

$sort_by = $_GET['sort_by'] ?? 'date-desc';
$vat = get_field('as-vat', 'option');

$args = array(
    'post_type' => 'car',
    'posts_per_page' => -1,
    'tax_query' => array(
        'relation' => 'AND',
    )
);

switch ($sort_by) {
    case 'price-desc':
        $args['meta_key'] = 'as-car-details_as-car-price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;

    case 'price-asc':
        $args['meta_key'] = 'as-car-details_as-car-price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        break;

    default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
}

if (!empty($_GET['car_brand_id'])) {
    $args['tax_query'] = array(
        'relation' => 'AND'
    );

    if (!empty($_GET['car_model_id'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'brand',
            'field'    => 'term_id',
            'terms'    => $_GET['car_model_id'],
        );
    } else {
        $args['tax_query'][] = array(
            'taxonomy' => 'brand',
            'field'    => 'term_id',
            'terms'    => $_GET['car_brand_id'],
        );
    }

    $term_id = intval($_GET['car_brand_id']);
    $term = get_term($term_id, 'brand');
    $car_logo = get_field('car-logo', $term->taxonomy . '_' . $term->term_id);
    $car_cover = get_field('car-cover', $term->taxonomy . '_' . $term->term_id);
    $search_result_query = new WP_Query($args);
} else {
    wp_redirect(home_url());
    exit;
}
?>

<main class="main__content_wrapper">
    <div class="shop__section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 shop-col-width-lg-4 border rounded-16">
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                        <h2 class=" h3 pt-5">الموديلات</h2>
                        <div class="single__widget widget__bg">
                            <ul class="widget__form--check">
                                <li class="widget__form--check__list">
                                    <a href="<?= esc_url(add_query_arg('car_model_id', '', $_SERVER['REQUEST_URI'])) ?>">
                                        <span class="<?= empty($_GET['car_model_id']) ? 'active' : '' ?>">جميع الموديلات</span>
                                    </a>
                                </li>

                                <?php
                                $car_models = get_terms(array(
                                    'taxonomy' => 'brand',
                                    'parent' => $_GET['car_brand_id'],
                                    'hide_empty' => false
                                ));

                                foreach ($car_models as $model) {
                                    $active_class = isset($_GET['car_model_id']) && $_GET['car_model_id'] == $model->term_id ? 'active' : '';

                                    // Construct the URL for each model
                                    $model_url = add_query_arg('car_model_id', $model->term_id, $_SERVER['REQUEST_URI']);
                                    ?>
                                    <li class="widget__form--check__list">
                                        <a href="<?= esc_url($model_url) ?>">
                                            <span class="<?= $active_class ?>"><?= esc_html($model->name) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                    <div class="header__mega--menu__banner display-block mb-5">
                        <img class="header__mega--menu__banner--img w-100" src="<?= esc_url($car_cover['url']) ?>"
                             alt="banner-menu">
                        <div class="banner__content">
                            <span class="banner__content--subtitle  mb-10"><?= esc_attr(mb_strtoupper($term->slug)) ?></span>
                            <h2 class="banner__content--title">
                                <span class="banner__content--title__inner"><?= esc_attr($term->name) ?></h2>
                        </div>
                    </div>

                    <div class="shop__right--sidebar">
                        <div class="shop__product--wrapper">
                            <div class="shop__header d-flex align-items-center justify-content-between mb-30">

                                <p class="text-dark h3"><?= $search_result_query->post_count ?> نتيجة</p>
                                <div class="product__view--mode d-flex align-items-center">
                                    <button class="widget__filter--btn d-flex d-lg-none align-items-center"
                                            data-offcanvas>
                                        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                             viewbox="0 0 512 512">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                  stroke-linejoin="round" stroke-width="28"
                                                  d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80"/>
                                            <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                            <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                            <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="28"/>
                                        </svg>
                                        <span class="widget__filter--btn__text">الفلاتر</span>
                                    </button>

                                    <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                        <label class="product__view--label">ترتيب حسب:</label>
                                        <div class="select shop__header--select">
                                            <select class="product__view--select">
                                                <option value="date-desc" <?php if ($sort_by == 'date-desc') echo 'selected'; ?>>
                                                    تاريخ الاضافة
                                                </option>
                                                <option value="price-desc" <?php if ($sort_by == 'price-desc') echo 'selected'; ?>>
                                                    السعر (أعلى)
                                                </option>
                                                <option value="price-asc" <?php if ($sort_by == 'price-asc') echo 'selected'; ?>>
                                                    السعر (ادنى)
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab_content">
                                <div id="product_grid" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row mb--n30">
                                            <?php
                                            if ($search_result_query->have_posts()) {
                                                while ($search_result_query->have_posts()) {
                                                    $search_result_query->the_post();
                                                    $post_title = get_the_title();
                                                    $post_permalink = get_permalink();
                                                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                    $car_detail = get_field('as-car-details');
                                                    $amount = $car_detail['as-car-price'];
                                                    $discount = $car_detail['as-car-discount'];
                                                    if ((floatval($discount) != 0) && !empty($discount)) {
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
                                                    ?>
                                                    <div class="col-6 col-md-3 mb-30">

                                                        <article class="product__card">
                                                            <div class="product__card--thumbnail">
                                                                <a class="product__card--thumbnail__link display-block"
                                                                   href="<?= $post_permalink; ?>">
                                                                    <img class="product__card--thumbnail__img product__primary--img"
                                                                         src="<?= $featured_img_url; ?>"
                                                                         alt="<?php echo $post_title; ?>"/>
                                                                </a>
                                                            </div>
                                                            <div class="product__card--content">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <h3 class="product__card--title h4">
                                                                            <a href="<?= $post_permalink; ?>"><?= $post_title; ?></a>
                                                                        </h3>
                                                                        <ul class="d-flex gap-2">
                                                                            <li><?= $car_detail['as-car-style'] ?></li>
                                                                            <li>•</li>
                                                                            <li><?= $car_detail['as-car-transmission'] ?></li>
                                                                        </ul>
                                                                    </div>
                                                                    <a class="product__card--action__btn"
                                                                       title="Wishlist"
                                                                       href="#">
                                                                        <svg class="product__card--action__btn--svg"
                                                                             width="18" height="18"
                                                                             viewBox="0 0 16 13" fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                  fill="currentColor"></path>
                                                                        </svg>
                                                                        <span class="visually-hidden">Wishlist</span>
                                                                    </a>
                                                                </div>
                                                                <div class="badges mt-3">
                                                                    <ul class="">
                                                                        <li class="d-inline"><span
                                                                                    class="badge text-dark  bg-soft-primary"><?= $car_detail['as-car-engine-system'] ?></span>
                                                                        </li>
                                                                        <li class="d-inline"><span
                                                                                    class="badge  text-dark bg-soft-primary"><?= $car_detail['as-car-drive-type'] ?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product__card--price border-0">
                                                                    <?= $price_html; ?>
                                                                </div>
                                                                <div class="product__card--footer">
                                                                    <a class="product__card--btn primary__btn"
                                                                       href="<?= $post_permalink; ?>">
                                                                        عرض التفاصيل
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </div>

                                                    <?php

                                                }
                                            }
                                            wp_reset_postdata();
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var select = document.querySelector('.product__view--select');
        select.addEventListener('change', function () {
            var selectedOption = this.value;
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort_by', selectedOption);
            window.location.href = currentUrl.href;
        });
    });
</script>
<?php get_footer(); ?>
