<?= $this->Form->create(null,['autocomplete'=>"off"])?>
  <div class="text-center mb-3">
    <h2>SuperLiga</h2>
    <h4>CARGA DE CONTENIDO</h4>
    <div class="bg-dark pa-1">
      <div class="col-md-4  mx-auto"><?= $this->Html->image('/admin-assets/img/logo.png',['class'=>'mb-1 img-fluid'])?></div>
    </div>
    <h5>
      ¡Bienvenidos!
    </h5>
    <p class="text-muted">
      Ingresa tu nombre de usuario y contraseña y haz click en Ingresar.
    </p>
  </div>
  <fieldset class="form-group">
    <?= $this->Form->control('email',['label'=>__('Email'),'class'=>'form-control form-control-lg','autocomplete'=>'off','div'=>false]);?>
  </fieldset>
  <fieldset class="form-group">
    <?= $this->Form->control('password',['label'=>__('password'),'class'=>'form-control form-control-lg','autocomplete'=>'off','div'=>false]);?>
  </fieldset>
  <fieldset class="form-group">
    <?= $this->Recaptcha->display() ?>
  </fieldset>



  <button class="btn btn-primary btn-block btn-lg" type="submit">
    Ingresar
  </button>

<?= $this->Form->end()?>

<?php
//$forgotLink = $this->Html->link(__('¿Olvidaste tu contraseña?'),['action'=>'forgot']);
// $this->set('forgotLink',$forgotLink);
?>
