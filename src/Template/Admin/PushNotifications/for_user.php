
<div class="card">
  <div class="card-header">
    <?= __('Enviar notificación') ?>
  </div>
<div class="card-block">
      <div class="users form large-9 medium-8 columns content">
        <?= $this->Form->create() ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('title',['label'=>__('Título')]);
                        echo $this->Form->control('body',['label'=>__('Mensaje'),'type'=>'textarea']);
                        echo $this->Form->control('expire',['label'=>__('Valida hasta'),'type'=>'datetime','empty'=>true]);
                        echo $this->Form->hidden('expire[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);
                        echo $this->Form->control('action',['label'=>'Accion','empty'=>'Seleccionar...']);
                        echo $this->Form->control('action_target',['label'=>'Destino en la app','empty'=>'Seleccionar...']);
                        echo $this->Form->control('action_target_url',['label'=>'Url de la acción(url)','placeholder'=>'Ej: http://www.google.com']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
