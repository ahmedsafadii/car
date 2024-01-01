<?php
$footer_image_url = get_field('as-logo-footer', 'option')['url'];
$footer_description = get_field('as-footer-description', 'option');
$footer_copyright = get_field('as-copyright-text', 'option');
?>
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
