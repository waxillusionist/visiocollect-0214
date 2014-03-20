<?php

/* =============================================================================
   Global Header
   ========================================================================== */

global $body_attributes, $body_class;
$body_attributes = isset($body_attributes) && !empty($body_attributes) ? ' '.$body_attributes : '';
$body_class = isset($body_class) && !empty($body_class) ? ' '.$body_class : '';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="/favicon.png">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class($body_class); echo $body_attributes; ?>>
<div id="top-of-page"></div>
