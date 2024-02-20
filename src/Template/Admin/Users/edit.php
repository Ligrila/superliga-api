<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $user->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $user->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar User') ?>
  </div>
<div class="card-block">
      <div class="users form large-9 medium-8 columns content">
        <?= $this->Form->create($user) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('email',[]);
                        echo $this->Form->control('first_name',['label'=>__('Nombre')]);
                        echo $this->Form->control('last_name',['label'=>__('Apellido')]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
