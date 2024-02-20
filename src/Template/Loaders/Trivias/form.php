<div class="card-block">
      <div class="trivias form large-9 medium-8 columns content">
        <?= $this->Form->create($trivia) ?>
        <div class="form-body">
          <fieldset>
              <?php
                        echo $this->Form->control('enabled',['label'=>__('¿Habilitada?')]);
                        echo $this->Form->control('date_id',['label'=>__('Fecha')]);
                        echo $this->Form->control('local_team_id',['label'=>__('Club local')]);
                        echo $this->Form->control('visit_team_id',['label'=>__('Club visitante')]);
                        echo $this->Form->control('start_datetime',[
                            'label'=>__('Comienzo'),
                            'value' => $trivia->start_datetime ? $trivia->start_datetime->setTimezone($this->request->getSession()->read('user_timezone')) : null
                        ]);
                        // este field ayuda a la conversion con la bd
                        echo $this->Form->hidden('start_datetime[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);
                        echo $this->Form->control('points_multiplier',['label'=>__('Multiplicador de puntos (ej. 2 para doble)')]);
                        echo $this->Form->control('award',['label'=>__('Premio')]);
                        echo $this->Form->control('title1',['label'=>__('Titulo 1')]);
                        echo $this->Form->control('title2',['label'=>__('Titulo 2')]);


                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
