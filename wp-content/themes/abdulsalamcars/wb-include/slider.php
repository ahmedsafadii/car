<?php
/**
 * @throws Exception
 */
function slider_element(): void
{
    vc_map(array(
        'name' => 'سلايدر',
        'base' => 'car-slider',
        'category' => 'Abdulsalamcars Theme Car'
    ));
}

add_action('vc_before_init', 'slider_element');

function get_taxonomy_hierarchy($taxonomy, $parent = 0): array
{
    // Fetch all terms for a taxonomy
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'parent' => $parent
    ));

    $children = array();

    // Go through all terms and build a hierarchy
    foreach ($terms as $term) {
        $term_children = get_taxonomy_hierarchy($taxonomy, $term->term_id);
        $children[] = array(
            'id' => $term->term_id,
            'name' => $term->name,
            'slug' => $term->slug,
            'children' => $term_children
        );
    }

    return $children;
}

/**
 * Shortcode to display slider
 *
 * @param $data
 * @return string HTML content.
 */
function slider_shortcode($data): string
{

    shortcode_atts(array(), $data, 'car-slider');

    $args = array(
        'post_type' => 'slider',
        'posts_per_page' => 5,
    );

    $query = new WP_Query($args);

    $sliders = '';

    while ($query->have_posts()) {
        $query->the_post();
        $slider_normal_text = get_field('slider-normal-text');
        $slider_strong_text = get_field('slider-strong-text');
        $slider_normal_2 = get_field('slider-strong-2');
        $slider_image = get_field('slider-image');
        $slider_link = get_field('slider-button-link');
        $slider_link_text = get_field('slider-text-button');

        $sliders .= '<div class="swiper-slide">
                <div class="hero__slider--items__style3 d-flex align-items-center justify-content-between">
                  <div class="slider__content p-md-5">
                    <h2 class="slider__maintitle style3 h1">
                    ' . $slider_normal_text . ' <strong>' . $slider_strong_text . '</strong> ' . $slider_normal_2 . '
                    </h2>
                    <a class="primary__btn slider__btn" href="' . $slider_link . '">
                    ' . $slider_link_text . '
                    </a>
                  </div>
                  <div class="hero__slider--layer__style3">
                    <img class="slider__layer--img" src="' . $slider_image["url"] . '" alt="slider-img" />
                  </div>
                </div>
              </div>';
    }

    $social_media_data = get_field('as-social-media-links', 'option');

    $social_media_links = '';

    foreach ($social_media_data as $social) {
        $social_media_links .= '<li class="social__share--list">
        <a class="social__share--icon__style2" target="_blank" href="' . $social['as-social-media-link'] . '">
            ' . $social['as-social-media-icon'] . '
            <span class="visually-hidden">' . $social['as-social-media-title'] . '</span>
        </a>
    </li>';
    }

    $taxonomy_hierarchy = get_taxonomy_hierarchy('brand');


    return '<section class="container ">
      <div class=" hero__slider--section slider__section--bg3">
        <div class="">
          <div class="hero__slider--inner hero__slider--activation-1 swiper">
            <div class="hero__slider--wrapper swiper-wrapper">
              ' . $sliders . '
            </div>
            <div class="navSocails">
            <div class="slider__pagination swiper-pagination"></div>
            <ul class="social__share footer__social d-flex mt-0">
            ' . $social_media_links . '
            </ul>
            </div>
          </div>
        </div>
        <div class="">
          <div class="search__filter--inner">
            <form class="row d-flex" action="">
              <div class="col-md-4  mb-3 mb-md-0">
              <div class="predictive__search--form ">
            <label>
              <input name="s" class="predictive__search--input rounded bg-soft-primary border-0 rounded-16" placeholder="مثال: هيونداي اكسنت" type="text">
            </label>
            <button class="predictive__search--button text-dark" aria-label="search button">
              <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51" height="25.443" viewBox="0 0 512 512">
                <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"></path>
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
              </svg>
            </button>
</div>
              </div>
              <div class="col-md-8">
              <div class="row">
              <div class="col-md-3 mb-3 mb-md-0">
                <label for="" class="text-muted small">العلامة التجارية</label>  
                <div class=" search__filter--select select ">
<select id="brandSelect" name="car_brand_id" class="search__filter--select__field">
  <option selected value="">جميع العلامات</option>
</select>
              </div>
              </div>
              <div class="col-md-3 mb-3 mb-md-0">
                <label for="" class="text-muted small">اختر النوع</label>        
                <div class="search__filter--select select">
<select id="modelSelect" name="car_model_id" class="search__filter--select__field" disabled>
  <option selected value="">جميع الانواع</option>
</select>
              </div>
              </div>
              <div class="col-md-3  mb-3 mb-md-0">
                <label for="" class="text-muted small">اختر الفئة</label>  
                <div class=" search__filter--select select ">
<select id="typeSelect" name="car_model_type" class="search__filter--select__field" disabled>
  <option selected value="">جميع الفئات</option>
</select>
              </div>
              </div>
                <div class="col-md-3 search__filter--select">
                <button class="search__filter--btn primary__btn py-2 h-auto" type="submit">
                  بحث
                </button>
              </div>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      </section>
      <script>
      document.addEventListener("DOMContentLoaded", function() {
  var jsonData = '.json_encode($taxonomy_hierarchy).';

  var brandSelect = document.getElementById("brandSelect");
  var modelSelect = document.getElementById("modelSelect");
  var typeSelect = document.getElementById("typeSelect");

  // Populate the brand select
  jsonData.forEach(function(brand) {
    var option = new Option(brand.name, brand.id);
    brandSelect.add(option);
  });

  // When the brand select changes, update the model select
  brandSelect.onchange = function() {
    modelSelect.innerHTML = "<option selected value=\"\">جميع الانواع</option>";
    typeSelect.innerHTML = "<option selected value=\"\">جميع الفئات</option>";
    typeSelect.disabled = true;

    var selectedBrand = this.options[this.selectedIndex].value;
    if (selectedBrand) {
      jsonData.forEach(function(brand) {
        if (brand.id == selectedBrand) {
          brand.children.forEach(function(model) {
            var option = new Option(model.name, model.id);
            modelSelect.add(option);
          });
          modelSelect.disabled = false;
        }
      });
    } else {
      modelSelect.disabled = true;
    }
  };

  // When the model select changes, update the type select
  modelSelect.onchange = function() {
    typeSelect.innerHTML = "<option selected value=\"\">جميع الفئات</option>";

    var selectedModel = this.options[this.selectedIndex].value;
    if (selectedModel) {
      jsonData.forEach(function(brand) {
        brand.children.forEach(function(model) {
          if (model.id == selectedModel) {
            model.children.forEach(function(type) {
              var option = new Option(type.name, type.id);
              typeSelect.add(option);
            });
            typeSelect.disabled = false;
          }
        });
      });
    } else {
      typeSelect.disabled = true;
    }
  };
});
  
</script>';
}

add_shortcode('car-slider', 'slider_shortcode');