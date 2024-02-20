<div class="card">
  <div class="card-header">
    <?= __('Payments') ?>
  </div>
  <div class="card-block">

    <div class="payments index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('method','Forma de pago') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id','Usuario') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('amount','Monto') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('payment_id','ID ML') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                <tr>
                        <td data-title="method"><?= h($payment->method) ?></td>
                        <td data-title="user_id"><?= $payment->has('user') ? $this->Html->link($payment->user->email, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
                        <td data-title="amount"><?= $this->Number->format($payment->amount) ?></td>
                        <td data-title="payment_id"><?= $payment->payment_id ?></td>
                        <td data-title="created"><?= $this->Time->i18nFormat($payment->created) ?></td>
                        <td data-title="modified"><?= $this->Time->i18nFormat($payment->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $payment->id],['class'=>'btn btn-sm btn-primary']) ?>
 
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
