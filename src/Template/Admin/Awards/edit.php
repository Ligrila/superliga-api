<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $award->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $award->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar premio') ?>
  </div>

<div class="card-block">
      <div class="awards form large-9 medium-8 columns content">
        <?= $this->Form->create($award,['type'=>'file']) ?>
        <div class="form-body">
        <fieldset>

              <?php
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
