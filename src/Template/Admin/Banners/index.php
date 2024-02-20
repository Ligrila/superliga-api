<div class="card">
  <div class="card-header">
    <?= __('Home Banners') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="banners index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('start_date','Desde') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('end_date','Hasta') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($banners as $banner): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($banner->id) ?></td>
                        <td data-title="name"><?= h($banner->name) ?></td>
                        <td data-title="start_date"><?= h($banner->start_date) ?></td>
                        <td data-title="end_date"><?= h($banner->end_date) ?></td>
                        <td data-title="created"><?= h($banner->created) ?></td>
                        <td data-title="modified"><?= h($banner->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver imagen'), $banner->banner,['target'=>'_BLANK','class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Cambiar imagen'), ['action' => 'change_picture', $banner->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $banner->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $banner->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $banner->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
