<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Team') ?>
  </div>
<div class="card-block">
      <div class="teams form large-9 medium-8 columns content">
        <?= $this->Form->create($team,['type'=>'FILE']) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('name',['label'=>__('Nombre')]);
                        echo $this->Form->control('picture',['label'=>__('Imagen'),'type'=>'file']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
