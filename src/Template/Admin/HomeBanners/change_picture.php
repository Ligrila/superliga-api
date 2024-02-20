<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Cambiar imagen') ?>
  </div>
<div class="card-block">
      <div class="homeBanners form large-9 medium-8 columns content">
        <?= $this->Form->create($homeBanner,['type'=>'FILE']) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('id');
                        echo $this->Form->control('picture',['required'=>'required','type'=>'file','label'=>'Imagen']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
