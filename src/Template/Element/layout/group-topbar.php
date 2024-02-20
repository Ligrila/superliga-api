<?php
  use Cake\Routing\Router;
  $request = $this->request;
  $ia = function($c) use ($request){ // isActive
    if($c==$request->params['_matchedRoute']){
      return ' active';
    }
    if($c==$request->params['controller']){
      return ' active';
    }
    return null;
  }
 ?>

 <nav class="header-secondary navbar  bg-faded shadow">
          <div class="navbar-collapse">
            <a class="navbar-heading hidden-md-down" href="javascript:;">
              <span>Deporte y diversión</span>
            </a>
            <ul class="nav navbar-nav pull-xs-right">
              <li class="nav-item<?= $ia('/group')?>">
                <a href="<?= Router::url('/group')?>" class="nav-link">Inicio</a>
              </li>

              <div class="nav-item nav-link dropdown<?= $ia('Registrations')?>">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Inscripciones</a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?= Router::url(['controller'=>'registrations','action'=>'index'])?>">Listado</a>
                  <a class="dropdown-item" href="<?= Router::url(['controller'=>'registrations','action'=>'index_deleted'])?>">Listado de bajas</a>
                  <a class="dropdown-item" href="<?= Router::url(['controller'=>'registrations','action'=>'select_event'])?>">Administrar inscripciones</a>
                </div>
              </div>
              <li class="nav-item<?= $ia('/groups/edit')?>">
                <a href="<?= Router::url(['controller'=>'groups','action'=>'edit'])?>" class="nav-link">Cambiar contraseña</a>
              </li>
              <li class="nav-item">
                <a href="<?= Router::url(['controller'=>'groups','action'=>'logout'])?>" class="nav-link">Salir</a>
              </li>

            </ul>
          </div>
        </nav>
