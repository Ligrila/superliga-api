<div class="card">
  <div class="card-header">
    <?= __('Lives') ?>
  </div>
  <div class="card-block">

    <div class="lives index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id','Usuario') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('lives','Lives') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('payment_id','Pago') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('comments','Comentarios') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lives as $life): ?>
                <tr>
                        <td data-title="id"><?= h($life->id) ?></td>
                        <td data-title="user_id"><?= $life->has('user') ? $this->Html->link($life->user->email, ['controller' => 'Users', 'action' => 'view', $life->user->id]) : '' ?></td>
                        <td data-title="lives"><?= $this->Number->format($life->lives) ?></td>
                        <td data-title="payment_id"><?= $life->payment_id ? $this->Html->link($life->payment_id, ['controller' => 'Payments', 'action' => 'view', $life->payment_id]) : '' ?></td>
                        <td data-title="comments"><?= h($life->comments) ?></td>
                        <td data-title="created"><?= h($life->created) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $life->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $life->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $life->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $life->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
