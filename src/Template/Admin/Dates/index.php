<div class="card">
  <div class="card-header">
    <?= __('Fechas') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="dates index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('from_date','Desde') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('to_date','Hasta') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates as $date): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($date->id) ?></td>
                        <td data-title="name"><?= h($date->name) ?></td>
                        <td data-title="from_date"><?= h($date->from_date) ?></td>
                        <td data-title="to_date"><?= h($date->to_date) ?></td>
                        <td data-title="created"><?= h($date->created) ?></td>
                        <td data-title="modified"><?= h($date->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ganadores'), ['action' => 'winners', $date->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $date->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $date->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $date->id),'class'=>'btn btn-sm btn-danger']) ?>
                        <?= $this->Html->link(__('Preguntas'), ['action' => 'view', $date->id],['class'=>'btn btn-sm btn-info']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
