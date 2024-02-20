<div class="card">
  <div class="card-header">
    <?= __('Contacts') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="contacts index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id','User_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('contact_topic_id','Contact_topic_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($contact->id) ?></td>
                        <td data-title="user_id"><?= $contact->has('user') ? $this->Html->link($contact->user->email, ['controller' => 'Users', 'action' => 'view', $contact->user->id]) : '' ?></td>
                        <td data-title="contact_topic_id"><?= $contact->has('contact_topic') ? $this->Html->link($contact->contact_topic->name, ['controller' => 'ContactTopics', 'action' => 'view', $contact->contact_topic->id]) : '' ?></td>
                        <td data-title="created"><?= h($contact->created) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $contact->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $contact->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $contact->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $contact->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
