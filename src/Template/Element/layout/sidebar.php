<?php
  use Cake\Routing\Router;
  $request = $this->request;
  $ia = function($c) use ($request){ // isActive
    if($c==$request->params['_matchedRoute']){
      return ' class="active open"';
    }
    if($c==$request->params['controller']){
      return ' class="active open"';
    }
    return null;
  }
 ?>
<!--sidebar panel-->
<div class="off-canvas-overlay hidden-print" data-toggle="sidebar"></div>
<div class="sidebar-panel hidden-print">
  <div class="brand">
    <!-- toggle offscreen menu -->
    <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
      <i class="material-icons">menu</i>
    </a>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
    <a class="brand-logo">
      <?php $this->Html->image('logo.png',['class'=>'expading-hidden'])?>
      Kyros
    </a>
    <!-- /logo -->
  </div>
  <div class="nav-profile dropdown">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
      <div class="user-image">
        <?= $this->Html->image('user.png',['class'=>'avatar img-circle','title'=>'Usuario'])?>
      </div>
      <div class="user-info expanding-hidden">
        <?= $this->request->getSession()->read('Auth.User.username')?>
        <small class="bold"><?= $this->request->getSession()->read('Auth.User.email')?></small>
      </div>
    </a>
    <div class="dropdown-menu">
      <span class="dropdown-item">Kyros</span>
      <div class="dropdown-divider"></div>
      <?= $this->Html->link('Ayuda','mailto:info@mocla.us?subject=Kyros  - Ayuda en: ' .Cake\Routing\Router::url(null,true),['class'=>'dropdown-item'])?>
      <?= $this->Html->link('Cerrar sesión',['controller'=>'users','action'=>'logout'],['class'=>'dropdown-item'])?>
    </div>
  </div>
  <!-- main navigation -->
  <nav>
    <p class="nav-title">MENU</p>
    <ul class="nav">
      <!-- dashboard -->
      <li <?= $ia('/')?>>
        <a href="<?= Router::url('/')?>">
          <i class="material-icons">home</i>
          <span>Inicio</span>
        </a>
      </li>
      <!-- /dashboard -->
      <!-- apps -->
      <li <?= $ia('Events')?>>
        <a href="<?= Router::url(['controller'=>'events','action'=>'index'])?>">
          <i class="material-icons text-warning">event</i>
          <span>Inscribirse a un evento</span>
        </a>
      </li>
      <li <?= $ia('Registrations')?>>
        <a href="<?= Router::url(['controller'=>'registrations','action'=>'index'])?>">
          <i class="material-icons text-success">event_available</i>
          <span>Mis eventos</span>
        </a>
      </li>
      <li <?= $ia('News')?>>
        <a href="<?= Router::url(['controller'=>'news','action'=>'index'])?>">
          <i class="material-icons text-info">library_books</i>
          <span>Noticias</span>
        </a>
      </li>
      <li <?= $ia('Users')?>>
        <a href="<?= Router::url(['controller'=>'users','action'=>'edit'])?>">
          <i class="material-icons text-success">people</i>
          <span>Mis datos</span>
        </a>
      </li>
  <!-- /item -->

    </ul>
  </nav>
  <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
