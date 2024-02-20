<%

$trFields = [
  'id'=>'#',
  'created'=> 'Creado',
  'modified'=> 'Modificado',
];
$ignoreFields = [
  'created_by'=> 'Creado',
  'modified_by'=> 'Modificado',
];

use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}

if (!empty($indexColumns)) {
    $fields = $fields->take($indexColumns);
}

%>
<div class="card">
  <div class="card-header">
    <?= __('<%= $pluralHumanName %>') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="<%= $pluralVar %> index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
    <% foreach ($fields as $field):
      $fieldName = ucfirst($field);
      if(in_array($field,array_keys($trFields))){
        $fieldName = $trFields[$field];
      }
      if(in_array($field,array_keys($ignoreFields))){
        continue;
      }
    %>
                    <th scope="col"><?= $this->Paginator->sort('<%= $field %>','<%= $fieldName %>') ?></th>
    <% endforeach; %>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                <tr>
    <%        foreach ($fields as $field) {
                if(in_array($field,array_keys($ignoreFields))){
                  continue;
                }
                $isKey = false;
                if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
    %>
                    <td data-title="<%= $field %>"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
    <%
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
    %>
                    <td data-title="<%= $field %>"><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
    <%
                    } else {
    %>
                    <td data-title="<%= $field %>"><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
    <%
                    }
                }
            }

            $pk = '$' . $singularVar . '->' . $primaryKey[0];
    %>
                    <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', <%= $pk %>],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', <%= $pk %>],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', <%= $pk %>),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
