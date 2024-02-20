<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $genericQuestion->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="genericQuestions view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">G</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($genericQuestion->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Trivia') ?></span></div>
            <div class="col p-l-2"><?= $genericQuestion->has('trivia') ? $this->Html->link($genericQuestion->trivia->id, ['controller' => 'Trivias', 'action' => 'view', $genericQuestion->trivia->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Team') ?></span></div>
            <div class="col p-l-2"><?= $genericQuestion->has('team') ? $this->Html->link($genericQuestion->team->name, ['controller' => 'Teams', 'action' => 'view', $genericQuestion->team->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Question') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->question) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Option 1') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->option_1) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Option 2') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->option_2) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Option 3') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->option_3) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Correct Option') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->correct_option) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($genericQuestion->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Points') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($genericQuestion->points) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($genericQuestion->modified) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Used') ?></span></div>
            <div class="col p-l-2"><?= $genericQuestion->used ? __('Yes') : __('No'); ?></div>
        </div>

</div>
