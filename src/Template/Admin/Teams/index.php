<div class="card">
  <div class="card-header">
    <?= __('Teams') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="teams index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('picture','Imagen') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($team->id) ?></td>
                        <td data-title="nombre"><?= h($team->name) ?></td>
                        <td data-title="imagen">
                                <div class="text-xs-center">
                                    <div><?= $this->Html->image($team->avatar,['class'=>'avatar avatar-sm'])?></div>
                                    <?= $this->Html->link('Cambiar',['action'=>'change_picture',$team->id],['class'=>'btn btn-sm btn-primary','data-target'=>'#','data-toggle'=>'modal']) ?>
                                </div>
                        </td>
                        <td data-title="created"><?= h($team->created) ?></td>
                        <td data-title="modified"><?= h($team->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $team->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $team->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $team->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $team->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
