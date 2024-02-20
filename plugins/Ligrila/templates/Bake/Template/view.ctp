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

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $<%= $singularVar %>-><%= $primaryKey[0] %>],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="<%= $pluralVar %> view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info"><%= ucfirst($singularHumanName[0]) %></div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($<%= $singularVar %>-><%= $displayField %>) ?>
                      </h1>
                    </div>
    </div>

<% if ($groupedFields['string']) : %>
<% foreach ($groupedFields['string'] as $field) : %>
<% if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
%>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('<%= Inflector::humanize($details['property']) %>') ?></span></div>
            <div class="col p-l-2"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></div>
        </div>
<% else : %>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('<%= Inflector::humanize($field) %>') ?></span></div>
            <div class="col p-l-2"><?= h($<%= $singularVar %>-><%= $field %>) ?></div>
        </div>
<% endif; %>
<% endforeach; %>
<% endif; %>
<% if ($associations['HasOne']) : %>
    <%- foreach ($associations['HasOne'] as $alias => $details) : %>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('<%= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) %>') ?></span></div>
            <div class="col p-l-2"><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></div>
        </div>
    <%- endforeach; %>
<% endif; %>
<% if ($groupedFields['number']) : %>
<% foreach ($groupedFields['number'] as $field) : %>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('<%= Inflector::humanize($field) %>') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></div>
        </div>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['date']) : %>
<% foreach ($groupedFields['date'] as $field) : %>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><%= "<%= __('" . Inflector::humanize($field) . "') %>" %></span></div>
            <div class="col p-l-2"><?= h($<%= $singularVar %>-><%= $field %>) ?></div>
        </div>
<% endforeach; %>
<% endif; %>
<% if ($groupedFields['boolean']) : %>
<% foreach ($groupedFields['boolean'] as $field) : %>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('<%= Inflector::humanize($field) %>') ?></span></div>
            <div class="col p-l-2"><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></div>
        </div>
<% endforeach; %>
<% endif; %>

<% if ($groupedFields['text']) : %>
<% foreach ($groupedFields['text'] as $field) : %>
    <div class="row">
        <h4><?= __('<%= Inflector::humanize($field) %>') ?></h4>
        <?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?>
    </div>
<% endforeach; %>
<% endif; %>
<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize(Inflector::underscore($details['controller']));
    %>
    <div class="related">
        <h4><?= __('Related <%= $otherPluralHumanName %>') ?></h4>
        <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)): ?>
        <table cellpadding="0" cellspacing="0">
            <div class="column-equal m-b-2">
<% foreach ($details['fields'] as $field): %>
                <th scope="col"><?= __('<%= Inflector::humanize($field) %>') ?></span></div>
<% endforeach; %>
                <th scope="col" class="actions"><?= __('Actions') ?></span></div>
            </div>
            <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
            <div class="column-equal m-b-2">
            <%- foreach ($details['fields'] as $field): %>
                <div class="col p-l-2"><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></div>
            <%- endforeach; %>
            <%- $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $otherPk %>)]) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
<% endforeach; %>
</div>
