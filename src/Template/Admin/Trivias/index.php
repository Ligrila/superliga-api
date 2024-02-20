<div class="card">
  <div class="card-header">
    <?= __('Trivias') ?>
  </div>
  <div class="card-block">
    <?php if($type=='normal' || empty($type) ):?>
        <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>
    <?php else: ?>
        <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add_trivia'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>
    <?php endif;?>

    <div class="trivias index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('local_team_id','Fecha') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('start_datetime','Día') ?></th>
                        <?php if($type!='trivia'):?>
                            <th scope="col"><?= $this->Paginator->sort('local_team_id','Local') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('visit_team_id','Visitante') ?></th>
                        <?php else:?>
                            <th scope="col"><?= $this->Paginator->sort('title1','Titulos') ?></th>
                        <?php endif;?>
                        <th scope="col"><?= $this->Paginator->sort('finished','Estado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trivias as $trivia): ?>
                <tr>
                        <td data-title="fecha"><?= $trivia->date->name ?></td>
                        <td data-title="start_datetime">
                            <?= $this->Time->i18nFormat($trivia->start_datetime) ?>
                        </td>
                        <?php if($type!='trivia'):?>
                            <td data-title="local_team_id"><?= $trivia->local_team->name ?></td>
                            <td data-title="visit_team_id"><?= $trivia->visit_team->name ?></td>
                        <?php else:?>
                            <td data-title="titulos"><?= $trivia->title1 ?> <?= $trivia->title2 ?></td>
                        <?php endif;?>
                        <td data-title="estado"><?= $trivia->status ?></td>
                        <td data-title="created"><?= $this->Time->i18nFormat($trivia->created) ;?></td>
                        <td data-title="modified"><?= $this->Time->i18nFormat($trivia->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ganadores'), ['action' => 'winners', $trivia->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Preguntas'), ['controller'=>'generic_questions','action' => 'index', $trivia->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $trivia->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $trivia->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $trivia->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this->element('Ligrila.pagination')?>
    </div>

  </div>
</div>
