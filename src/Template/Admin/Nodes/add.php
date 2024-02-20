<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Agregar Node') ?>
  </div>
<div class="card-block">
      <div class="nodes form large-9 medium-8 columns content">
        <?= $this->Form->create($node) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('title',[]);
                        echo $this->Form->control('body',['class'=>'htmleditor']);
                    ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escapeTitle'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php $this->Html->scriptBlock("
tinymce.init({
  selector: 'textarea',
  height: 500,
  valid_elements : '*[*]',
  menubar: false,
  plugins: [
    'code',
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'code | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//jugadasuperliga.com/css/main.css'
  ]
});

",['block'=>'script']) ?>
