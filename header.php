<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo('charset') ?>"/>
  <title><?php 
  wp_title('|','true','right');
  bloginfo('name');?></title>
  <link rel="pingback" href="<?php bloginfo('pingback_url')?>"/>
  <?php wp_head();?>
</head>
<body>
<nav class="navbar navbar-inverse">
<div class="container">
  <div class="navbar-header">
  <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a>
  </div>
  <div class="collapse navbar-collapse" id="navbarNav">
  <?php bootstrap_menu() ?>    
  </div>
  </div>
</nav>

