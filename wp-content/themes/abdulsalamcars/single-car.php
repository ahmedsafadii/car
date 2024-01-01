<?php get_header(); ?>
<?php while (have_posts()) : the_post();

    $description = get_field('as-car-description');
    $features = get_field('as-car-features');
    $specifications = get_field('as-car-specifications');

    $colors = get_field('as-car-colors');
    $permalink = get_permalink();
    $vat = get_field('as-vat', 'option');

    $selected_color = $_GET['color'];
    $selected_gallery = [];

    foreach ($colors as $color) {
        if (isset($selected_color)) {
            if ($selected_color == $color['as-car-color-name']) {
                $selected_color = $color['as-car-color-name'];
                $selected_gallery = $color;
                break;
            }
        } else {
            if ($color['as-car-is-default']) {
                $selected_color = $color['as-car-color-name'];
                $selected_gallery = $color;
                break;
            }
        }
    }

    $car_detail = get_field('as-car-details');

    $amount = $car_detail['as-car-price'];
    $discount = $car_detail['as-car-discount'];

    if (!empty($discount) && (floatval($discount) != 0)) {
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

    $buy_page_url = esc_url(get_permalink(get_page_by_path("buy")));
    $buy_link = add_query_arg('id', $post->ID, $buy_page_url);

    $test_page_url = esc_url(get_permalink(get_page_by_path("test")));
    $test_link = add_query_arg('id', $post->ID, $test_page_url);

    ?>
    <main class="main__content_wrapper">
        <section class="product__details--section section--padding">
            <div class="container">
                <div class="row justify-content-center row-cols-lg-2 row-cols-md-2">
                    <div class="col-md-5">
                        <div class="product__details--media">
                            <div class="single__product--preview  swiper mb-25">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($selected_gallery['as-car-outside-images'] as $gallery) {
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox"
                                                   data-gallery="product-media-preview"
                                                   href="<?= $gallery['url'] ?>">
                                                    <img class="product__media--preview__items--img"
                                                         src="<?= $gallery['url'] ?>"
                                                         alt="product-media-img"></a>
                                                <div class="product__media--view__icon">
                                                    <a class="product__media--view__icon--link glightbox"
                                                       href="<?= $gallery['url'] ?>"
                                                       data-gallery="product-media-preview">
                                                        <span class="">السيارة من الداخل</span>
                                                        <svg width="22" height="22" viewBox="0 0 17 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M7.01859 5.14617C6.73113 4.88082 6.283 4.89874 6.01765 5.1862L3.72919 7.66534C3.47873 7.93667 3.47872 8.3549 3.72919 8.62623L6.01765 11.1054C6.28299 11.3929 6.73113 11.4108 7.01858 11.1455C7.30604 10.8801 7.32397 10.432 7.05863 10.1445L5.86749 8.85412L12.7497 8.85412C13.1409 8.85412 13.458 8.53699 13.458 8.14579C13.458 7.75459 13.1409 7.43746 12.7497 7.43746L5.86751 7.43746L7.05862 6.1471C7.32397 5.85965 7.30604 5.41151 7.01859 5.14617Z"
                                                                  fill="#0B0B0B"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="single__product--nav swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($selected_gallery['as-car-outside-images'] as $gallery) {
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="product__media--nav__items">
                                                <img class="product__media--nav__items--img"
                                                     src="<?= $gallery['url'] ?>"
                                                     alt="product-nav-img">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="swiper__nav--btn swiper-button-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class=" -chevron-right">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                                <div class="swiper__nav--btn swiper-button-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class=" -chevron-left">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <div class="col-md-5 border rounded-16 p-5">
                        <div class="product__details--info ">
                            <form action="#">
                                <h2 class="product__details--info__title mb-15 h3"><?= the_title() ?></h2>
                                <ul class="d-flex gap-2">
                                    <li><?= $car_detail['as-car-style'] ?></li>
                                    <li>•</li>
                                    <li><?= $car_detail['as-car-transmission'] ?></li>
                                </ul>
                                <div class="badges my-4">
                                    <ul>
                                        <li class="d-inline"><span
                                                    class="badge text-dark  bg-soft-primary"><?= $car_detail['as-car-engine-system'] ?></span>
                                        </li>
                                        <li class="d-inline"><span
                                                    class="badge  text-dark bg-soft-primary"><?= $car_detail['as-car-drive-type'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__details--info__price mb-12">
                                    <?= $price_html ?>
                                </div>

                                <div class="product__variant ">
                                    <div class="product__variant--list my-5">
                                        <fieldset class="variant__input--fieldset">
                                            <div class="variant__color d-flex">
                                                <?php
                                                foreach ($colors as $color) {
                                                    ?>
                                                    <div class="variant__color--list">
                                                        <a href="<?= $permalink ?>?color=<?= $color['as-car-color-name'] ?>">
                                                            <input id="color-<?= $color['as-car-color-name'] ?>"
                                                                   name="color"
                                                                   type="radio" <?= $selected_color == $color['as-car-color-name'] ? 'checked' : '' ?>>
                                                            <label class="variant__color--value red"
                                                                   for="<?= $color['as-car-color-name'] ?>"
                                                                   title="<?= $color['as-car-color-name'] ?>"
                                                                   style="background:<?= $color['as-car-color'] ?>"></label>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="product__variant--list d-flex gap-3 mb-15">
                                        <a class="variant__buy--now__btn primary__btn" href="<?= $buy_link ?>">طلب
                                            شراء</a>
                                        <a class="variant__buy--now__btn secondary__btn" href="<?= $test_link ?>">تجربة
                                            قيادة</a>
                                        <a class="variant__wishlist--icon contact__info--icon bg-soft-primary rounded-16"
                                           href="#" title="Add to wishlist">
                                            <svg width="30" height="20" viewBox="0 0 38 31" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M20.1543 7.15673C19.5094 7.77559 18.4912 7.77559 17.8463 7.15673L16.6923 6.0493C15.3416 4.75308 13.5169 3.96163 11.5003 3.96163C7.35819 3.96163 4.00033 7.31949 4.00033 11.4616C4.00033 15.4327 6.14997 18.7117 9.25326 21.4059C12.3592 24.1024 16.0727 25.8907 18.2914 26.8034C18.7553 26.9942 19.2453 26.9942 19.7092 26.8034C21.928 25.8907 25.6415 24.1024 28.7474 21.4059C31.8507 18.7117 34.0003 15.4327 34.0003 11.4616C34.0003 7.31949 30.6425 3.96163 26.5003 3.96163C24.4838 3.96163 22.659 4.75308 21.3083 6.0493L20.1543 7.15673ZM19.0003 3.64425C17.0538 1.7763 14.4111 0.628296 11.5003 0.628296C5.51724 0.628296 0.666992 5.47854 0.666992 11.4616C0.666992 22.0754 12.2842 27.9366 17.0233 29.8861C18.2996 30.4111 19.701 30.4111 20.9773 29.8861C25.7164 27.9366 37.3337 22.0754 37.3337 11.4616C37.3337 5.47854 32.4834 0.628296 26.5003 0.628296C23.5895 0.628296 20.9468 1.7763 19.0003 3.64425Z"
                                                      fill="#0B0B0B"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product__details--tab__section section--padding">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <ul class="product__tab--one product__details--tab d-flex mb-30">
                            <li class="product__details--tab__list active" data-toggle="tab" data-target="#description">
                                وصف عام
                            </li>
                            <li class="product__details--tab__list" data-toggle="tab" data-target="#specifications">
                                مواصفات
                                المواصفات
                            </li>
                            <li class="product__details--tab__list" data-toggle="tab" data-target="#features">المميزات
                            </li>
                        </ul>
                        <div class="product__details--tab__inner border-radius-10 border">
                            <div class="tab_content">
                                <div id="description" class="tab_pane active show">
                                    <div class="product__tab--content">
                                        <div class="product__tab--content__step">
                                            <?= $description ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="specifications" class="tab_pane">
                                    <div class="product__tab--conten">
                                        <div class="product__tab--content__step">
                                            <ul class="additional__info_list">
                                                <?php
                                                foreach ($specifications as $specific) {
                                                    ?>
                                                    <li class="additional__info_list--item">
                                                        <span class="info__list--item-head"><strong><?= $specific['as-car-specifications-key'] ?></strong></span>
                                                        <span class="info__list--item-content"><?= $specific['as-car-specifications-value'] ?></span>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="features" class="tab_pane active show">
                                    <div class="product__tab--content">
                                        <div class="product__tab--content__step">
                                            <?= $features ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product__section ">
            <div class="container">
                <div class="section__heading  mb-30">
                    <span>اختر العلامة الهوية المفضلة لك</span>
                    <h2 class="section__heading--maintitle">
                        سيارات مشابهة
                    </h2>
                </div>
                <div class="product__section--inner pb-15 product__swiper--activation swiper">
                    <div class="swiper-wrapper">
                        <?php
                        $current_post_id = get_the_ID();
                        $term_ids = wp_get_post_terms($current_post_id, 'brand', array("fields" => "ids"));

                        $recommend_cars_args = array(
                            'post_type' => 'car',
                            'posts_per_page' => 4,
                            'post__not_in' => array($current_post_id), // Exclude the current post
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'brand',
                                    'field' => 'term_id',
                                    'terms' => $term_ids,
                                    'operator' => 'IN'
                                ),
                            ),
                        );

                        $recommend_cars_query = new WP_Query($recommend_cars_args);

                        if ($recommend_cars_query->have_posts()) {
                            while ($recommend_cars_query->have_posts()) {
                                $recommend_cars_query->the_post();
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
                                            <a class="product__card--action__btn" title="Wishlist"
                                               href="#">
                                                <svg class="product__card--action__btn--svg" width="18" height="18"
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
                                            <a class="product__card--btn primary__btn" href="<?= $post_permalink; ?>">
                                                عرض التفاصيل
                                            </a>
                                        </div>
                                    </div>
                                </article>
                                <?php

                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="swiper__nav--btn swiper-button-next d-none d-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class=" -chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-prev  d-none d-inline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class=" -chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; ?>
<?php get_footer(); ?>