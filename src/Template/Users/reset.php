<div class="container">
<?= $this->Form->create()?>
    <?= $this->Form->control('password',['label'=>'Nueva contraseña'])?>
    <?= $this->Form->submit('Recuperar',['class'=>'btn btn-primary'])?>
<?= $this->Form->end()?>
</div>