<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package csh
 */

if (is_front_page()) {
    $header_class_alt = "container my-8 mx-auto rounded-lg bg-white shadow-xl";
    $shadow_header = true;
}else{
    $header_class_alt = '';
    $shadow_header = false;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site bg-light-blue min-h-screen overflow-x-hidden">
        <header id="vue-header" class="transition-all duration-500 opacity-0 max-h-0 active" style="box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.14);">
            <main-header>
                
            </main-header>
        </header>