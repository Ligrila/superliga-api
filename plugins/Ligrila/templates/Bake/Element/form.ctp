<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
$toSpanish = function($action){
  switch($action){
    case 'add' : return 'agregar';
    case 'edit' : return 'editar';
    case 'delete' : return 'borrar';
  }
  return $action;
}
%>
<nav class="nav nav-pills m-b-1">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <% if (strpos($action, 'add') === false): %>
    <?= $this->Form->postLink(
            __('Borrar') . '<i class="material-icons">delete</i>' ,
            ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>],
            ['class'=>'btn btn-danger btn-icon','escape'=>false,'confirm' => __('¿Estás seguro de borrar el item # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>)]
        )
    ?>
    <% endif; %>
</nav>

<div class="card">
  <div class="card-header">
    <?= __('<%= Inflector::humanize($toSpanish($action)) %> <%= $singularHumanName %>') ?>
  </div>
<div class="card-block">
      <div class="<%= $pluralVar %> form large-9 medium-8 columns content">
        <?= $this->Form->create($<%= $singularVar %>) ?>
        <div class="form-body">
          <fieldset>
              <?php

      <%
              foreach ($fields as $field) {
                  if (in_array($field, $primaryKey)) {
                      continue;
                  }
                  if (isset($keyFields[$field])) {
                      $fieldData = $schema->column($field);
                      if (!empty($fieldData['null'])) {
      %>
                    echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true]);
      <%
                      } else {
      %>
                  echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
      <%
                      }
                      continue;
                  }
                  if (!in_array($field, ['created', 'modified', 'updated','created_by','modified_by'])) {
                      $fieldData = $schema->column($field);
                      if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
      %>
                  echo $this->Form->input('<%= $field %>', ['empty' => true,'type'=>'text','data-provide'=>'datepicker','data-date-language'=>'es']);
      <%
                      } else {
      %>
                  echo $this->Form->input('<%= $field %>',[]);
      <%
                      }
                  }
              }
              if (!empty($associations['BelongsToMany'])) {
                  foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
      %>
                  echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
      <%
                  }
              }
      %>
              ?>
          </fieldset>
        </div>
        <?= $this->Form->button(__('Enviar') . '<i class="material-icons">save</i>' ,['class'=>'btn btn-icon btn-default','escape'=>false]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
