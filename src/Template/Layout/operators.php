<!DOCTYPE html>
<html lang="en">
  <head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="MUTUAL">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="MUTUAL">

    <meta name="theme-color" content="#4c7ff0">
    <?= $this->Html->meta('icon') ?>

    <title>
        <?php // $this->fetch('title')?> Jugada SuperLiga - ADMIN
    </title>

    <!-- page stylesheets -->
    <?= $this->Html->css('/admin-assets/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css') ?>
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <?= $this->Html->css('/admin-assets/css/main') ?>

    <!-- endbuild -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
  </head>
<body>
  <div class="app">
    <?= $this->element('Layout/operators-sidebar')?>
    <!-- content panel -->
    <div class="main-panel">  
      <?= $this->element('Layout/admin-top-header')?>

      <!-- main area -->
      <div class="main-content">
        <div class="content-view">
            <?= $this->fetch('content') ?>
        </div>
        <?= $this->element('Layout/bottom-footer')?>
      </div>
      <!-- /main area -->
    </div>
    <!-- /content panel -->

  </div>
  <?= $this->element('Layout/admin-javascript')?>
  <!-- PostLinks -->
  <?= $this->fetch('postLink') ?>
  <!-- /Postlinks -->
  <?= $this->fetch('script') ?>
</body>
</html>
