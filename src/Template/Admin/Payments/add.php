<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Payment') ?>
  </div>
<div class="card-block">
      <div class="payments form large-9 medium-8 columns content">
        <?= $this->Form->create($payment) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('method',[]);
                        echo $this->Form->control('user_id', ['options' => $users]);
                        echo $this->Form->control('amount',[]);
                        echo $this->Form->control('payment_id',[]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
