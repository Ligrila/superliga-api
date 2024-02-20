<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $contact->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="contacts view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">C</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($contact->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('User') ?></span></div>
            <div class="col p-l-2"><?= $contact->has('user') ? $this->Html->link($contact->user->email, ['controller' => 'Users', 'action' => 'view', $contact->user->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Contact Topic') ?></span></div>
            <div class="col p-l-2"><?= $contact->has('contact_topic') ? $this->Html->link($contact->contact_topic->name, ['controller' => 'ContactTopics', 'action' => 'view', $contact->contact_topic->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($contact->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($contact->created) ?></div>
        </div>

    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($contact->body)); ?>
    </div>
</div>
