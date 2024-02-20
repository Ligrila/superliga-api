<div class="card">
  <div class="card-header">
    <?= __('Notificaciones push') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'send'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="pushNotifications index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('user_id','Usuario') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('token','Token') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('enabled','Habilitada') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pushNotifications as $pushNotification): ?>
                <tr>
                        <td data-title="user_id"><?= $pushNotification->has('user') ? $this->Html->link($pushNotification->user->email, ['controller' => 'Users', 'action' => 'view', $pushNotification->user->id]) : '' ?></td>
                        <td data-title="token"><?= h($pushNotification->token) ?></td>
                        <td data-title="enabled"><?= h($pushNotification->enabled) ?></td>
                        <td data-title="created"><?= h($pushNotification->created) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
