<header>
  <div class="container d-block d-md-none text-center">
    <?= $this->Html->link($this->Html->image('logo.png'),'/',['class'=>'nav-link','escape'=>false])?>
  </div>
  <div class="container">
  <nav class="navbar navbar-expand-md navbar-dark">
        <div id="menu" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            </li>
            <li class="nav-item">
              <?= $this->Html->link(__('Descarga la app'),['controller'=>'get','action'=>'index'],['class'=>'nav-link'])?>
            </li>

            <li class="nav-item">
              <?= $this->Html->link($this->Html->image('logo.png'),'/',['class'=>'nav-link','escape'=>false])?>
            </li>
            <li class="nav-item">
              <?= $this->Html->link(__('Reglas del juego'),['controller'=>'pages','action'=>'display','reglas-del-juego'],['class'=>'nav-link'])?>
            </li>
            <?php /*
            <li class="nav-item">
              <?= $this->Html->link(__('Premios'),['controller'=>'pages','action'=>'display','premios'],['class'=>'nav-link'])?>
            </li>
            <li class="nav-item">
              <?= $this->Html->link(__('Chat'),['controller'=>'pages','action'=>'display','chat'],['class'=>'nav-link'])?>
            </li>
            <li class="nav-item">
              <?= $this->Html->link(__('Contacto'),['controller'=>'pages','action'=>'display','contacto'],['class'=>'nav-link'])?>
            </li>
            */ ?>

          </ul>
        </div>
  </nav>
  </div>
</header>
