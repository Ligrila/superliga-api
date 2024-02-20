<div class="card">
  <div class="card-header">
    <?= __('Dashboard') ?>
    <?php if(!empty($cacheData)):?>
        <div class="pull-right">
            <?= $this->Form->create()?>
            <?= $this->Form->hidden('refresh_cache')?>
            <?= $this->Form->submit('Refrescar cache',['class'=>'btn btn-sm btn-primary']);?>
            <?= $this->Form->end();?>
        </div>
    <?php endif;?>
  </div>
  <div class="card-block">
    <?php foreach($data as $d):?>
        <div class="card">
            <div class="card-header">
                <?= $d['title'] ?>
            </div>
            <div class="card-block">
                <?= $d['value'] ?>
            </div>
        </div>
    <?php endforeach;?>
  </div>
</div>
