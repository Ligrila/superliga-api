<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $questionTemplate->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $questionTemplate->id)]
        )
    ?>
    </nav>
<div class="card">
  <div class="card-header">
    <?= __('Editar pregunta preestablecida') ?>
  </div>
<div class="card-block">
      <div class="questionTemplates form large-9 medium-8 columns content">
        <?= $this->Form->create($questionTemplate) ?>
        <div class="form-body">
          <fieldset>
              <p class="alert alert-info">
                Variable disponible <strong>{0}</strong> para nombre del club. <strong>Corner para {0}</strong>
              </p>
              <?php

                        echo $this->Form->control('question',['label'=>'Pregunta']);
                        echo $this->Form->control('short_question',['label'=>'Nombre corto']);
                        echo $this->Form->control('option_1',['label'=>'Opcion 1']);
                        echo $this->Form->control('option_2',['label'=>'Opcion 2']);
                        echo $this->Form->control('option_3',['label'=>'Opcion 3']);
                        echo $this->Form->control('points',['label'=>'Puntos']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

