<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $user->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="users view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">U</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($user->email) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= h($user->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Email') ?></span></div>
            <div class="col p-l-2"><?= h($user->email) ?></div>
        </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('First Name') ?></span></div>
            <div class="col p-l-2"><?= h($user->first_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Name') ?></span></div>
            <div class="col p-l-2"><?= h($user->last_name) ?></div>
        </div>



        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Picture Dir') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($user->picture_dir) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($user->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($user->modified) ?></div>
        </div>


  
</div>


<?php if(!empty($allInfiniteLives)):?>
        <h2>Vidas infinitas</h2>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Pago</th>
            <th>Hasta</th>
            <th>Creado</th>
            <th></th>
        </tr>
        <?php foreach($allInfiniteLives as $infiniteLife):?>
        <tr>
            <td data-title="id"><?= $this->Number->format($infiniteLife->id) ?></td>

            <td data-title="payment_id"><?= $infiniteLife->payment_id ? $this->Html->link($infiniteLife->payment_id, ['controller' => 'Payments', 'action' => 'view', $infiniteLife->payment_id]) : '' ?></td>
            <td data-title="until"><?= h($infiniteLife->until) ?></td>
            <td data-title="created"><?= $this->Time->i18nFormat($infiniteLife->created) ?></td>
            <td class="actions" data-title="<?= __('Acciones')?>">
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $infiniteLife->id],['class'=>'btn btn-sm btn-default']) ?>
            <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $infiniteLife->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $infiniteLife->id),'class'=>'btn btn-sm btn-danger']) ?>
            </td>
            </tr>
        <?php endforeach;?>
    </table>
<?php endif;?>