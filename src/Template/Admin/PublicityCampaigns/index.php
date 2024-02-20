<div class="card">
  <div class="card-header">
    <?= __('Campañas publicitarias') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="publicityCampaigns index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('model','Modelo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('trivia_id','Trivia') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('banner_id','Banner') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('model_value','Valor') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('enabled','Habilitado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publicityCampaigns as $publicityCampaign): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($publicityCampaign->id) ?></td>
                        <td data-title="model"><?= h($publicityCampaign->modelTypes[$publicityCampaign->model]) ?></td>
                        <td data-title="trivia_id"><?= $publicityCampaign->has('trivia') ? $this->Html->link($publicityCampaign->trivia->fullTitle, ['controller' => 'Trivias', 'action' => 'view', $publicityCampaign->trivia->id]) : '' ?></td>
                        <td data-title="banner_id"><?= $publicityCampaign->has('banner') ? $this->Html->link($publicityCampaign->banner->name, ['controller' => 'Banners', 'action' => 'view', $publicityCampaign->banner->id]) : '' ?></td>
                        <td data-title="model_value"><?= $this->Number->format($publicityCampaign->model_value) ?></td>
                        <td data-title="enabled"><?= h($publicityCampaign->enabled) ?></td>
                        <td data-title="created"><?= h($publicityCampaign->created) ?></td>
                        <td data-title="modified"><?= h($publicityCampaign->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $publicityCampaign->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $publicityCampaign->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $publicityCampaign->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $publicityCampaign->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
