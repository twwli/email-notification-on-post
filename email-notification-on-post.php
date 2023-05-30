<?php
/**
* Plugin Name: Email Notification on Post
* Description: Envoie un e-mail lorsqu'un nouvel article est publié
* Version: 1.0
* Author: Votre nom
* Author URI: https://votresite.com/
*/

function send_email_notification($post_ID)  {
    $post = get_post($post_ID);
    $author = get_userdata($post->post_author);

    $subject = "Bitte schaue dir diesen Artikel an.";
    $message = "Bitte schaue dir diesen Artikel an. Bitte überprüfen Sie ihn :\n\n";
    $message .= $post->post_title . "\n\n";
    $message .= get_permalink($post_ID);

    wp_mail('rss-reminder@floatmagazin.de', $subject, $message);

    return $post_ID;
}

add_action('publish_post', 'send_email_notification');
add_action('publish_boote', 'send_email_notification');
add_action('publish_dinge', 'send_email_notification');
add_action('publish_orte', 'send_email_notification');
add_action('publish_leute', 'send_email_notification');