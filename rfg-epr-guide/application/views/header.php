<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, viewport-fit=cover">
  <title>RFG EPR Guide - Beta Testing</title>

  <link rel="manifest" href="manifest.json">
  <!-- favicons -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-57x57.png'); ?>">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-114x114.png'); ?>">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-72x72.png'); ?>">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-144x144.png'); ?>">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-60x60.png'); ?>">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-120x120.png'); ?>">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-76x76.png'); ?>">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/site_favicon/apple-touch-icon-152x152.png'); ?>">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/site_favicon/favicon-196x196.png'); ?>" sizes="196x196">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/site_favicon/favicon-160x160.png'); ?>" sizes="160x160">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/site_favicon/favicon-96x96.png'); ?>" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/site_favicon/favicon-16x16.png'); ?>" sizes="16x16">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/site_favicon/favicon-32x32.png'); ?>" sizes="32x32">
  <meta name="msapplication-TileColor" content="#2b5797">
  <meta name="msapplication-TileImage" content="<?php echo base_url('assets/site_favicon/mstile-144x144.png'); ?>">
  <meta name="msapplication-config" content="<?php echo base_url('assets/site_favicon/browserconfig.xml'); ?>">
  <meta name="theme-color" content="#29b6f6">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/materialize.min.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <div class="appinstallprompt valign-wrapper z-depth-2" id="androidinstall">
    <div class="center" style="margin-left:auto; margin-right: auto;">
      <p>Install this Web App: <button class="btn waves-effect waves-light pulse" id="androidprompt">Install<i class="material-icons right">play_for_work</i></button></p>
    </div>
  </div>
  <div id="iphonexnotchbar" class="light-blue lighten-1"></div>
  <nav class="light-blue lighten-1 headernav" role="navigation" id="navbar">
    <div class="nav-wrapper container"><a id="logo-container" class="brand-logo"><img src="<?php echo base_url('assets/site_favicon/mstile-70x70.png'); ?>" /></a>
      <ul class="right hide-on-med-and-down">
        <li><a data-route="home">Home</a></li>
        <li><a data-route="about">About</a></li>
        <li><a data-route="readiness">My Readiness</a></li>
        <li><a data-route="howto">How To</a></li>
        <li><a data-route="workflows">Workflows</a></li>
        <li><a data-route="cutover">Cutover</a></li>
        <li><a data-route="contact">Contact</a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a class="sidenav-close"><h5>RFG EPR Guide</h5></a></li>
        <li><div class="divider"></div></li>
        <li><a data-route="home" class="sidenav-close">Home</a></li>
        <li><a data-route="about" class="sidenav-close">About</a></li>
        <li><a data-route="readiness" class="sidenav-close">My Readiness</a></li>
        <li><a data-route="howto" class="sidenav-close">How To Guides</a></li>
        <li><a data-route="workflows" class="sidenav-close">Workflows</a></li>
        <li><a data-route="cutover" class="sidenav-close">Cutover Plans</a></li>
        <li><a data-route="contact" class="sidenav-close">Contact Us</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <noscript><h1>Please enable JavaScript for this web app to function!</h1></noscript>