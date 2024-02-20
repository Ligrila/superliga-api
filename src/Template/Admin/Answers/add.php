<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Answer') ?>
  </div>
<div class="card-block">
      <div class="answers form large-9 medium-8 columns content">
        <?= $this->Form->create($answer) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('user_id', ['options' => $users]);
                        echo $this->Form->control('question_id', ['options' => $questions]);
                        echo $this->Form->control('selected_option',[]);
                        echo $this->Form->control('lives',[]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
