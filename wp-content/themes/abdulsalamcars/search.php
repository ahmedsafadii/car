<?php
ob_start();
get_header();

$sort_by = $_GET['sort_by'] ?? 'date-desc';
$vat = get_field('as-vat', 'option');

$search_term = $_GET['s'] ?? '';
$car_brand_id = $_GET['car_brand_id'] ?? '';
$car_model_id = $_GET['car_model_id'] ?? '';
$car_model_type = $_GET['car_model_type'] ?? '';
$price_from = $_GET['price_from'] ?? '';
$price_to = $_GET['price_to'] ?? '';
$fuel_type = $_GET['fuel_type'] ?? '';
$body_type = $_GET['body_type'] ?? '';
$manufacture_year = $_GET['manufacture_year'] ?? '';
$engine = $_GET['engine_capacity'] ?? '';

/*if (empty($search_term) && empty($car_brand_id) && !(isset($_GET['discount']))) {
    wp_redirect(home_url());
    exit;
}*/

$args = array(
    'post_type' => 'car',
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'AND',
    ),
    'tax_query' => array(
        'relation' => 'AND',
    )
);

if (!empty($search_term)) {
    $args['s'] = $search_term;
}

$price_min_max_query = array(
    'post_type' => 'car',
    'posts_per_page' => 1,
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_key' => 'as-car-details_as-car-price',
    'fields' => 'ids',
);

$min_max_prices = get_posts($price_min_max_query);

$min_price = !empty($min_max_prices) ? get_post_meta($min_max_prices[0], 'as-car-details_as-car-price', true) : 0;

$price_min_max_query['order'] = 'DESC';

$min_max_prices = get_posts($price_min_max_query);

$max_price = !empty($min_max_prices) ? get_post_meta($min_max_prices[0], 'as-car-details_as-car-price', true) : 0;


if ($price_from || $price_to) {
    $price_query = array('key' => 'as-car-details_as-car-price', 'type' => 'NUMERIC');
    if ($price_from) $price_query['value'][] = $price_from;
    if ($price_to) $price_query['value'][] = $price_to;
    $price_query['compare'] = count($price_query['value']) === 2 ? 'BETWEEN' : (isset($price_query['value'][0]) ? '>=' : '<=');
    $args['meta_query'][] = $price_query;
} else {
    $price_from = $min_price;
    $price_to = $max_price;
}

if (isset($_GET['discount'])) {
    $args['meta_query'][] = array(
        'key' => 'as-car-details_as-car-discount',
        'value' => '',
        'compare' => '!='
    );
}


if ($fuel_type) {
    $args['meta_query'][] = array(
        'key' => 'as-car-engine-features_as-car-engine-system',
        'value' => $fuel_type,
        'compare' => '='
    );
}
if ($body_type) {
    $args['meta_query'][] = array(
        'key' => 'as-car-details_as-car-style',
        'value' => $body_type,
        'compare' => '='
    );
}

if ($car_brand_id) {
    $args['tax_query'][] = array(
        'taxonomy' => 'brand',
        'field' => 'term_id',
        'terms' => $car_brand_id,
    );
}

if ($car_model_id) {
    $args['tax_query'][] = array(
        'taxonomy' => 'brand',
        'field' => 'term_id',
        'terms' => $car_model_id,
    );
}

if ($manufacture_year) {
    $args['tax_query'][] = array(
        'taxonomy' => 'manufacturing-year',
        'field' => 'slug',
        'terms' => $manufacture_year,
    );
}

if ($engine) {
    $args['tax_query'][] = array(
        'taxonomy' => 'engine-capacity',
        'field' => 'slug',
        'terms' => $engine,
    );
}

switch ($sort_by) {
    case 'price-asc':
        $args['meta_key'] = 'as-car-details_as-car-price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        break;
    case 'price-desc':
        $args['meta_key'] = 'as-car-details_as-car-price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        break;
    default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
}

$search_result_query = new WP_Query($args);

?>

<main class="main__content_wrapper">
    <div class="shop__section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 shop-col-width-lg-4 border rounded-16">
                    <form method="GET" action="">
                        <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                            <h2 class="  py-5">الفلاتر</h2>
                        </div>
                        <div class="predictive__search--form mb-3">
                            <label>
                                <input class="predictive__search--input rounded-16"
                                       name="s"
                                       value="<?= $_GET['s'] ?? '' ?>"
                                       placeholder="مثال: هوندا" type="text">
                            </label>
                            <button class="predictive__search--button text-dark" aria-label="search button">
                                <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                     width="30.51" height="25.443" viewBox="0 0 512 512">
                                    <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                          fill="none" stroke="currentColor" stroke-miterlimit="10"
                                          stroke-width="32"></path>
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                          stroke-miterlimit="10" stroke-width="32"
                                          d="M338.29 338.29L448 448"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">العلامات التجارية</h2>
                            <ul class="widget__form--check">
                                <?php
                                if ($car_brand_id) {
                                    $car_models = get_terms(array(
                                        'taxonomy' => 'brand',
                                        'parent' => $car_brand_id,
                                        'hide_empty' => true
                                    ));
                                    $car_text_type = 'car_model_id';
                                } else if ($car_model_id) {
                                    $term = get_term($car_model_id, 'brand');
                                    if ($term && !is_wp_error($term) && $term->parent !== 0) {
                                        $car_brand_id = $term->parent;
                                    }
                                    $car_models = get_terms(array(
                                        'taxonomy' => 'brand',
                                        'parent' => $car_brand_id,
                                        'hide_empty' => true
                                    ));
                                    $car_text_type = 'car_model_id';
                                } else {
                                    $car_models = get_terms(array(
                                        'taxonomy' => 'brand',
                                        'parent' => 0,
                                        'hide_empty' => true
                                    ));
                                    $car_text_type = 'car_brand_id';
                                }
                                ?>
                                <?php
                                foreach ($car_models as $model) {
                                    $term_posts_count = $model->count;
                                    $checked = isset($_GET['car_model_id']) && $_GET['car_model_id'] == $model->term_id ? 'checked' : '';
                                    ?>
                                    <li class="widget__form--check__list">
                                        <label class="widget__form--check__label"
                                               for="check_<?= esc_html($model->term_id) ?>"><?= esc_html($model->name) ?>
                                            <span class="text-muted small">(<?= $term_posts_count ?>)</span></label>
                                        <input class="widget__form--check__input"
                                               name="<?= $car_text_type ?>"
                                               id="check_<?= esc_html($model->term_id) ?>"
                                               value="<?= $model->term_id ?>"
                                               type="radio" <?= $checked; ?>>
                                        <span class="widget__form--checkmark"></span>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">سنة الصنع</h2>
                            <ul class="widget__tagcloud">
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= empty($_GET['manufacture_year']) ? 'active-filter' : ''; ?>"
                                       href="<?= esc_url(add_query_arg('manufacture_year', '', $_SERVER['REQUEST_URI'])) ?>">
                                        الكل
                                    </a>
                                </li>
                                <?php
                                $manufacturing_years = get_terms(array(
                                    'taxonomy' => 'manufacturing-year',
                                    'hide_empty' => false
                                ));
                                foreach ($manufacturing_years as $year) {
                                    $active_class = isset($_GET['manufacture_year']) && $_GET['manufacture_year'] == $year->slug ? 'active' : '';
                                    $year_url = add_query_arg('manufacture_year', $year->slug, $_SERVER['REQUEST_URI']);
                                    ?>
                                    <li class="widget__form--check__list">
                                        <a href="<?= esc_url($year_url) ?>"
                                           class="widget__tagcloud--link <?= $active_class ?>">
                                            <span><?= esc_html($year->name) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">سعة المحركة</h2>
                            <ul class="widget__tagcloud">
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= empty($_GET['engine_capacity']) ? 'active-filter' : ''; ?>"
                                       href="<?= esc_url(add_query_arg('engine_capacity', '', $_SERVER['REQUEST_URI'])) ?>">الكل
                                    </a>
                                </li>
                                <?php
                                $engine_capacity = get_terms(array(
                                    'taxonomy' => 'engine-capacity',
                                    'hide_empty' => false
                                ));
                                foreach ($engine_capacity as $engine) {
                                    $active_class = isset($_GET['engine_capacity']) && $_GET['engine_capacity'] == $engine->slug ? 'active' : '';
                                    $engine_url = add_query_arg('engine_capacity', $engine->slug, $_SERVER['REQUEST_URI']);
                                    ?>
                                    <li class="widget__form--check__list">
                                        <a href="<?= esc_url($engine_url) ?>"
                                           class="widget__tagcloud--link <?= $active_class ?>">
                                            <span class=""><?= esc_html($engine->name) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                        <div class="single__widget price__filter widget__bg">
                            <div class="rangeslider">
                                <input class="min" name="price_from" type="range" min="<?= $min_price ?>"
                                       max="<?= $max_price ?>" value="<?= $price_from ?>">
                                <input class="max" name="price_to" type="range" min="<?= $min_price ?>"
                                       max="<?= $max_price ?>" value="<?= $price_to ?>">
                                <span class="range_min light left"><?= $price_from ?> ريال</span>
                                <span class="range_max light right"><?= $price_to ?> ريال</span>
                            </div>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">الوقود</h2>
                            <ul class="widget__tagcloud">
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= empty($_GET['fuel_type']) ? 'active-filter' : ''; ?>"
                                       href="<?= esc_url(add_query_arg('fuel_type', '', $_SERVER['REQUEST_URI'])) ?>">
                                        الكل
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['fuel_type']) && $_GET['fuel_type'] == 'بنزين' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('fuel_type', 'بنزين', $_SERVER['REQUEST_URI'])) ?>">
                                        بنزين
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['fuel_type']) && $_GET['fuel_type'] == 'ديزل' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('fuel_type', 'ديزل', $_SERVER['REQUEST_URI'])) ?>">
                                        ديزل
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['fuel_type']) && $_GET['fuel_type'] == 'هايبرد' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('fuel_type', 'هايبرد', $_SERVER['REQUEST_URI'])) ?>">
                                        هايبرد
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">نوع الجسم</h2>
                            <ul class="widget__tagcloud">
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= empty($_GET['body_type']) ? 'active-filter' : ''; ?>"
                                       href="<?= esc_url(add_query_arg('body_type', '', $_SERVER['REQUEST_URI'])) ?>">
                                        الكل
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['body_type']) && $_GET['body_type'] == 'هاتشباك' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('body_type', 'هاتشباك', $_SERVER['REQUEST_URI'])) ?>">
                                        هاتشباك
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['body_type']) && $_GET['body_type'] == 'سيدان' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('body_type', 'سيدان', $_SERVER['REQUEST_URI'])) ?>">
                                        سيدان
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['body_type']) && $_GET['body_type'] == 'دفع رباعي' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('body_type', 'دفع رباعي', $_SERVER['REQUEST_URI'])) ?>">
                                        دفع رباعي
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['body_type']) && $_GET['body_type'] == 'عائلي' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('body_type', 'عائلي', $_SERVER['REQUEST_URI'])) ?>">
                                        عائلي
                                    </a>
                                </li>
                                <li class="widget__tagcloud--list">
                                    <a class="widget__tagcloud--link <?= isset($_GET['body_type']) && $_GET['body_type'] == 'تجاري' ? 'active-filter' : '' ?>"
                                       href="<?= esc_url(add_query_arg('body_type', 'تجاري', $_SERVER['REQUEST_URI'])) ?>">
                                        تجاري
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">عروض خاصة</h2>
                            <div class="widget__form--check__list">
                                <label class="widget__form--check__label" for="discount">عرض فقط السيارات مع
                                    الخصم</label>
                                <input class="widget__form--check__input"
                                       id="discount"
                                       name="discount" <?= isset($_GET['discount']) ? 'checked' : '' ?>
                                       type="checkbox">
                                <span class="widget__form--checkmark"></span>

                            </div>
                        </div>
                        <div class="single__widget widget__bg">
                            <button type="submit" class="primary__btn slider__btn  w-100 d-block">
                                تطبيق الفلاتر
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
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
                                                    <div class="col-6 col-md-4 mb-30">

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
