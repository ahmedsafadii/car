<?php
$footer_image_url = get_field('as-logo-footer', 'option')['url'];
$footer_description = get_field('as-footer-description', 'option');
$footer_copyright = get_field('as-copyright-text', 'option');
?>
<div id="live-chat">
<a href="https://api.whatsapp.com/send?phone=966509853626" title="whatsapp chat" target="_blank" rel="nofollow noreferrer">
<svg xmlns="http://www.w3.org/2000/svg" width="27" viewBox="0 0 448 512">
<path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
</svg>
</a>
</div>
<footer class="footer__section footer__bg">
    <div class="container">
        <div class="main__footer">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer__widget ">
                        <div class="footer__logo">
                            <a class="footer__logo--link" href="<?php bloginfo('url'); ?>"
                            ><img src="<?= $footer_image_url ?>" alt="logo-img"/></a>
                        </div>
                        <div class="footer__widget--inner  d-block mb-4 mt-3">
                            <p class="footer__widget--desc">
                                <?= $footer_description ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title">
                                    السيارات
                                    <button
                                            class="footer__widget--button"
                                            aria-label="footer widget button"
                                    ></button>
                                    <svg
                                            class="footer__widget--title__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="12.355"
                                            height="8.394"
                                            viewBox="0 0 10.355 6.394"
                                    >
                                        <path
                                                d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)"
                                                fill="currentColor"
                                        ></path>
                                    </svg>
                                </h2>
                                <ul class="footer__widget--menu footer__widget--inner">
                                    <?php
                                    if (have_rows('as-cars-links', 'option')):

                                        while (have_rows('as-cars-links', 'option')) : the_row();

                                            $link = get_sub_field('as-car-link');
                                            if ($link):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                ?>
                                                <li class="footer__widget--menu__list">
                                                    <a class="footer__widget--menu__text"
                                                       href="<?php echo esc_url($link_url); ?>">
                                                        <?php echo esc_html($link_title); ?>
                                                    </a>
                                                </li>
                                            <?php
                                            endif;

                                        endwhile;

                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title">
                                    روابط سريعة
                                    <button
                                            class="footer__widget--button"
                                            aria-label="footer widget button"
                                    ></button>
                                    <svg
                                            class="footer__widget--title__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="12.355"
                                            height="8.394"
                                            viewBox="0 0 10.355 6.394"
                                    >
                                        <path
                                                d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)"
                                                fill="currentColor"
                                        ></path>
                                    </svg>
                                </h2>
                                <?php
                                if (have_rows('as-quick-links', 'option')):

                                    while (have_rows('as-quick-links', 'option')) : the_row();

                                        $link = get_sub_field('as-ql-link');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            ?>
                                            <li class="footer__widget--menu__list">
                                                <a class="footer__widget--menu__text"
                                                   href="<?php echo esc_url($link_url); ?>">
                                                    <?php echo esc_html($link_title); ?>
                                                </a>
                                            </li>
                                        <?php
                                        endif;

                                    endwhile;

                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title">
                                    من نحن
                                    <button
                                            class="footer__widget--button"
                                            aria-label="footer widget button"
                                    ></button>
                                    <svg
                                            class="footer__widget--title__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="12.355"
                                            height="8.394"
                                            viewBox="0 0 10.355 6.394"
                                    >
                                        <path
                                                d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)"
                                                fill="currentColor"
                                        ></path>
                                    </svg>
                                </h2>
                                <ul class="footer__widget--menu footer__widget--inner">
                                    <?php
                                    if (have_rows('as-about-links', 'option')):
                                        while (have_rows('as-about-links', 'option')) : the_row();

                                            $link = get_sub_field('as-about-link');
                                            if ($link):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                ?>
                                                <li class="footer__widget--menu__list">
                                                    <a class="footer__widget--menu__text"
                                                       href="<?php echo esc_url($link_url); ?>">
                                                        <?php echo esc_html($link_title); ?>
                                                    </a>
                                                </li>
                                            <?php
                                            endif;
                                        endwhile;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title">
                                    التواصل السريع
                                    <button
                                            class="footer__widget--button"
                                            aria-label="footer widget button"
                                    ></button>
                                    <svg
                                            class="footer__widget--title__arrowdown--icon"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="12.355"
                                            height="8.394"
                                            viewBox="0 0 10.355 6.394"
                                    >
                                        <path
                                                d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                transform="translate(-6 -8.59)"
                                                fill="currentColor"
                                        ></path>
                                    </svg>
                                </h2>
                                <ul class="social__share footer__social d-flex">
                                    <?php
                                    if (have_rows('as-social-media-links', 'option')):

                                        while (have_rows('as-social-media-links', 'option')) : the_row();
                                            $title = get_sub_field('as-social-media-title');
                                            $icon = get_sub_field('as-social-media-icon');
                                            $link = get_sub_field('as-social-media-link');
                                            ?>
                                            <li class="social__share--list">
                                                <a class="social__share--icon__style2" target="_blank"
                                                   href="<?php echo esc_html($link); ?>">
                                                    <?php echo $icon ?>
                                                    <span class="visually-hidden"><?php echo esc_html($title); ?></span>
                                                </a>
                                            </li>
                                        <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="footer__bottom">
        <div class="container">
            <div
                    class="footer__bottom--inenr d-flex justify-content-between align-items-center"
            >
                <div class="">
                    <ul class="d-flex gap-5">
                        <?php
                        if (have_rows('as-footer-links', 'option')):

                            while (have_rows('as-footer-links', 'option')) : the_row();

                                $link = get_sub_field('as-footer-link');
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    ?>
                                    <li><a href="<?= $link_url ?>" class="text-white"><?= $link_title ?></a></li>
                                <?php
                                endif;

                            endwhile;

                        endif;
                        ?>
                    </ul>
                </div>
                <p class="copyright__content">
              <span class="">
              <?= $footer_copyright ?>
                </p>
            </div>
        </div>
    </div>
</footer>
<button id="scroll__top">
    <svg
            xmlns="http://www.w3.org/2000/svg"
            class="ionicon"
            viewBox="0 0 512 512"
    >
        <path
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292"
        />
    </svg>
</button>
<!-- All Script JS Plugins here  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/vendor/popper.js" defer="defer"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/vendor/bootstrap.min.js" defer="defer"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/plugins/swiper-bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/plugins/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<!-- Customscript js -->
<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('container');
        const elemData = document.getElementById('tab__btn--wrapper');
        const slideButton = document.getElementById('slide');
        const backButton = document.getElementById('slideBack');

        function sideScroll(element, direction, speed, distance, step) {
            let scrollAmount = 0;
            const maxScroll = elemData.offsetWidth - container.offsetWidth;
            const slideTimer = setInterval(function () {
                element.scrollLeft += (direction === 'left' ? -step : step);
                scrollAmount += step;
                if (scrollAmount >= distance) {
                    clearInterval(slideTimer);
                }
            }, speed);

            updateButtons(element.scrollLeft, maxScroll);
        }

        function updateButtons(currentScroll, maxScroll) {
            if (currentScroll >= maxScroll) {
                $('#slideBack').addClass('d-none');
            } else {
                $('#slide').removeClass('d-none');
            }

            if (currentScroll <= 0) {
                $('#slide').addClass('d-none');
                $('#slideBack').removeClass('d-none');
            }
        }

        if (elemData && container) {
            if (elemData.offsetWidth > container.offsetWidth) {
                $('#slideBack').removeClass('d-none');
            }

            slideButton?.addEventListener('click', function () {
                sideScroll(container, 'right', 5, 200, 20);
            });

            backButton?.addEventListener('click', function () {
                sideScroll(container, 'left', 5, 200, 20);
            });
        }
    });
</script>
<script>
    $(document).ready(function () {

        function addSeparator(nStr) {
            return nStr.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function rangeInputChangeEventHandler(e) {
            const minBtn = $(this).parent().children('.min');
            const maxBtn = $(this).parent().children('.max');
            const rangeMin = $(this).parent().children('.range_min');
            const rangeMax = $(this).parent().children('.range_max');
            let minVal = parseInt(minBtn.val());
            let maxVal = parseInt(maxBtn.val());
            const origin = e.originalEvent.target.className;

            if (origin === 'min' && minVal > maxVal - 5) {
                minBtn.val(maxVal - 5);
                minVal = maxVal - 5;
            }
            rangeMin.html(addSeparator(minVal * 1000) + ' ريال');

            if (origin === 'max' && maxVal < minVal + 5) {
                maxBtn.val(minVal + 5);
                maxVal = minVal + 5;
            }
            rangeMax.html(addSeparator(maxVal * 1000) + ' ريال');
        }

        $('input[type="range"]').on('input', rangeInputChangeEventHandler);
    });
</script>
<?php wp_footer(); ?>
</body>
</html>
