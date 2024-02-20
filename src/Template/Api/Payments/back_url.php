<!DOCTYPE html>
<html lang="en" class="h-100 w-100">
<?php if($success):?>
  <head>
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

    </head>

    <body class="h-100 w-100">
    <!-- content panel -->
    <div id="content"  class="h-100 w-100">
      <div class="container h-100">
      <!-- main area -->
      <div  class="h-100 w-100 d-flex align-items-center justify-content-center text-center flex-direction-column">
        <div>
        <h1>Gracias por tu compra. En unos minutos se acreditaran tus vidas a tu cuenta.</h1>
        <p><i class="fa fa-spinner fa-2x fa-spin"></i></p>
        </div>
      </div>
      </div>
      <!-- /main area -->
    </div>
    <!-- /content panel -->

  <script type="text/javascript">
      setTimeout(function () {
        window.postMessage('closeWebView', '*');
      }, 5000);
  </script>
  </body>

<?php else: ?>
<script type="text/javascript">
      setTimeout(function () {
        window.postMessage('closeWebView', '*');
      }, 1000);
  </script>
<?php endif;?>

</html>