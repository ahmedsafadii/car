<?php
// Register AJAX actions
add_action('wp_ajax_submit_form_action', 'handle_ajax_form_submission'); // If logged in
add_action('wp_ajax_nopriv_submit_form_action', 'handle_ajax_form_submission'); // If not logged in

function handle_ajax_form_submission()
{
    // Check nonce and other validations
    if (!wp_verify_nonce($_POST['form_submission_nonce'], 'form_submission_nonce')) {
        wp_send_json_error('Invalid nonce.');
        wp_die();
    }

    // Create a new post
    $post_id = wp_insert_post(array(
        'post_type' => $_POST['post_type'],
        'post_status' => 'publish',
        'post_title' => wp_strip_all_tags($_POST['title']),
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error('Error creating post.');
        wp_die();
    }

    // Update ACF fields
    if (function_exists('update_field')) {
        foreach ($_POST as $field_key => $value) {
            // Skip non-ACF fields
            if (in_array($field_key, ['action', 'form_submission_nonce', 'post_type', 'title'])) {
                continue;
            }

            update_field($field_key, $value, $post_id);
        }
    }

    if ($_POST['post_type'] == 'contact') {
        $contact_email = get_field('as-contact-email', 'option');
        $name = $_POST["contact-name"];
        $mobile = $_POST["contact-mobile"];
        $email = $_POST["contact-email"];
        $message = $_POST["contact-message"];
        $admin_msg = "
        <html lang='ar'>
        <head>
            <style>
                * { direction: rtl!important; }
                body { font-family: Arial, sans-serif; direction: rtl!important; }
                .message-container { background-color: #f7f7f7; padding: 20px; direction: rtl!important; }
                .message-header { background: #004aad; color: white; padding: 10px; text-align: center; direction: rtl!important; }
                .message-content { padding: 20px; direction: rtl!important; }
                .message-content p { margin: 10px 0; direction: rtl!important; }
                .message-label { font-weight: bold; direction: rtl!important; }
            </style>
        </head>
        <body>
            <div class='message-container'>
                <div class='message-header'>
                    <h1>رسالة جديدة من $name</h1>
                </div>
                <div class='message-content'>
                    <p><span class='message-label'>الاسم: </span> $name</p>
                    <p><span class='message-label'>البرد الالكتروني: </span> $email</p>
                    <p><span class='message-label'>رقم الجوال:</span> $mobile</p>
                    <p><span class='message-label'>الرسالة :</span><br>$message</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <webmaster@example.com>' . "\r\n";

        wp_mail($contact_email, "رسالة جديدة من " . $name, $admin_msg, $headers);
    }
    wp_send_json_success('Data saved successfully.');
    wp_die();
}

add_action('wp_ajax_submit_form_action', 'handle_ajax_form_submission');
add_action('wp_ajax_nopriv_submit_form_action', 'handle_ajax_form_submission');
