<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
        <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $post->id],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $post->id)]
        )
    ?>
    </nav>

<div class="card">
  <div class="card-header">
    <?= __('Editar Post') ?>
  </div>
<div class="card-block">
      <div class="posts form large-9 medium-8 columns content">
        <?= $this->Form->create($post) ?>
        <div class="form-body">
          <fieldset>
              <?php

                        echo $this->Form->control('slug',[]);
                        echo $this->Form->control('title',[]);
                        echo $this->Form->control('created',['label'=>'Fecha']);
                        echo $this->Form->hidden('created[timezone]',['value'=>$this->request->getSession()->read('user_timezone')]);
                        echo $this->Form->control('body',[]);
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
  menubar: false,
  valid_elements : '*[*]',
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
