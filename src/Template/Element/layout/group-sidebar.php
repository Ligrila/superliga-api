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
      <?= $this->Html->image('logo.png',['class'=>'expanding-hidden'])?>
      GRUPOS
    </a>
    <!-- /logo -->
  </div>
  <div class="nav-profile dropdown">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
      <div class="user-image">
        <?= $this->Html->image('user.png',['class'=>'avatar img-circle','title'=>'Usuario'])?>
      </div>
      <div class="user-info expanding-hidden">
        <?= $this->request->getSession()->read('Auth.Admin.username')?>
        <small class="bold"><?= $this->request->getSession()->read('Auth.User.email')?></small>
      </div>
    </a>
    <div class="dropdown-menu">
      <span class="dropdown-item">DEPORTE Y DIVERSION</span>
      <div class="dropdown-divider"></div>
      <?= $this->Html->link('Ayuda','mailto:info@rantring.com?subject=DEPORTE Y DIVERSION  - Ayuda en: ' .Cake\Routing\Router::url(null,true),['class'=>'dropdown-item'])?>
      <?= $this->Html->link('Cerrar sesión',['controller'=>'groups','action'=>'logout'],['class'=>'dropdown-item'])?>
    </div>
  </div>
  <!-- main navigation -->
  <nav>
    <p class="nav-title">MENU</p>
    <ul class="nav">
      <!-- dashboard -->
      <li <?= $ia('/group')?>>
        <a href="<?= Router::url('/group')?>">
          <i class="material-icons">home</i>
          <span>Inicio</span>
        </a>
      </li>


      <li <?= $ia('Registrations')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons">settings</i>
          <span>Inscripciones</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'registrations','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'registrations','action'=>'select_event'])?>">
              <span>Administrar inscripciones</span>
            </a>
          </li>
        </ul>
      </li>



    </ul>
  </nav>
  <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
