<div class="card">
  <div class="card-header">
    <?= __('Banners') ?>
  </div>
  <div class="card-block">

    <div class="banners">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                    
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ENVIAR BANNER DE ADMOB</td>
                    <td>
                    <?= $this->Html->link(__('Enviar a la app'), ['controller'=>'banners','action'=>'send-admob-banner-to-app',$trivia_id]) ?>

                    </td>

                </tr>
                <?php foreach ($banners as $banner): ?>
                <tr>
                        <td data-title="name"><?= h($banner->name) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Enviar a la app'), ['controller'=>'banners','action'=>'send-banner-to-app',$banner->id,$trivia_id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

  </div>
</div>
