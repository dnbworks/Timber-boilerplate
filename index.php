<?php


$context = Timber::context();

// Logo
$custom_logo_id = get_theme_mod('custom_logo');
$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
$context['logo'] = $logo[0] ?? null;

// Menu
$context['primary_menu'] = Timber::get_menu('primary');



Timber::render( 'index.twig', $context );
