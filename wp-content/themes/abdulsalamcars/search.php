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

if (empty($search_term) && empty($car_brand_id) && !(isset($_GET['discount']))) {
    wp_redirect(home_url());
    exit;
}

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

if ($price_from || $price_to) {
    $price_query = array('key' => 'as-car-details_as-car-price', 'type' => 'NUMERIC');
    if ($price_from) $price_query['value'][] = $price_from;
    if ($price_to) $price_query['value'][] = $price_to;
    $price_query['compare'] = count($price_query['value']) === 2 ? 'BETWEEN' : (isset($price_query['value'][0]) ? '>=' : '<=');
    $args['meta_query'][] = $price_query;
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
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block">
                        <h2 class=" h3 pt-5">الفلاتر</h2>
                        <h2 class=" h4 pt-5">الموديلات</h2>
                        <div class="single__widget widget__bg">
                            <ul class="widget__form--check model-filter-list">
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
                        <h2 class=" h4 pt-5">سنة الصنع</h2>
                        <div class="single__widget widget__bg">
                            <ul class="widget__form--check model-filter-list">
                                <li class="widget__form--check__list">
                                    <a href="<?= esc_url(add_query_arg('manufacture_year', '', $_SERVER['REQUEST_URI'])) ?>">
                                        <span class="<?= empty($_GET['manufacture_year']) ? 'active' : '' ?>">جميع السنوات</span>
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
                                        <a href="<?= esc_url($year_url) ?>">
                                            <span class="<?= $active_class ?>"><?= esc_html($year->name) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <h2 class=" h4 pt-5">سعة المحركة</h2>
                        <div class="single__widget widget__bg">
                            <ul class="widget__form--check model-filter-list">
                                <li class="widget__form--check__list">
                                    <a href="<?= esc_url(add_query_arg('engine_capacity', '', $_SERVER['REQUEST_URI'])) ?>">
                                        <span class="<?= empty($_GET['engine_capacity']) ? 'active' : '' ?>">جميع المحركات</span>
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
                                        <a href="<?= esc_url($engine_url) ?>">
                                            <span class="<?= $active_class ?>"><?= esc_html($engine->name) ?></span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <h2 class=" h4 pt-5">نطاق السعر</h2>
                        <div class="single__widget price__filter widget__bg">
                            <div class="filter">
                                <div class="filter__label">
                                    <label class="filter__input_title">
                                        <span>من:</span>
                                        <input type="number" class="filter__input" id="filter__input_from"
                                               name="priceFrom" value="<?= $_GET['price_from'] ?? 0 ?>">
                                    </label>

                                    <label class="filter__input_title">
                                        <span>الى:</span>
                                        <input type="number" class="filter__input" id="filter__input_to" name="priceTo"
                                               value="<?= $_GET['price_to'] ?? 0 ?>">
                                    </label>
                                </div>
                                <a href="#" id="applyPriceFilter" class="btn btn-primary">تطبيق</a>
                            </div>
                        </div>
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h4">الوقود</h2>
                            <ul class="widget__tagcloud">
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
                            <label>
                                <input type="checkbox"
                                       id="discountFilter" <?= isset($_GET['discount']) ? 'checked' : '' ?>>
                                عرض فقط السيارات مع الخصم
                            </label>
                        </div>
                    </div>
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
    document.getElementById('applyPriceFilter').addEventListener('click', function () {
        var baseUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var queryParams = new URLSearchParams(window.location.search);

        var priceFrom = document.getElementById('filter__input_from').value;
        var priceTo = document.getElementById('filter__input_to').value;

        if (priceFrom) queryParams.set('price_from', priceFrom);
        if (priceTo) queryParams.set('price_to', priceTo);

        window.location.href = baseUrl + '?' + queryParams.toString();
    });
    document.addEventListener('DOMContentLoaded', function () {
        var discountCheckbox = document.getElementById('discountFilter');

        discountCheckbox.addEventListener('change', function () {
            var currentUrl = new URL(window.location.href);
            var queryParams = new URLSearchParams(currentUrl.search);

            if (this.checked) {
                queryParams.set('discount', '1');
            } else {
                queryParams.delete('discount');
            }

            currentUrl.search = queryParams.toString();
            window.location.href = currentUrl.href;
        });
    });

</script>
<?php get_footer(); ?>
