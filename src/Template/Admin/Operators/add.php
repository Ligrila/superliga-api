<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Operator') ?>
  </div>
<div class="card-block">
      <div class="operators form large-9 medium-8 columns content">
        <?= $this->Form->create($operator) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('email',[]);
                        echo $this->Form->control('role',[]);
                        echo $this->Form->control('password',[]);
                        echo $this->Form->control('first_name',[]);
                        echo $this->Form->control('last_name',[]);
                        echo $this->Form->control('hash',[]);
                        echo $this->Form->control('enabled',[]);
                        echo $this->Form->control('document',[]);
                        echo $this->Form->control('address',[]);
                        echo $this->Form->control('postal_code',[]);
                        echo $this->Form->control('phone',[]);
                        echo $this->Form->control('mobile_phone',[]);
                        echo $this->Form->control('fax',[]);
                        echo $this->Form->control('dir',[]);
                        echo $this->Form->control('image',[]);
                        echo $this->Form->control('about',[]);
                        echo $this->Form->control('last_login',[]);
                        echo $this->Form->control('login_count',[]);
                        echo $this->Form->control('birth_date', ['empty' => true,'type'=>'text','data-provide'=>'datepicker','data-date-language'=>'es']);
                        echo $this->Form->control('city',[]);
                        echo $this->Form->control('province',[]);
                        echo $this->Form->control('nationality',[]);
                        echo $this->Form->control('deleted',[]);
                        echo $this->Form->control('receive_emails',[]);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
