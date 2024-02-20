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
  <div class="brand bg-dark text-md-center">
    <!-- toggle offscreen menu -->
    <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen d-lg-none">
      <i class="material-icons">menu</i>
    </a>
    <!-- /toggle offscreen menu -->
    <!-- logo -->
    <a class="brand-logo">
      <?= $this->Html->image('/admin-assets/img/logo.png',['class'=>'expanding-hidden'])?>
    </a>
    <!-- /logo -->
  </div>
  <div class="nav-profile dropdown">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
      <div class="user-image">
        <?= $this->Html->image('user.png',['class'=>'avatar img-circle','title'=>'Usuario'])?>
      </div>
      <div class="user-info expanding-hidden">
        <?= $this->request->getSession()->read('Auth.Operator.first_name')?>
        <small class="bold"><?= $this->request->getSession()->read('Auth.Operator.email')?></small>
      </div>
    </a>
    <div class="dropdown-menu">
      <span class="dropdown-item">Superliga</span>
      <div class="dropdown-divider"></div>
      <?= $this->Html->link('Ayuda','mailto:info@mocla.us?subject=SuperLiga - Ayuda en: ' .Cake\Routing\Router::url(null,true),['class'=>'dropdown-item'])?>
      <?= $this->Html->link('Cerrar sesión',['controller'=>'operators','action'=>'logout'],['class'=>'dropdown-item'])?>
    </div>
  </div>
  <!-- main navigation -->
  <nav>
    <p class="nav-title">MENU</p>
    <ul class="nav">
      <!-- dashboard -->
      <li <?= $ia(Router::url(['prefix'=>'operators']))?>>
        <a href="<?= Router::url(['controller'=>'trivias','action'=>'current'])?>">
          <i class="material-icons text-primary">home</i>
          <span>Inicio</span>
        </a>
      </li>

      <li <?= $ia('PushNotifications')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-warning">account_box</i>
          <span>Notificationes push</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'push_notifications','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'push_notifications','action'=>'send'])?>">
              <span>Enviar manual</span>
            </a>
          </li>
        </ul>
      </li>




    </ul>
  </nav>
  <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
