<?php
$toolbarIgnoreControllers = array('Pages');
$toolbarIgnoreAction = array('login','register');
$ignore = in_array($this->request->getParam('controller'),$toolbarIgnoreControllers) || in_array($this->request->getParam('action'),$toolbarIgnoreAction);
?>
<?php if(!$ignore && !empty($this->request->getSession()->read('Auth.User'))):?>
  <div class="toolbar user-toolbar">
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark">
    <?php if(empty($toolbarTitle)):?>
      <a class="navbar-brand" href="<?= \Cake\Routing\Router::url('/users/dashboard')?>">
        Bienvenido <strong><?=$this->request->getSession()->read('Auth.User.first_name')?></strong>
      </a>
    <?php else:?>
        <div class="navbar-brand"><?= $toolbarTitle?></div>
    <?php endif;?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#toolbar-menu" aria-controls="toolbar-menu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <div id="toolbar-menu" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <?= $this->Html->link(__('Mi perfil'),['controller'=>'users','action'=>'my_profile'],['class'=>'nav-link'])?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(__('Mis movimientos'),['controller'=>'orders','action'=>'index'],['class'=>'nav-link'])?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(__('Comprar'),['controller'=>'orders','action'=>'buy'],['class'=>'nav-link'])?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(__('Vender'),['controller'=>'orders','action'=>'sell'],['class'=>'nav-link'])?>
              </li>
            </ul>
          </div>
    </nav>
    </div>
  </div>

<?php endif;?>
