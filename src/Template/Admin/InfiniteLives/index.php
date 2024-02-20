<div class="card">
  <div class="card-header">
    <?= __('Vidas infinitas') ?>
  </div>
  <div class="card-block">

    <div class="infiniteLives index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id','Usuario') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('payment_id','Pago') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('until','Hasta') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($infiniteLives as $infiniteLife): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($infiniteLife->id) ?></td>
                        <td data-title="user_id"><?= $infiniteLife->has('user') ? $this->Html->link($infiniteLife->user->email, ['controller' => 'Users', 'action' => 'view', $infiniteLife->user->id]) : '' ?></td>
                        <td data-title="payment_id"><?= $infiniteLife->has('payment') ? $this->Html->link($infiniteLife->payment->id, ['controller' => 'Payments', 'action' => 'view', $infiniteLife->payment->id]) : '' ?></td>
                        <td data-title="until"><?= h($infiniteLife->until) ?></td>
                        <td data-title="created"><?= $this->Time->i18nFormat($infiniteLife->created) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $infiniteLife->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $infiniteLife->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $infiniteLife->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
