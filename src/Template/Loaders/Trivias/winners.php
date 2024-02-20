
<div class="card">
  <div class="card-header">
    <h3><?= __('Ganadores Trivia') ?></h3>
    <h5><?= $trivia->local_team->name?> vs <?= $trivia->visit_team->name?></h5>
    <?= $this->Html->link(__('Refrescar cache de estadísticas'),['action'=>'refresh-cache-table'],['class'=>'btn btn-sm btn-danger','confirm'=>'Estas seguro?'])?>
  </div>
  <div class="card-body">
  <div class="trivias index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col">Posicion</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">AVG</th>
                        <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($triviaPoints as $triviaPoint): ?>
                <tr>
                        <td data-title="posicion"><?= $triviaPoint->position ?></td>  
                        <td data-title="email"><?= $triviaPoint->user->email ?></td>
     
                        <td data-title="nombre"><?= $triviaPoint->user->first_name . ' ' . $triviaPoint->user->last_name ?></td>
                        <td data-title="visit_team_id"><?= $triviaPoint->points ?></td>
                        <td data-title="visit_team_id"><?= $triviaPoint->avg ?></td>
                        <td data-title="acciones">
                        <?= $this->Html->link(__('Notificacion push'), ['controller'=>'PushNotifications','action' => 'for_user', $triviaPoint->user->id,'?'=>['return'=>\Cake\Routing\Router::url(null,true)]],['class'=>'btn btn-sm btn-info']) ?>
                        <?= $this->Html->link(__('Ver respuestas'), ['controller'=>'answers','action' => 'index', $triviaPoint->user->id,$triviaPoint->trivia_id,'?'=>['return'=>\Cake\Routing\Router::url(null,true)]],['class'=>'btn btn-sm btn-primary']) ?>
                        </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
  </div>
</div>
