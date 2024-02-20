<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $date->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $date->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar fecha torneo de amigos') ?>
  </div>
<div class="card-block">
      <div class="dates form large-9 medium-8 columns content">
      <?= $this->Form->create($championshipDate) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('name',['label'=>'Nombre']);
                        echo $this->Form->control('from_date',['label'=>'Desde']);
                        echo $this->Form->control('to_date',['label'=>'Hasta']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
