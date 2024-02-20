<div class="card">
  <div class="card-header">
    <?= __('Respuestas') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <h3>Correctas</h3>

    <div class="answers index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Creada</th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($correctAnswers as $answer): ?>
                <tr>
                        <td data-title="id"><?= $answer->question->question ?></td>
                        <td data-title="created"><?= h($answer->created) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $answer->id],['class'=>'btn btn-sm btn-primary']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3>Incorrectas</h3>

<div class="answers index no-more-tables">
    <table class="table table-striped">
        <thead>
            <tr>
                    <th scope="col">Pregunta</th>
                    <th scope="col">Creada</th>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wrongAnswers as $answer): ?>
            <tr>
                    <td data-title="id"><?= $answer->question->question ?></td>
                    <td data-title="created"><?= h($answer->created) ?></td>
                    <td class="actions" data-title="<?= __('Acciones')?>">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $answer->id],['class'=>'btn btn-sm btn-primary']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

  </div>
</div>
