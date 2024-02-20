<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $infiniteLife->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="infiniteLives view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">I</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($infiniteLife->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('User') ?></span></div>
            <div class="col p-l-2"><?= $infiniteLife->has('user') ? $this->Html->link($infiniteLife->user->email, ['controller' => 'Users', 'action' => 'view', $infiniteLife->user->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Payment') ?></span></div>
            <div class="col p-l-2"><?= $infiniteLife->has('payment') ? $this->Html->link($infiniteLife->payment->id, ['controller' => 'Payments', 'action' => 'view', $infiniteLife->payment->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($infiniteLife->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Until') ?></span></div>
            <div class="col p-l-2"><?= h($infiniteLife->until) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($infiniteLife->created) ?></div>
        </div>

</div>
