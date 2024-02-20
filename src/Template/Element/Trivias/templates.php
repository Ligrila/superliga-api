<div class="row m-x-0">
      <?php if( $trivia->type == 'normal' || \Cake\Core\Configure::read('debug') > 0):?>
                  <div class="col-lg-12 pa-0 messages-list">
                    <?= $this->element('Trivias/team_templates',['team'=>$trivia->local_team])?>
                  </div>
                  <div class="col-lg-12 pa-0 messages-list">
                    <?= $this->element('Trivias/team_templates',['team'=>$trivia->visit_team])?>
                  </div>
      <?php else:?>
              <div class="col-lg-12 pa-0 messages-list">
                <h3> Trivia Programada </h3>
              </div>
      <?php endif;?>
                  <div class="col-lg-12 pa-0 messages-list mt-2 b-t">
                    <div class="message-header">
                      <h6>
                        <?= $this->Html->image('teams/generic-team-logo.png',['class'=>'avatar avatar-sm img-rounded'])?>
                          <?= $trivia->type == 'normal' ? __('Preguntas genéricas'): __('Preguntas de la trivia')?>
                        </h6>
                    </div>
                    <?= $this->element('Trivias/generic_questions')?>

                  </div>
</div>