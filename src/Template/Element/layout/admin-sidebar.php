<?php
  use Cake\Routing\Router;
  $request = $this->request;
  $ia = function($c) use ($request){ // isActive
    if($c==$request->getParam('_matchedRoute')){
      return ' class="active open"';
    }
    if($c==$request->getParam('controller')){
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
        <?= $this->Html->image('/admin-assets/img/user.png',['class'=>'avatar img-circle','title'=>'Usuario'])?>
      </div>
      <div class="user-info expanding-hidden">
        <span class="font-weight-light">
            <?= $this->request->getSession()->read('Auth.Admin.first_name')?>
        </span>
        <small class="font-weight-bold"
          ><?= $this->request->getSession()->read('Auth.Admin.email')?>
        </small>
      </div>
    </a>
    <div class="dropdown-menu">
      <span class="dropdown-item">Universal Coin</span>
      <div class="dropdown-divider"></div>
      <?= $this->Html->link('Ayuda','mailto:info@mocla.us?subject=SuperLiga - Ayuda en: ' .Cake\Routing\Router::url(null,true),['class'=>'dropdown-item'])?>
      <?= $this->Html->link('Cerrar sesión',['controller'=>'superusers','action'=>'logout'],['class'=>'dropdown-item'])?>
    </div>
  </div>
  <!-- main navigation -->
  <nav>
    <p class="nav-title">MENU</p>
    <ul class="nav">
      <!-- dashboard -->
      <li <?= $ia(Router::url(['prefix'=>'Admin']))?>>
        <a href="<?= Router::url(['controller'=>'trivias','action'=>'current'])?>">
          <i class="material-icons text-primary">home</i>
          <span>Inicio</span>
        </a>
      </li>
      <!-- /dashboard -->
        <!-- dashboard -->
        <li <?= $ia('Dashboard')?>>
        <a href="<?= Router::url(['controller'=>'dashboard','action'=>'index'])?>">
          <i class="material-icons text-primary">dashboard</i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- /dashboard -->

      <li <?= $ia('Dates')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Fechas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'dates','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'dates','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('ChampionshipDates')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Fechas de torneo amigos</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'championship-dates','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'championship-dates','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Trivias')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Trivias</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'trivias','action'=>'index'])?>">
              <span>Partidos</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'trivias','action'=>'index','trivia'])?>">
              <span>Trivias Programadas</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'trivias','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>


      <li <?= $ia('Winners')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Ganadores</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'winners','action'=>'index'])?>">
              <span>Ver</span>
            </a>
          </li>

        </ul>
      </li>

      <li <?= $ia('Teams')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Equipos</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'teams','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'teams','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('QuestionTemplates')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Preguntas preestablecidas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'question-templates','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'question-templates','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('GenericQuestions')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Preguntas genericas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'generic-questions','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'generic-questions','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?= $ia('Banners')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Banners</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'banners','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'banners','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>
      <li <?= $ia('PublicityCampaings')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Campañas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'publicity_campaigns','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'publicity_campaigns','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Posts')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">library_books</i>
          <span>Noticias</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'posts','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'posts','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Nodes')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">library_books</i>
          <span>Páginas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'nodes','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'nodes','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('HomeBanners')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Banners home</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'home_banners','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'home_banners','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Awards')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Premios</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'awards','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'awards','action'=>'add'])?>">
              <span>Agregar</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Contacts')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">reorder</i>
          <span>Contactos</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'contacts','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'contact_topics','action'=>'index'])?>">
              <span>Temas</span>
            </a>
          </li>
        </ul>
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


      <li <?= $ia('Loaders')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-warning">account_box</i>
          <span>Carga de contentido</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'loaders','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'loaders','action'=>'add'])?>">
              <span>Añadir usuario</span>
            </a>
          </li>
        </ul>
      </li>


      <li <?= $ia('Operators')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-warning">account_box</i>
          <span>Operadores</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'operators','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'operators','action'=>'add'])?>">
              <span>Añadir usuario</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Users')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-warning">account_box</i>
          <span>Usuarios</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'users','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'users','action'=>'add'])?>">
              <span>Añadir usuario</span>
            </a>
          </li>
        </ul>
      </li>

      <li <?= $ia('Payments')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-success">account_balance_wallet</i>
          <span>Pagos</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'payments','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>

        </ul>
      </li>

      <li <?= $ia('Lives')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-success">favorite</i>
          <span>Vidas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'lives','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>

        </ul>
      </li>

      <li <?= $ia('InfiniteLives')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons text-danger">favorite</i>
          <span>Vida infinitas</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'infinite-lives','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>

        </ul>
      </li>

      <li <?= $ia('Superusers')?>>
        <a href="javascript:;">
          <span class="menu-caret">
            <i class="material-icons">arrow_drop_down</i>
          </span>
          <i class="material-icons">account_circle</i>
          <span>Administradores</span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="<?= Router::url(['controller'=>'Superusers','action'=>'index'])?>">
              <span>Listado</span>
            </a>
          </li>
          <li>
            <a href="<?= Router::url(['controller'=>'Superusers','action'=>'add'])?>">
              <span>Añadir usuario</span>
            </a>
          </li>
        </ul>
      </li>


    </ul>
  </nav>
  <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
