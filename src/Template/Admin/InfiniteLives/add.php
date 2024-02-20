<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar vida infinita a {0} {1} / {2}',$user->first_name,$user->last_name,$user->email) ?>
  </div>
<div class="card-block">
      <div class="infiniteLives form large-9 medium-8 columns content">
        <?= $this->Form->create($infiniteLife) ?>
        <div class="form-body">
        <fieldset>
              <?php

                        echo $this->Form->control('until',['label'=>'Hasta']);
                        echo $this->Form->hidden('until[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);

                    ?>
                      <a class="btn btn-primary mb-3" data-toggle="collapse" href="#avanced-fields" role="button" aria-expanded="false" aria-controls="avanced-fields">
                        Avanzado
                        </a>
                        <div id="avanced-fields"  class="collapse">
                        <div class="card card-body">
                            <?php
                                echo $this->Form->control('user_id', ['type'=>'text']);
                                echo $this->Form->control('payment_id', ['label'=>'Pago','type'=>'text']);
                            ?>
                        </div>
                    </div>
                    <div class="mb-4" />
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
