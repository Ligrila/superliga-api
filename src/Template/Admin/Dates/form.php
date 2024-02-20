<div class="card-block">
      <div class="trivias form large-9 medium-8 columns content">
        <?= $this->Form->create($dates) ?>
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
