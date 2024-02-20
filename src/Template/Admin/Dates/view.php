<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $date->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="dates view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">D</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($date->name) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Name') ?></span></div>
            <div class="col p-l-2"><?= h($date->name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($date->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('From Date') ?></span></div>
            <div class="col p-l-2"><?= h($date->from_date) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('To Date') ?></span></div>
            <div class="col p-l-2"><?= h($date->to_date) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($date->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($date->modified) ?></div>
        </div>

</div>


<div class="trivias index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col">Dia</th>
                        <th scope="col">Local</th>
                        <th scope="col">Visitante</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Modificado</th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($date->trivias as $trivia): ?>
                <tr>
                        <td data-title="start_datetime">
                            <?= $this->Time->i18nFormat($trivia->start_datetime) ?>
                        </td>
                        <td data-title="local_team_id"><?= $trivia->local_team->name ?></td>
                        <td data-title="visit_team_id"><?= $trivia->visit_team->name ?></td>
                        <td data-title="estado"><?= $trivia->status ?></td>
                        <td data-title="created"><?= $this->Time->i18nFormat($trivia->created) ;?></td>
                        <td data-title="modified"><?= $this->Time->i18nFormat($trivia->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ganadores'), ['action' => 'winners', $trivia->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $trivia->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $trivia->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $trivia->id),'class'=>'btn btn-sm btn-danger']) ?>
                        <?= $this->Html->link(__('Preguntas'), ['controller'=>'generic-questions','action' => 'add', $trivia->id],['class'=>'btn btn-sm btn-info']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>