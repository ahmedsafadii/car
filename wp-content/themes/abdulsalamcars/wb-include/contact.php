<?php
/**
 * @throws Exception
 */
function contact_element(): void
{
    vc_map(array(
        'name' => 'تواصل',
        'base' => 'car-contact',
        'category' => 'Abdulsalamcars Theme Car',
        'params' => array(
            array(
                'type' => 'textfield',
                'param_name' => 'section_title',
                'heading' => 'عنوان القسم',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'mobile_number',
                'heading' => 'رقم الجوال',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'email_address',
                'heading' => 'البريد الالكتروني',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'whatsapp',
                'heading' => 'رابط الواتساب',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'location_title',
                'heading' => 'الترويسة - الموقع',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'location_address',
                'heading' => 'عنوان - الموقع',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'location_mobile',
                'heading' => 'رقم الجوال - الموقع',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'location_email',
                'heading' => 'بريد الكتروني - الموقع',
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'location_google_map',
                'heading' => ' جوجل ماب - الموقع',
            )
        ),
    ));
}

add_action('vc_before_init', 'contact_element');


/**
 * Shortcode to display contact
 *
 * @param $data
 * @return string HTML content.
 */
function contact_shortcode($data): string
{
    // Extract and sanitize the shortcode attributes
    $data = shortcode_atts(array(
        'section_title' => '',
        'mobile_number' => '',
        'email_address' => '',
        'whatsapp' => '',
        'location_title' => '',
        'location_address' => '',
        'location_mobile' => '',
        'location_email' => '',
        'location_google_map' => '',
    ), $data, 'car-contact');


    return '<main class="main__content_wrapper">
        <section class="contact__section section--padding">
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                <div class=" border-radius-5 bg-soft-primary py-5">
                <div class=" contact__info  px-5">
                <h3 class="pb-5">' . $data["section_title"] . ' :</h3>
                    <div class="contact__info--items">
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon bg-white">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_103_1774)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.01867 2.61933C6.30959 1.32841 8.4446 1.48014 9.53999 2.94066L11.3583 5.36502C12.254 6.55938 12.1353 8.23066 11.0796 9.28634L9.73902 10.6269C9.86893 10.9651 10.2966 11.7071 11.599 13.0095C12.9014 14.3119 13.6435 14.7396 13.9817 14.8695L15.3222 13.529C16.3779 12.4733 18.0492 12.3545 19.2435 13.2503L21.6679 15.0686C23.1284 16.164 23.2802 18.299 21.9892 19.5899C21.5695 20.0096 21.4985 20.0806 20.7981 20.781C20.0843 21.4948 18.5687 22.162 17.0341 22.2287C14.6328 22.3331 11.3711 21.2669 7.35638 17.2522C3.3417 13.2375 2.27544 9.97574 2.37984 7.57442C2.43792 6.23862 2.86261 4.77149 3.83315 3.81603C4.52795 3.11005 4.6183 3.0197 5.01867 2.61933ZM4.37796 7.6613C4.30558 9.32584 5.00709 12.0745 8.77059 15.838C12.5341 19.6015 15.2827 20.303 16.9473 20.2306C18.5011 20.163 19.3347 19.4122 19.3839 19.3668L20.575 18.1757C21.0053 17.7454 20.9547 17.0337 20.4679 16.6686L18.0435 14.8503C17.6454 14.5517 17.0883 14.5913 16.7364 14.9432C16.2062 15.4734 15.8443 15.8407 15.1359 16.5464C13.6643 18.0125 11.1452 15.3841 10.1848 14.4238C9.30222 13.5412 6.61256 10.9421 8.06071 9.47679C8.06357 9.47392 8.45363 9.08387 9.66537 7.87213C10.0173 7.52023 10.0568 6.96314 9.75826 6.56502L7.93999 4.14066C7.57486 3.65382 6.86319 3.60324 6.43288 4.03355C6.03683 4.4296 5.58861 4.87782 5.24297 5.22585C4.5316 5.94213 4.41603 6.7857 4.37796 7.6613Z" fill="#D7442A"/>
</g>
<defs>
<clipPath id="clip0_103_1774">
<rect width="24" height="24" fill="white" transform="translate(0.371094 0.266907)"/>
</clipPath>
</defs></svg> 
                                </div>
                                <div class="contact__info--content">
                                    <p class=" "><a href="callto:' . $data["mobile_number"] . '">رقم الجوال : ' . $data["mobile_number"] . '</a></p> 
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon bg-white">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M20.375 5.96082H4.375C3.82272 5.96082 3.375 6.40853 3.375 6.96082V18.9608C3.375 19.5131 3.82272 19.9608 4.375 19.9608H20.375C20.9273 19.9608 21.375 19.5131 21.375 18.9608V6.96082C21.375 6.40853 20.9273 5.96082 20.375 5.96082ZM4.375 3.96082C2.71815 3.96082 1.375 5.30396 1.375 6.96082V18.9608C1.375 20.6177 2.71815 21.9608 4.375 21.9608H20.375C22.0319 21.9608 23.375 20.6177 23.375 18.9608V6.96082C23.375 5.30396 22.0319 3.96082 20.375 3.96082H4.375Z" fill="#D7442A"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.6068 8.32066C5.96037 7.89638 6.59093 7.83906 7.01521 8.19262L11.7348 12.1256C12.1057 12.4347 12.6444 12.4347 13.0152 12.1256L17.7348 8.19262C18.1591 7.83906 18.7897 7.89638 19.1432 8.32066C19.4968 8.74493 19.4395 9.3755 19.0152 9.72906L14.2956 13.6621C13.183 14.5892 11.567 14.5892 10.4545 13.6621L5.73484 9.72906C5.31056 9.3755 5.25324 8.74493 5.6068 8.32066Z" fill="#D7442A"/>
</svg>
                                </div>
                                <div class="contact__info--content">
                                    <p class=" "><a href="mailto:' . $data["email_address"] . '">البريد الالكتروني: ' . $data["email_address"] . '</a></p> 
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon bg-white">
               
<svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.88477 18.8155C8.20492 19.6076 9.7891 20.0476 11.3733 20.0476C16.2139 20.0476 20.1743 16.0871 20.1743 11.2466C20.1743 6.40602 16.2139 2.44556 11.3733 2.44556C6.53273 2.44556 2.57227 6.40602 2.57227 11.2466C2.57227 12.8308 3.01232 14.3269 3.7164 15.6471L3.01271 18.3536C2.81799 19.1025 3.51119 19.7793 4.25525 19.5667L6.88477 18.8155Z" stroke="#D7442A" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.335 13.7536C15.335 13.8961 15.3033 14.0427 15.2358 14.1853C15.1684 14.3278 15.0811 14.4625 14.9661 14.5892C14.7718 14.8031 14.5576 14.9575 14.3156 15.0566C14.0776 15.1556 13.8198 15.2071 13.5422 15.2071C13.1376 15.2071 12.7053 15.112 12.2491 14.9179C11.793 14.7239 11.3368 14.4625 10.8847 14.1338C10.4285 13.8011 9.99619 13.4328 9.58369 13.0248C9.17515 12.613 8.80627 12.1813 8.47706 11.7298C8.15181 11.2783 7.89003 10.8268 7.69964 10.3793C7.50926 9.92776 7.41406 9.49607 7.41406 9.08418C7.41406 8.81487 7.46166 8.55744 7.55685 8.31981C7.65205 8.07822 7.80277 7.85644 8.01299 7.65842C8.26684 7.40891 8.54449 7.28613 8.838 7.28613C8.94906 7.28613 9.06012 7.3099 9.15928 7.35742C9.26241 7.40495 9.35364 7.47623 9.42503 7.57921L10.3452 8.87428C10.4166 8.97329 10.4682 9.06438 10.5039 9.15151C10.5396 9.23468 10.5594 9.31785 10.5594 9.3931C10.5594 9.48815 10.5317 9.5832 10.4761 9.67429C10.4246 9.76538 10.3492 9.86043 10.254 9.95548L9.95256 10.2684C9.90893 10.3119 9.8891 10.3634 9.8891 10.4268C9.8891 10.4585 9.89307 10.4862 9.901 10.5179C9.9129 10.5496 9.9248 10.5733 9.93273 10.5971C10.0041 10.7278 10.1271 10.8981 10.3016 11.104C10.4801 11.31 10.6705 11.5199 10.8767 11.7298C11.0909 11.9397 11.2972 12.1337 11.5074 12.312C11.7137 12.4862 11.8842 12.605 12.0191 12.6763C12.0389 12.6842 12.0627 12.6961 12.0905 12.708C12.1222 12.7199 12.1539 12.7238 12.1896 12.7238C12.257 12.7238 12.3086 12.7001 12.3522 12.6565L12.6537 12.3595C12.7528 12.2605 12.848 12.1852 12.9393 12.1377C13.0305 12.0822 13.1217 12.0545 13.2209 12.0545C13.2962 12.0545 13.3756 12.0704 13.4628 12.106C13.5501 12.1417 13.6413 12.1931 13.7405 12.2605L15.0534 13.1912C15.1565 13.2625 15.2279 13.3456 15.2715 13.4446C15.3112 13.5437 15.335 13.6427 15.335 13.7536Z" fill="#D7442A"/>
</svg> 
                                </div>
                                <div class="contact__info--content">
                                    <p class=" "><a target="_blank" href="' . $data["whatsapp"] . '">واتساب : اضغط هنا</a></p> 
                                </div>
                            </div>
                        </div>
                    </div>    
                    </div>    
                    </div>    
                <div class="col-md-8">
                <div class="contact__form border rounded-16 p-5">
                    <form method="POST" class="contact__form--inner" id="contact_form" name="contact_form" action="#">
                     <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="input1">الاسم <span class="contact__form--label__star">*</span></label>
                                        <input required class="contact__form--input" name="contact-name" id="input1" placeholder="الاسم" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="input2">البريد الالكتروني <span class="contact__form--label__star">*</span></label>
                                        <input required class="contact__form--input" name="contact-email" id="input2" placeholder="البريد الالكتروني*" type="email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="contact__form--list mb-20">
                                        <label class="contact__form--label" for="input3">رقم الجوال <span class="contact__form--label__star">*</span></label>
                                        <input required class="contact__form--input" name="contact-mobile" id="input3" placeholder="رقم الجوال" type="text">
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="contact__form--list mb-15">
                                        <label class="contact__form--label" for="input5">رسالتك <span class="contact__form--label__star"></span></label>
                                        <textarea class="contact__form--textarea" name="contact-message" id="input5" placeholder="رسالتك"></textarea>
                                    </div>
                                </div>
                            </div>
                           <div class="text-end"> <button class="contact__form--btn primary__btn" type="submit"> <span>ارسال</span></button>  </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact__section">
            <div class="container ">
            <div class=" border p-5 rounded-16">
                <div class="row">
                <div class="col-md-4">
                <div class=" border-radius-5  py-5">
                <div class=" contact__info">
                <h3 class="mb-3">' . $data["location_title"] . '</h3>
                <p>' . $data["location_address"] . '</p>
                <br>
                    <div class="contact__info--items">
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon bg-soft-primary">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_103_1774)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.01867 2.61933C6.30959 1.32841 8.4446 1.48014 9.53999 2.94066L11.3583 5.36502C12.254 6.55938 12.1353 8.23066 11.0796 9.28634L9.73902 10.6269C9.86893 10.9651 10.2966 11.7071 11.599 13.0095C12.9014 14.3119 13.6435 14.7396 13.9817 14.8695L15.3222 13.529C16.3779 12.4733 18.0492 12.3545 19.2435 13.2503L21.6679 15.0686C23.1284 16.164 23.2802 18.299 21.9892 19.5899C21.5695 20.0096 21.4985 20.0806 20.7981 20.781C20.0843 21.4948 18.5687 22.162 17.0341 22.2287C14.6328 22.3331 11.3711 21.2669 7.35638 17.2522C3.3417 13.2375 2.27544 9.97574 2.37984 7.57442C2.43792 6.23862 2.86261 4.77149 3.83315 3.81603C4.52795 3.11005 4.6183 3.0197 5.01867 2.61933ZM4.37796 7.6613C4.30558 9.32584 5.00709 12.0745 8.77059 15.838C12.5341 19.6015 15.2827 20.303 16.9473 20.2306C18.5011 20.163 19.3347 19.4122 19.3839 19.3668L20.575 18.1757C21.0053 17.7454 20.9547 17.0337 20.4679 16.6686L18.0435 14.8503C17.6454 14.5517 17.0883 14.5913 16.7364 14.9432C16.2062 15.4734 15.8443 15.8407 15.1359 16.5464C13.6643 18.0125 11.1452 15.3841 10.1848 14.4238C9.30222 13.5412 6.61256 10.9421 8.06071 9.47679C8.06357 9.47392 8.45363 9.08387 9.66537 7.87213C10.0173 7.52023 10.0568 6.96314 9.75826 6.56502L7.93999 4.14066C7.57486 3.65382 6.86319 3.60324 6.43288 4.03355C6.03683 4.4296 5.58861 4.87782 5.24297 5.22585C4.5316 5.94213 4.41603 6.7857 4.37796 7.6613Z" fill="#D7442A"/>
</g>
<defs>
<clipPath id="clip0_103_1774">
<rect width="24" height="24" fill="white" transform="translate(0.371094 0.266907)"/>
</clipPath>
</defs></svg> 
                                </div>
                                <div class="contact__info--content">
                                    <p class=" "><a href="callto:' . $data["location_mobile"] . '">رقم الجوال : ' . $data["location_mobile"] . '</a></p> 
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon bg-soft-primary">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M20.375 5.96082H4.375C3.82272 5.96082 3.375 6.40853 3.375 6.96082V18.9608C3.375 19.5131 3.82272 19.9608 4.375 19.9608H20.375C20.9273 19.9608 21.375 19.5131 21.375 18.9608V6.96082C21.375 6.40853 20.9273 5.96082 20.375 5.96082ZM4.375 3.96082C2.71815 3.96082 1.375 5.30396 1.375 6.96082V18.9608C1.375 20.6177 2.71815 21.9608 4.375 21.9608H20.375C22.0319 21.9608 23.375 20.6177 23.375 18.9608V6.96082C23.375 5.30396 22.0319 3.96082 20.375 3.96082H4.375Z" fill="#D7442A"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M5.6068 8.32066C5.96037 7.89638 6.59093 7.83906 7.01521 8.19262L11.7348 12.1256C12.1057 12.4347 12.6444 12.4347 13.0152 12.1256L17.7348 8.19262C18.1591 7.83906 18.7897 7.89638 19.1432 8.32066C19.4968 8.74493 19.4395 9.3755 19.0152 9.72906L14.2956 13.6621C13.183 14.5892 11.567 14.5892 10.4545 13.6621L5.73484 9.72906C5.31056 9.3755 5.25324 8.74493 5.6068 8.32066Z" fill="#D7442A"/>
</svg>
                                </div>
                                <div class="contact__info--content">
                                    <p class=" "><a href="emailto:' . $data["location_email"] . '">البريد الالكتروني: ' . $data["location_email"] . '</a></p> 
                                </div>
                            </div>
                        </div>
                    </div>    
                    </div>    
                    </div>    
                <div class="col-md-8">
                <div class="contact__map--area ">
            <iframe class="contact__map--iframe" src="' . $data["location_google_map"] . '" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
    <script>
        jQuery(document).ready(function($) {
            new AjaxFormManager(
                "contact_form",
                "contact",
                function() { // Dynamic title generation
                    var contactNameElements = document.getElementsByName("contact-name");
                    var contactName = contactNameElements.length > 0 ? contactNameElements[0].value : "";
                    return "رسالة جديدة من " + contactName;
                },
                function(response) { // onSuccess
                    notifyMessage("success", "لقد تم ارسال رسالتك بنجاح");
                    console.log(response);
                    document.getElementById("contact_form").reset();
                },
                function(response) { // onError
                    notifyMessage("error", "حدث خطأ ما، يرجى التواصل مع الدعم الفني");
                    console.log(response);
                }
            );
        });
    </script>';
}

add_shortcode('car-contact', 'contact_shortcode');