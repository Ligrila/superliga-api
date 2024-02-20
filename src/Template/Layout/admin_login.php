<!DOCTYPE html>
<html lang="en">
  <head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"/>
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="ATSA">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ATSA">

    <meta name="theme-color" content="#4c7ff0">

    <title>
        <?= $this->fetch('title') ?> - Jugada SuperLiga
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
    <div class="app no-padding no-footer layout-static">
      <div class="session-panel">
        <div class="session">
          <div class="session-content">
            <div class="card card-block form-layout">
              <?= $this->fetch('content')?>
          </div>
          <footer class="text-center p-4">
            <p>
              <?php if(empty($forgotLink)): ?>
              <a
                class="text-dark"
                href="mailto:info@mocla.us?subject=SuperLiga - Olvide mi contraseña">
                <strong>¿Olvidaste tu contraseña?</strong>
              </a>
            <?php else:?>
              <?= $forgotLink?>
            <?php endif;?>
            </p>
          </footer>
        </div>

      </div>
    </div>
  <?= $this->element('Layout/admin-javascript')?>
  <?= $this->fetch('script') ?>
  </body>
  </html>
