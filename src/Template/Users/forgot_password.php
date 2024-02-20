<div class="container">
<?= $this->Form->create()?>
    <?= $this->Form->control('email')?>
    <?= $this->Form->submit('Recuperar',['class'=>'btn btn-primary'])?>
<?= $this->Form->end()?>
</div>