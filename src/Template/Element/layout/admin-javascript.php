
<?= $this->Html->scriptBlock(sprintf('var Request = %s;',json_encode($this->request->getAttribute('params'))));?>
<script type="text/javascript">
  Request.websocketUrl = "<?= false /* \Cake\Core\Configure::read('debug') > 0 */ ? 'ws://localhost:8889' : 'wss://jugadasuperliga.com/wss'?>";
  window.paceOptions = {
    document: true,
    eventLag: true,
    restartOnPushState: true,
    restartOnRequestAfter: true,
    ajax: {
      trackMethods: [ 'POST','GET']
    }
  };
</script>

<!-- build:js({.tmp,app}) scripts/app.min.js -->
<?= $this->Html->script('/admin-assets/vendor/jquery/dist/jquery.js');?>
<?= $this->Html->script('/admin-assets/vendor/pace/pace.js');?>
<?= $this->Html->script('/admin-assets/vendor/tether/dist/js/tether.js');?>
<?= $this->Html->script('/admin-assets/js/bootstrap/bootstrap.bundle');?>
<?= $this->Html->script('/admin-assets/vendor/fastclick/lib/fastclick.js');?>
<?= $this->Html->script('/admin-assets/vendor/select2/js/select2.full.min.js');?>
<?= $this->Html->script('/admin-assets/vendor/select2/js/i18n/es.js');?>
<?= $this->Html->script('/admin-assets/vendor/selectize/dist/js/standalone/selectize.min.js');?>

<?= $this->Html->script('/admin-assets/vendor/bootstrap-daterangepicker/daterangepicker.js');?>

<?= $this->Html->script('/admin-assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>
<?= $this->Html->script('/admin-assets/js/locales/bootstrap-datepicker.es.js');?>

<?= $this->Html->script('/admin-assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js');?>

<?= $this->Html->script('/admin-assets/vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js');?>
<?= $this->Html->script('/admin-assets/js/helpers/noty-defaults.js');?>

<?= $this->Html->script('/admin-assets/vendor/moment/min/moment.min.js');?>
<?= $this->Html->script('/admin-assets/vendor/jquery.ui/ui/core.js');?>
<?= $this->Html->script('/admin-assets/vendor/jquery.ui/ui/widget.js');?>
<?= $this->Html->script('/admin-assets/vendor/jquery.ui/ui/mouse.js');?>
<?= $this->Html->script('/admin-assets/vendor/jquery.ui/ui/draggable.js');?>
<?= $this->Html->script('/admin-assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js');?>

<?= $this->Html->script('/admin-assets/vendor/fullcalendar/dist/fullcalendar.min.js');?>
<?= $this->Html->script('/admin-assets/vendor/fullcalendar/dist/lang/es.js');?>


<?= $this->Html->script('/admin-assets/js/ui/material-design');?>
<?= $this->Html->script('/admin-assets/js/helpers/table');?>
<?= $this->Html->script('/admin-assets/js/jquery.table2excel.js');?>
<?= $this->Html->script('/admin-assets/js/countdown.js');?>
<?= $this->Html->script('/admin-assets/js/tinymce/js/tinymce/tinymce.min.js');?>

<!-- Boostrap Table -->
<?= $this->Html->script('/admin-assets/js/bootstrap-table/bootstrap-table.js');?>
<?= $this->Html->script('/admin-assets/js/bootstrap-table/extensions/bootstrap-table-fixed-columns.min.js');?>

<?= $this->Html->script('/admin-assets/js/main.js');?>
<!-- endbuild -->

<?php
if ($this->request->getSession()->read('Flash')) {
    foreach($this->request->getSession()->read('Flash') as $key => $flash) {
        $flash = array_shift($flash);
        $this->request->getSession()->delete("Flash.$key");
        $class = 'warning';

        if(!empty($flash['params']['class'])){
            $class = $flash['params']['class'];
        } else if(!empty($flash['element'])){
            $els = explode('/admin-assets/',$flash['element']);
            $els = array_pop($els);
            if(!empty($els)){
                $class = str_replace('Flash/','',$els);
            }
        }
        
        $bodytag = str_replace("/", "", $class);
        $bodytag = str_replace("flash", "", $bodytag);

        echo $this->Html->scriptBlock(sprintf('message(\'%s\',\''.$bodytag.'\',\'topRight\');', h($flash['message'])));
    }
}

echo $this->Html->script(['/admin-assets/js/orders']);
echo $this->Html->script(['/admin-assets/js/trivias.js?v='.uniqid()]);
echo $this->Html->script('/admin-assets/js/matchController');
