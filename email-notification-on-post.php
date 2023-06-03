<?php
/**
* Plugin Name: Email Notification on Post
* Description: Send an email when a new article is published
* Version: 1.1
* Author: Olivier Guillard
* Author URI: https://floatmagazin.de
*/

function send_email_notification($post_ID)  {
    $post = get_post($post_ID);
    $author = get_userdata($post->post_author);

    // Ignore les modifications d'articles déjà publiés
    if ($post->post_date_gmt != $post->post_modified_gmt) {
        return;
    }

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