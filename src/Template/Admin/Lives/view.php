<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $life->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="lives view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">L</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($life->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= h($life->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('User') ?></span></div>
            <div class="col p-l-2"><?= $life->has('user') ? $this->Html->link($life->user->email, ['controller' => 'Users', 'action' => 'view', $life->user->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Payment') ?></span></div>
            <div class="col p-l-2"><?= $life->payment_id ? $this->Html->link($life->payment_id, ['controller' => 'Payments', 'action' => 'view', $life->payment_id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Comments') ?></span></div>
            <div class="col p-l-2"><?= h($life->comments) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Lives') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($life->lives) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($life->created) ?></div>
        </div>

</div>
