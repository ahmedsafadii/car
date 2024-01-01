<?php
/**
 * @throws Exception
 */
function request_purchase_element(): void
{
    vc_map(array(
        'name' => 'طلب شراء',
        'base' => 'request-purchase',
        'category' => 'Abdulsalamcars Theme Car',
        'params' => array(
            array(
                'type'        => 'textfield',
                'param_name'  => 'title',
                'heading'     => 'عنوان',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'attach_image',
                'param_name'  => 'image',
                'heading'     => 'صورة',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'textarea',
                'param_name'  => 'description',
                'heading'     => 'وصف',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'button_1_text',
                'heading'     => 'نص الزر الأول',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'button_1_link',
                'heading'     => 'رابط الزر الأول',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'button_2_text',
                'heading'     => 'نص الزر الثاني',
                'value'       => '',
                'description' => '',
            ),
            array(
                'type'        => 'textfield',
                'param_name'  => 'button_2_link',
                'heading'     => 'رابط الزر الثاني',
                'value'       => '',
                'description' => '',
            )
        )
    ));
}

add_action('vc_before_init', 'request_purchase_element');


/**
 * Shortcode to display request purchase
 *
 * @param $data
 * @return string HTML content.
 */
function request_purchase_shortcode($data): string {
    // Extract and sanitize the shortcode attributes
    $data = shortcode_atts(array(
        'image' => '',
        'title' => '',
        'description' => '',
        'button_1_text' => '',
        'button_1_link' => '',
        'button_2_text' => '',
        'button_2_link' => ''
    ), $data, 'request-purchase');

    $image_field = $data['image'] ? wp_get_attachment_url( $data['image'] ) : '';

    return '<section class="discount__banner--section section--padding pt-5">
        <div class="container">
          <div class="discount__banner--thumbnail position-relative text-white">
            <img
              class="border-radius-5 discount__banner--img__height"
              src="' . $image_field . '"
              alt="banner-img"
            />
            <div class="discount__banner--content">
            
              <h2 class="discount__banner--content__title text-white">
              ' . esc_attr($data["title"]) . '
              </h2>
              <p class="small">
              ' . esc_attr($data["description"]) . '
              </p>
              <a
                class="discount__banner--content__btn btn-lg primary__btn px-5"
                href="'.esc_url($data["button_1_link"]).'"
                >' . esc_attr($data["button_1_text"]) . '</a>
              <a
                class="discount__banner--content__btn btn-lg secondary__btn px-5"
                href="'.esc_url($data["button_2_link"]).'"
                >' . esc_attr($data["button_2_text"]) . '</a>
            </div>
          </div>
        </div>
      </section>';
}

add_shortcode('request-purchase', 'request_purchase_shortcode');