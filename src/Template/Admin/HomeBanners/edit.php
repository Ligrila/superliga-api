<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $homeBanner->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $homeBanner->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar Banner de la Home') ?>
  </div>
<div class="card-block">
      <div class="homeBanners form large-9 medium-8 columns content">
        <?= $this->Form->create($homeBanner) ?>
        <div class="form-body">
        <fieldset>
              <?php
            echo $this->Form->control('id');
            echo $this->Form->control('name',['label'=>'Nombre']);
            echo $this->Form->control('start_date', ['empty' => true,'label'=>'Desde']);
            echo $this->Form->control('end_date', ['empty' => true,'label'=>'Hasta']);
            echo $this->Form->control('action',['label'=>'Accion','empty'=>'Seleccionar...']);
            echo $this->Form->control('action_target',['label'=>'Destino de la acción','empty'=>'Seleccionar...']);
            echo $this->Form->control('action_target_url',['label'=>'Url de la acción(url)','placeholder'=>'Ej: http://www.google.com']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
