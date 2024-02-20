<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $contactTopic->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="contactTopics view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">C</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($contactTopic->name) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Name') ?></span></div>
            <div class="col p-l-2"><?= h($contactTopic->name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($contactTopic->id) ?></div>
        </div>

    <div class="related">
        <h4><?= __('Related Contacts') ?></h4>
        <?php if (!empty($contactTopic->contacts)): ?>
        <table cellpadding="0" cellspacing="0">
            <div class="column-equal m-b-2">
                <th scope="col"><?= __('Id') ?></span></div>
                <th scope="col"><?= __('User Id') ?></span></div>
                <th scope="col"><?= __('Contact Topic Id') ?></span></div>
                <th scope="col"><?= __('Body') ?></span></div>
                <th scope="col"><?= __('Created') ?></span></div>
                <th scope="col" class="actions"><?= __('Actions') ?></span></div>
            </div>
            <?php foreach ($contactTopic->contacts as $contacts): ?>
            <div class="column-equal m-b-2">
                <div class="col p-l-2"><?= h($contacts->id) ?></div>
                <div class="col p-l-2"><?= h($contacts->user_id) ?></div>
                <div class="col p-l-2"><?= h($contacts->contact_topic_id) ?></div>
                <div class="col p-l-2"><?= h($contacts->body) ?></div>
                <div class="col p-l-2"><?= h($contacts->created) ?></div>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
