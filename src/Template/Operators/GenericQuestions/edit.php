<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $genericQuestion->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $genericQuestion->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar Generic Question') ?>
  </div>
<div class="card-block">
      <div class="genericQuestions form large-9 medium-8 columns content">
        <?= $this->Form->create($genericQuestion) ?>
        <div class="form-body">
          <fieldset>
              <?php
                        echo $this->Form->control('trivia_id', ['options' => $trivias,'label'=>'Trivia']);
                        echo $this->Form->control('team_id', ['options' => $teams,'label'=>'Club']);
                        echo $this->Form->control('question',['label'=>'Pregunta']);
                        echo $this->Form->control('option_1',['label'=>'Opcion 1']);
                        echo $this->Form->control('option_2',['label'=>'Opcion 2']);
                        echo $this->Form->control('option_3',['label'=>'Opcion 3']);
                        echo $this->Form->control('points',['label'=>'Puntos']);

                        echo $this->Form->control('correct_option',['label'=>'Opcion correcta','options'=>$options]);

                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
