<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-dotted'); ?>>
    <header class="">
        <div class="container mx-auto p-4 flex justify-center items-center">
            
            <nav class="flex space-x-4">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex space-x-4',
                    'fallback_cb' => false,
                    'items_wrap' => '%3$s',
                    'depth' => 1,
                    'link_before' => '<span class="text-gray-700 hover:text-red-500">',
                    'link_after' => '</span>',
                ));
                ?>
            </nav>
        </div>
    </header>
