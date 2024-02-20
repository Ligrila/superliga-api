<div class="card">
  <div class="card-header">
    <?= __('Nodes') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="nodes index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('slug','Slug') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('title','Titulo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nodes as $node): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($node->id) ?></td>
                        <td data-title="slug"><?= h($node->slug) ?></td>
                        <td data-title="title"><?= h($node->title) ?></td>
                        <td data-title="created"><?= h($node->created) ?></td>
                        <td data-title="modified"><?= h($node->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['prefix'=>false,'action' => 'view', $node->slug],['target'=>'_BLANK','class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $node->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $node->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $node->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
