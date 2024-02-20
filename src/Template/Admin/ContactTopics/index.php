<div class="card">
  <div class="card-header">
    <?= __('Contact Topics') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="contactTopics index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name','Name') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactTopics as $contactTopic): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($contactTopic->id) ?></td>
                        <td data-title="name"><?= h($contactTopic->name) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $contactTopic->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $contactTopic->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $contactTopic->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $contactTopic->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
