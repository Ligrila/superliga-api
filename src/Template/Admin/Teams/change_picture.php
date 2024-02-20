<div class="card">
  <div class="card-header">
    <?= __('Cambiar imagen') ?>
  </div>
<div class="card-block">
      <div class="teams form large-9 medium-8 columns content">
        <?= $this->Form->create($team,['type'=>'file']) ?>
        <div class="form-body">
          <fieldset>
              <?php
                        echo $this->Form->control('picture',['type'=>'file','label'=>__('Imagen')]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
