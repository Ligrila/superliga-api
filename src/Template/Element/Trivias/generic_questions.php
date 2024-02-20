<?php $questions = \Cake\ORM\TableRegistry::get('GenericQuestions')
    ->find()
    ->where(['GenericQuestions.trivia_id'=>$trivia->id])
    ->order(['used'=>'ASC'])
    ?>
<ul class="list-group">
    <?php foreach($questions as $question):?>
        <li class="list-group-item <?= $question->used ? 'disabled' : '' ?>">
            <?php if($question->used):?>
            <del><?= $question->question ?></del>
            <?php else:?>
                <?php if(true || $trivia->type != 'trivia'):?>
                    <?= $this->Html->link($question->question,['controller'=>'questions','action'=>'add-generic',$trivia->id,$question->team_id,$question->id])?>
                <?php else:?>
                    <?= $question->question ?>
                <?php endif;?>
            <?php endif;?>
            / 
            <span class="list-group-item-info"><?= $question->points?> Puntos</span>

        </li>
<?php endforeach;?>
</ul>