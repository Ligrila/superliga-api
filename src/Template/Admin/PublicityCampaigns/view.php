<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $publicityCampaign->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="publicityCampaigns view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">P</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($publicityCampaign->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Model') ?></span></div>
            <div class="col p-l-2"><?= h($publicityCampaign->model) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Trivia') ?></span></div>
            <div class="col p-l-2"><?= $publicityCampaign->has('trivia') ? $this->Html->link($publicityCampaign->trivia->fullTitle, ['controller' => 'Trivias', 'action' => 'view', $publicityCampaign->trivia->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Banner') ?></span></div>
            <div class="col p-l-2"><?= $publicityCampaign->has('banner') ? $this->Html->link($publicityCampaign->banner->name, ['controller' => 'Banners', 'action' => 'view', $publicityCampaign->banner->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($publicityCampaign->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Model Value') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($publicityCampaign->model_value) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($publicityCampaign->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($publicityCampaign->modified) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Enabled') ?></span></div>
            <div class="col p-l-2"><?= $publicityCampaign->enabled ? __('Yes') : __('No'); ?></div>
        </div>

    <div class="row">
        <h4><?= __('Model Used Value') ?></h4>
        <?= $this->Text->autoParagraph(h($publicityCampaign->model_used_value)); ?>
    </div>
</div>
