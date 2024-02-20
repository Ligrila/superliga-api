<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $payment->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="payments view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">P</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($payment->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= h($payment->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Method') ?></span></div>
            <div class="col p-l-2"><?= h($payment->method) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('User') ?></span></div>
            <div class="col p-l-2"><?= $payment->has('user') ? $this->Html->link($payment->user->email, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Amount') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($payment->amount) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Payment Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($payment->payment_id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($payment->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($payment->modified) ?></div>
        </div>

    <div class="related">
        <h4><?= __('Vidas relacionadas') ?></h4>
        <?php if (!empty($payment->lives)): ?>
        <table cellpadding="0" cellspacing="0" class="table">
            <tr class="column-equal m-b-2">
                <th scope="col"><?= __('Id') ?></span></th>
                <th scope="col"><?= __('Usuario') ?></span></th>
                <th scope="col"><?= __('Vidas') ?></span></th>

                <th scope="col"><?= __('Comentarios') ?></span></th>
                <th scope="col"><?= __('Creado') ?></span></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></span></th>
            </tr>
            <?php foreach ($payment->lives as $lives): ?>
            <tr class="column-equal m-b-2">
                <td class="col p-l-2"><?= h($lives->id) ?></td>
                <td class="col p-l-2"><?= h($lives->user_id) ?></td>
                <td class="col p-l-2"><?= h($lives->lives) ?></td>

                <td class="col p-l-2"><?= h($lives->comments) ?></td>
                <td class="col p-l-2"><?= h($lives->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Lives', 'action' => 'view', $lives->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Lives', 'action' => 'edit', $lives->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'Lives', 'action' => 'delete', $lives->id], ['confirm' => __('Estas seguro de borrar # {0}?', $lives->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Pedidos relacionados') ?></h4>
        <?php if (!empty($payment->orders)): ?>
        <table cellpadding="0" cellspacing="0" class="table">
            <tr class="column-equal m-b-2">
                <th scope="col"><?= __('Id') ?></span></th>
                <th scope="col"><?= __('Usuario') ?></span></th>
                <th scope="col"><?= __('Comentarios') ?></span></th>

                <th scope="col"><?= __('Puntos') ?></span></th>
                <th scope="col"><?= __('Model') ?></span></th>
                <th scope="col"><?= __('FK') ?></span></th>
                <th scope="col"><?= __('Creado') ?></span></th>
                <th scope="col"><?= __('Modificado') ?></span></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></span></th>
            </tr>
            <?php foreach ($payment->orders as $orders): ?>
            <tr class="column-equal m-b-2">
                <td class="col p-l-2"><?= h($orders->id) ?></td>
                <td class="col p-l-2"><?= h($orders->user_id) ?></td>
                <td class="col p-l-2"><?= h($orders->comments) ?></td>

                <td class="col p-l-2"><?= h($orders->points) ?></td>
                <td class="col p-l-2"><?= h($orders->model) ?></td>
                <td class="col p-l-2"><?= h($orders->foreign_key) ?></td>
                <td class="col p-l-2"><?= h($orders->created) ?></td>
                <td class="col p-l-2"><?= h($orders->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Orders', 'action' => 'view', $orders->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Orders', 'action' => 'edit', $orders->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'Orders', 'action' => 'delete', $orders->id], ['confirm' => __('Estas seguro de borrar # {0}?', $orders->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
