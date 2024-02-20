<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Trivia') ?>
  </div>
  <div class="card-block">
      <div class="trivias form large-9 medium-8 columns content">
        <?= $this->Form->create($trivia) ?>
        <div class="form-body">
          <fieldset>
              <?php
                        echo $this->Form->control('enabled',['label'=>__('¿Habilitada?')]);
                        echo $this->Form->control('title1',['label'=>__('Titulo 1')]);
                        echo $this->Form->control('title2',['label'=>__('Titulo 2')]);
                        echo $this->Form->hidden('date_id',['value'=>0]);
                        echo $this->Form->hidden('local_team_id',['value'=>0]);
                        echo $this->Form->hidden('visit_team_id',['value'=>0]);
                        echo $this->Form->hidden('type',['value'=>'trivia']);

                        echo $this->Form->control('start_datetime',[
                            'label'=>__('Comienzo'),
                            'value' => $trivia->start_datetime ? $trivia->start_datetime->setTimezone($this->request->getSession()->read('user_timezone')) : null
                        ]);
                        // este field ayuda a la conversion con la bd
                        echo $this->Form->hidden('start_datetime[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);
                        echo $this->Form->control('points_multiplier',['label'=>__('Multiplicador de puntos (ej. 2 para doble)')]);
                        echo $this->Form->control('award',['label'=>__('Premio')]);


                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div></div>
