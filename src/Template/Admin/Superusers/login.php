<?= $this->Form->create(null, ['autocomplete' => "off"]) ?>
<div class="text-center mb-3">
  <h2 class="font-weight-bold mb-0">SuperLiga</h2>
  <h4 class="font-weight-light">ADMINISTRACION</h4>
  <div class="pa-1">
    <div class="col-md-4  mx-auto">
      <?= $this->Html->image('/admin-assets/img/logo.png', ['class' => 'mb-1 img-fluid']) ?>
    </div>
  </div>
  <h5>¡Bienvenidos!</h5>
  <p class="text-dark">
    Ingresa tu nombre de usuario y contraseña y haz click en Ingresar.
  </p>
</div>
<fieldset class="form-group">
  <?= $this->Form->control(
    'email',
    [
      'label' => [
        'class' => '',
        'for' => 'email',
        'text' =>  __('Email')
      ],
      'placeholder' => 'Email',
      'class' => 'form-control form-control-lg',
      'autocomplete' => 'on',
      'autofocus' => true,
      'div' => false
    ]
  ); ?>
</fieldset>
<fieldset class="form-group">
  <?= $this->Form->control(
    'password',
    [
      'label' => [
        'class' => '',
        'for' => 'password',
        'text' =>  __('Contraseña')
      ],
      'placeholder' => 'Contraseña',
      'class' => 'form-control form-control-lg',
      'autocomplete' => 'on',
      'div' => false
    ]
  ); ?>
</fieldset>
<fieldset class="form-group">
  <?= $this->Recaptcha->display() ?>
</fieldset>



<button class="btn btn-primary btn-block btn-lg" type="submit">
  Ingresar
</button>

<?= $this->Form->end() ?>

<?php
//$forgotLink = $this->Html->link(__('¿Olvidaste tu contraseña?'),['action'=>'forgot']);
// $this->set('forgotLink',$forgotLink);
?>