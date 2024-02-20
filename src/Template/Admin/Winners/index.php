<div class="card">
  <div class="card-header">
    <h3><?= __('Ganadores por día') ?></h3>
  </div>
  <div class="card-body">
  <?= $this->Form->create($trivia)?>
  <?= $this->Form->control('start_datetime',['type'=>'date','label'=>'Desde'])?>
  <?= $this->Form->control('end_datetime',['type'=>'date','label'=>'Hasta'])?>
  <?php // $this->Form->hidden('start_datetime[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);?>
  <?php // $this->Form->hidden('end_datetime[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);?>

  <?= $this->Form->submit('Ver ganadores')?>
  <?= $this->Form->end()?>
  <?php if(!empty($triviaPoints)):?>
  <div class="trivias index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($triviaPoints as $triviaPoint): ?>
                <tr>
                        <td data-title="email"><?= $triviaPoint->user->email ?></td>

                        <td data-title="nombre"><?= $triviaPoint->user->first_name . ' ' . $triviaPoint->user->last_name ?></td>
                        <td data-title="visit_team_id"><?= $triviaPoint->p ?></td>
                        <td data-title="acciones">
                            <?php // $this->Html->link(__('Resumen puntos'), ['controller'=>'winners','action' => 'brief', $triviaPoint->user->id,'?'=>['trivia_id'=>$trivias_ids,'return'=>\Cake\Routing\Router::url(null,true)]],['class'=>'btn btn-sm btn-info']) ?>
                            <?= $this->Html->link(__('Notificacion push'), ['controller'=>'PushNotifications','action' => 'for_user', $triviaPoint->user->id,'?'=>['return'=>\Cake\Routing\Router::url(null,true)]],['class'=>'btn btn-sm btn-info']) ?>
                        </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif;?>
  </div>
</div>
