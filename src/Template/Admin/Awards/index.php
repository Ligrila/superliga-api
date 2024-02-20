<div class="card">
  <div class="card-header">
    <?= __('Premios') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="awards index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('picture','Imagen') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('points','Puntos') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($awards as $award): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($award->id) ?></td>
                        <td data-title="name"><?= h($award->name) ?></td>
                        <td data-title="picture">
                            <?= $this->Html->image($award->mini_avatar) ?><br />
                            <?= $this->Html->link(__('Cambiar'),['action'=>'change_image',$award->id],['data-toggle'=>'modal','data-target'=>'#']) ?>
                        </td>
                        <td data-title="points"><?= $this->Number->format($award->points) ?></td>
                        <td data-title="created"><?= h($award->created) ?></td>
                        <td data-title="modified"><?= h($award->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $award->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $award->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $award->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $award->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
