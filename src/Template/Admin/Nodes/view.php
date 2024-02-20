<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $node->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="nodes view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">N</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($node->title) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Slug') ?></span></div>
            <div class="col p-l-2"><?= h($node->slug) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Title') ?></span></div>
            <div class="col p-l-2"><?= h($node->title) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($node->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($node->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($node->modified) ?></div>
        </div>

    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($node->body)); ?>
    </div>
</div>
