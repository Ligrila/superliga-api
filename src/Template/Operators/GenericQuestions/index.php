<div class="card">
  <div class="card-header">
    <?= __('Generic Questions') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add',$trivia_id],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="genericQuestions index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('team_id','Club') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('question','Pregunta') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('used','Usada') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($genericQuestions as $genericQuestion): ?>
                <tr>
                        <td data-title="team_id"><?= $genericQuestion->has('team') ? $this->Html->link($genericQuestion->team->name, ['controller' => 'Teams', 'action' => 'view', $genericQuestion->team->id]) : '' ?></td>
                        <td data-title="question"><?= h($genericQuestion->question) ?></td>
                        <td data-title="used"><?= h($genericQuestion->used) ?></td>
                        <td data-title="created"><?= h($genericQuestion->created) ?></td>
                        <td data-title="modified"><?= h($genericQuestion->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $genericQuestion->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $genericQuestion->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $genericQuestion->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $genericQuestion->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
