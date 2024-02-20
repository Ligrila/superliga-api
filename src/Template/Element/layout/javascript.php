<?= $this->Html->scriptBlock(sprintf('var Request = %s;',json_encode($this->request->getAttribute('params'))));?>

<?= $this->Html->script(['jquery','popper','bootstrap','selectize.min','currency.min.js','moment.min.js','moment-timezone.min.js','jquery.countdown.min.js']);?>
<?= $this->Html->script(['main']);?>
<?= $this->Html->script('/admin-assets/js/matchController');?>
