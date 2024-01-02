<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8"/>
    <title>
        <?php
        if (!is_front_page()) {
            wp_title('|', true, 'right');
        }
        echo get_bloginfo('name');
        ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" type="image/x-icon"
          href="<?php echo get_stylesheet_directory_uri() ?>/assets/img/favicon.ico"/>
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/plugins/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/plugins/glightbox.min.css"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&amp;display=swap"
    />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/vendor/bootstrap-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/style.css?v=9"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <?php wp_head(); ?>
</head>
<body>

<div class="offcanvas__filter--sidebar widget__area">
    <button type="button" class="offcanvas__filter--close" data-offcanvas>
        <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="32" d="M368 368L144 144M368 144L144 368"></path>
        </svg>
    </button>
    <div class="offcanvas__filter--sidebar__inner">
        <div class="shop__sidebar--widget widget__area">
            <div class="predictive__search--form ">
                <label>
                    <input class="predictive__search--input rounded" placeholder="مثال: سيارة مودل 2023" type="text"/>
                </label>
                <button class="predictive__search--button text-dark" aria-label="search button">
                    <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51"
                         height="25.443" viewbox="0 0 512 512">
                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none"
                              stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                              stroke-width="32" d="M338.29 338.29L448 448"/>
                    </svg>
                </button>
            </div>
            <div class="single__widget widget__bg">
                <h2 class="widget__title h4">العلامات التجارية</h2>
                <ul class="widget__form--check">
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label" for="check1">Body Parts</label>
                        <input class="widget__form--check__input" id="check1" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label" for="check2">Oiles Fluids</label>
                        <input class="widget__form--check__input" id="check2" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label" for="check3">Car care kits</label>
                        <input class="widget__form--check__input" id="check3" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label" for="check4">Brake disks</label>
                        <input class="widget__form--check__input" id="check4" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                    <li class="widget__form--check__list">
                        <label class="widget__form--check__label" for="check5">Repair Parts</label>
                        <input class="widget__form--check__input" id="check5" type="checkbox">
                        <span class="widget__form--checkmark"></span>
                    </li>
                </ul>
            </div>
            <div class="single__widget price__filter widget__bg">


                <div class="rangeslider">
                    <input class="min" name="range_1" type="range" min="1" max="100" value="10"/>
                    <input class="max" name="range_1" type="range" min="1" max="100" value="90"/>
                    <span class="range_min light left">10.000 ريال</span>
                    <span class="range_max light right">90.000 ريال</span>
                </div>
            </div>

            <div class="single__widget widget__bg">
                <h2 class="widget__title h4">الوقود</h2>
                <ul class="widget__tagcloud">
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">
                            بنزين
                        </a>
                    </li>
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">ديزل</a>
                    </li>
                </ul>
            </div>
            <div class="single__widget widget__bg">
                <h2 class="widget__title h4">سنة الاصدار</h2>
                <ul class="widget__tagcloud">
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">
                            بنزين
                        </a>
                    </li>
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">ديزل</a>
                    </li>
                </ul>
            </div>
            <div class="single__widget widget__bg">
                <h2 class="widget__title h4">المميزات</h2>
                <ul class="widget__tagcloud">
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">
                            ايرباجز
                        </a>
                    </li>
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">مجسات</a>
                    </li>
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">تشغيل بصمة</a>
                    </li>
                    <li class="widget__tagcloud--list">
                        <a class="widget__tagcloud--link" href="#">نظام معلومات</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<header class="header__section">
    <div class="main__header header__sticky">
        <div class="container px-5">
            <div
                    class="main__header--inner position__relative d-flex justify-content-between align-items-center"
            >

                <div class="main__logo d-flex">
                    <div class="offcanvas__header--menu__open">
                        <a
                                class="offcanvas__header--menu__open--btn"
                                href="javascript:void(0)"
                                data-offcanvas
                        >
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="ionicon offcanvas__header--menu__open--svg"
                                    viewBox="0 0 512 512"
                            >
                                <path
                                        fill="currentColor"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-miterlimit="10"
                                        stroke-width="32"
                                        d="M80 160h352M80 256h352M80 352h352"
                                />
                            </svg>
                            <span class="visually-hidden">Offcanvas Menu Open</span>
                        </a>
                    </div>
                    <h1 class="main__logo--title">
                        <a class="main__logo--link" href="<?php bloginfo('url'); ?>"
                        >
                            <?php
                                $image_url = get_field('as-logo', 'option')['url'];
                            ?>
                            <img
                                    class="main__logo--img"
                                    src="<?= $image_url ?>"
                                    alt="logo-img"
                            /></a>
                    </h1>
                </div>
                <div class="header__menu style3 d-none d-lg-block">
                    <nav class="header__menu--navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'top-menu',
                            'container' => false,
                            'items_wrap' => '<ul class="header__menu--wrapper d-flex">%3$s</ul>',
                            'walker' => new Top_Menu_Walker_Nav_Menu(),
                            'depth' => 2
                        ));
                        ?>
                    </nav>
                </div>
                <div class="header__account">
                    <ul class="header__account--wrapper d-flex align-items-center">
                        <li
                                class="header__account--items header__account--search__items"
                        >
                            <a
                                    class="header__account--btn search__open--btn"
                                    href="javascript:void(0)"
                                    data-offcanvas
                            >
                                <svg
                                        class="product__items--action__btn--svg"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="22.51"
                                        height="20.443"
                                        viewBox="0 0 512 512"
                                >
                                    <path
                                            d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-miterlimit="10"
                                            stroke-width="32"
                                    />
                                    <path
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-miterlimit="10"
                                            stroke-width="32"
                                            d="M338.29 338.29L448 448"
                                    />
                                </svg>
                                <span class="visually-hidden">Search</span>
                            </a>
                        </li>
                        <li>
                            <a class="primary__btn slider__btn ms-3 d-none d-md-inline-block"
                               href="<?php echo esc_url(get_permalink(get_page_by_path('طلبات-الشركات'))); ?>">
                                طلب شراء
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__header">
        <div class="offcanvas__inner">
            <div class="offcanvas__logo">
                <a class="offcanvas__logo_link" href="<?php bloginfo('url'); ?>">
                    <img
                            src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo/nav-log.png"
                            alt="Grocee Logo"
                            width="158"
                            height="36"
                    />
                </a>
                <button class="offcanvas__close--btn" data-offcanvas>close</button>
            </div>
            <nav class="offcanvas__menu">
                <nav class="offcanvas__menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu', // Ensure this matches the location registered in your functions.php
                        'container' => false,
                        'items_wrap' => '<ul class="offcanvas__menu_ul">%3$s</ul>',
                        'walker' => new Responsive_Menu_Walker_Nav_Menu(),
                        'depth' => 2
                    ));
                    ?>
                </nav>
            </nav>
        </div>
    </div>
    <div class="predictive__search--box">
        <div class="predictive__search--box__inner container">
            <h2 class="predictive__search--title">ابحث عن سيارتك</h2>
            <form class="predictive__search--form" action="<?= bloginfo('url'); ?>">
                <label>
                    <input name="s" class="predictive__search--input" placeholder="مثال: هيونداي اكسنت" type="text">
                </label>
                <button
                        class="predictive__search--button text-dark"
                        aria-label="search button"
                >
                    <svg
                            class="product__items--action__btn--svg"
                            xmlns="http://www.w3.org/2000/svg"
                            width="30.51"
                            height="25.443"
                            viewBox="0 0 512 512"
                    >
                        <path
                                d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                fill="none"
                                stroke="currentColor"
                                stroke-miterlimit="10"
                                stroke-width="32"
                        />
                        <path
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-miterlimit="10"
                                stroke-width="32"
                                d="M338.29 338.29L448 448"
                        />
                    </svg>
                </button>
            </form>
        </div>
        <button
                class="predictive__search--close__btn"
                aria-label="search close"
                data-offcanvas
        >
            <svg
                    class="predictive__search--close__icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="40.51"
                    height="30.443"
                    viewBox="0 0 512 512"
            >
                <path
                        fill="currentColor"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="32"
                        d="M368 368L144 144M368 144L144 368"
                />
            </svg>
        </button>
    </div>
</header>
