<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $publicityCampaign->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $publicityCampaign->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar Campaña publicitaria') ?>
  </div>
<div class="card-block">
      <div class="publicityCampaigns form large-9 medium-8 columns content">
        <?= $this->Form->create($publicityCampaign) ?>
        <div class="form-body">
          <fieldset>
              <?php
                echo $this->Form->control('enabled',['label'=>'¿Habilitada?','default'=>1]);
                echo $this->Form->control('model',['label'=>'Modelo','type'=>'select','options'=>$publicityCampaign->modelTypes]);
                echo $this->Form->control('model_value',['label'=>'Valor del modelo','placeholder'=>'Valor entero corresponde a cantidad de preguntas o trivias']);
                echo $this->Form->control('trivia_id', ['options' => $trivias, 'empty' => true]);
                echo $this->Form->control('banner_id', ['options' => $banners]);
                echo $this->Form->control('model_used_value',['label'=>'Valores usados']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
