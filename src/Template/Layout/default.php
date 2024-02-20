<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134136471-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-134136471-1');
    </script>

    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Jugada SuperLiga">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Jugada SuperLiga">

    <meta name="theme-color" content="#7b3e96">
    <?= $this->Html->meta('icon') ?>

    <title>
        <?= $this->fetch('title')?> - Jugada SuperLiga
    </title>

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <?= $this->Html->css('main') ?>

    <!-- endbuild -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
  </head>
  <?php
    $isHome = $this->request->getParam('url') == '';
    $controller = strtolower($this->request->getParam('controller'));
    $bodyAttr = $isHome ? ' class="home '.$controller.'"' : ' class="'.$controller.'"';
  ?>
<body <?=$bodyAttr?>>
    <?php if(!isset($_GET['no_header'])):?>
      <?= $this->element('Layout/header')?>
    <?php else:?>
    <?php /* <div class="mb-3 mt-3"></div> */ ?>
    <?php endif;?>
    <?= $this->element('Layout/toolbar')?>
    <!-- content panel -->
    <div id="content">
      <!-- main area -->
      <?php echo $this->Flash->render(); ?>
      <?= $this->fetch('content') ?>
      <!-- /main area -->
    </div>
    <?php
    if(!isset($noFooter)){
      $noFooter = isset($_GET['no_footer']);
    }
    ?>
    <?php if(!$noFooter):?>
        <?= $this->element('Layout/footer')?>
    <?php endif;?>
    <!-- /content panel -->

  <?= $this->element('Layout/javascript')?>
  <?= $this->fetch('script') ?>
</body>
</html>
