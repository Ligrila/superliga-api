<div class="card">
  <div class="card-header">
    <?= __('Posts') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="posts index no-more-tables">
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
                <?php foreach ($posts as $post): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($post->id) ?></td>
                        <td data-title="slug"><?= h($post->slug) ?></td>
                        <td data-title="title"><?= h($post->title) ?></td>
                        <td data-title="created"><?= h($post->created) ?></td>
                        <td data-title="modified"><?= h($post->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['prefix'=>false,'action' => 'view', $post->slug],['target'=>'_BLANK','class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $post->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $post->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $post->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
