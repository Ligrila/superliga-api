<div class="card">
  <div class="card-header">
    <?php if(!empty($trivia)):?>
        <?php if($trivia->type == 'normal'):?>
            <?= __('En vivo') ?> <strong><?= $trivia->local_team->name ?> VS <?= $trivia->visit_team->name ?></strong>
        <?php else: ?>
            <?= __('Trivia') ?> <strong> programada</strong>
        <?php endif;?>
        <?= $trivia->points_multiplier > 1 ? ' Los puntos valen x ' . $trivia->points_multiplier  : NULL  ?>
        <?php if($trivia->type=='normal'  ):?>
                <?php if($trivia->half_time_finished && $trivia->half_time_started && $trivia->game_finished):?>
                    <?= $this->Form->postLink('Terminar partido!' , ['action'=>'finishTrivia',$trivia->id],['class'=>'btn btn-sm btn-danger pull-right','confirm'=>__('¿Está seguro de finalizar el partido?')])?>
                <?php else: ?>
                    <?php if($trivia->half_time_finished && !$trivia->half_time_started ):?>
                        <?= $this->Form->postLink('Comenzar 2do tiempo!' , ['action'=>'startHalfTime',$trivia->id],['class'=>'btn btn-sm btn-success pull-right','confirm'=>__('¿Está seguro de finalizar el partido?')])?>
                    <?php else:?>
                        <?php if(!$trivia->game_finished && $trivia->half_time_finished && $trivia->half_time_started):?>
                            <?= $this->Form->postLink('Terminar 2do tiempo!' , ['action'=>'finishGame',$trivia->id],['class'=>'btn btn-sm btn-info pull-right','confirm'=>__('¿Está seguro de finalizar el segundo tiempo?')])?>
                        <?php else: ?>
                            <?= $this->Form->postLink('Terminar 1er tiempo!' , ['action'=>'finishHalfTime',$trivia->id],['class'=>'btn btn-sm btn-info pull-right','confirm'=>__('¿Está seguro de finalizar el partido?')])?>
                        <?php endif;?>
                    <?php endif;?>
                <?php endif; ?>
                <?= $this->Form->postLink('Jugada de entre tiempo' , ['action'=>'startHalfTimePlay',$trivia->id],['class'=>'btn btn-sm btn-warning pull-right mr-3','confirm'=>__('¿Está seguro de enviar la jugada de entretiempo del partido?')])?>
                <?= $this->Form->postLink('Jugada extra' , ['action'=>'startExtraPlay',$trivia->id],['class'=>'btn btn-sm btn-info pull-right mr-3','confirm'=>__('¿Está seguro de enviar la jugada extra del partido?')])?>
                <?= $this->Html->link('Enviar banner' , ['controller'=>'Banners','action'=>'sendToApp',$trivia->id],['class'=>'btn btn-sm btn-info pull-right mr-3','data-toggle'=>'modal','data-target'=>'#'])?>
                <?= $this->Html->link('Agregar pregunta' , ['controller'=>'generic_questions','action'=>'add',$trivia->id],['class'=>'btn btn-sm btn-primary pull-right mr-3','confirm'=>__('¿Está seguro de agregar una pregunta?')])?>
            <?php else: ?>
                <?= $this->Form->postLink('Terminar partido!' , ['action'=>'finishTrivia',$trivia->id],['class'=>'btn btn-sm btn-danger pull-right','confirm'=>__('¿Está seguro de finalizar el partido?')])?>
        <?php endif;?>
    <?php endif;?>
  </div>
  <div class="card-block">
    <?php if(!empty($trivia)):?>
        <div class=" layout-xs b-b row">
              <div class="col-xs-12 col-md-12">
                <?php if(!empty($question) /*&& ( $trivia->type != 'trivia' || \Cake\Core\Configure::read('debug') > 0) */ ):?>
                    <?= $this->element('Trivias/question')?>
                <?php else:?>
                    <?php echo $this->element('Trivias/templates',compact('trivia'))?>
                <?php endif;?>
                </div>
        </div>

    <?php else:?>
        <p class="alert alert-warning">
            No hay ningún partido en este momento
        </p>
    <?php endif;?>

  </div>
</div>
