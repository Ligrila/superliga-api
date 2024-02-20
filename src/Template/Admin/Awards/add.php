<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Award') ?>
  </div>
<div class="card-block">
      <div class="awards form large-9 medium-8 columns content">
        <div class="alert alert-info">
          <p>Las imágenes tienen que ser en formato png con transparencia</p>
        </div>
        <?= $this->Form->create($award,['type'=>'file']) ?>
        <div class="form-body">
          <fieldset>
              <?php
                        echo $this->Form->control('picture',['type'=>'file','label'=>__('Imagen')]);
                        echo $this->Form->control('name',['label'=>__('Nombre')]);
                        echo $this->Form->control('description',['label'=>__('Descripción')]);
                        echo $this->Form->control('points',['label'=>__('Puntos')]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
