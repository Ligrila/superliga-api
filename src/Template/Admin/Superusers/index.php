<div class="card">
  <div class="card-header">
    <?= __('Superusers') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="superusers index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email','Email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('first_name','Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_name','Apellido') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($superusers as $superuser): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($superuser->id) ?></td>
                        <td data-title="email"><?= h($superuser->email) ?></td>
                        <td data-title="first_name"><?= h($superuser->first_name) ?></td>
                        <td data-title="last_name"><?= h($superuser->last_name) ?></td>
                        <td data-title="created"><?= h($superuser->created) ?></td>
                        <td data-title="modified"><?= h($superuser->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $superuser->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $superuser->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $superuser->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $superuser->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
