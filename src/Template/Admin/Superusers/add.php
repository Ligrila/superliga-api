<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Superuser') ?>
  </div>
<div class="card-block">
      <div class="superusers form large-9 medium-8 columns content">
        <?= $this->Form->create($superuser) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('email',['label'=>__('Email'),'autocomplete'=>'off']);
                        echo $this->Form->control('password',['label'=>__('Contraseña'),'autocomplete'=>'off']);
                        echo $this->Form->control('first_name',['label'=>__('Nombre'),'autocomplete'=>'off']);
                        echo $this->Form->control('last_name',['label'=>__('Apellido'),'autocomplete'=>'off']);
                  ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
