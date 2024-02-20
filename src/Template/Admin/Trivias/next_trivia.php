<div class="card">
  <div class="card-header">
    
      <?= __('Próxima trivia') ?> 
      <?php if(!empty($trivia)):?>
        <?php if($trivia->type == 'normal'):?>
          <strong><?= $trivia->local_team->name ?> VS <?= $trivia->visit_team->name ?></strong>
        <?php else:?>
          <strong> programada</strong>
        <?php endif;?>
      <?php endif;?>
  </div>
  <div class="card-block">
    <?php if(!empty($trivia)):?>
          <?php if($trivia->type == 'normal'):?>
          <div class="row mx-0">
                  <div class="col-lg-6 pa-0 messages-list bg-white b-r flexbox-xs layout-column-xs full-height">
                    <?= $this->element('Trivias/team_avatar',['team'=>$trivia->local_team])?>
                  </div>
                  <div class="col-lg-6 pa-0 messages-list bg-white b-r flexbox-xs layout-column-xs full-height">
                    <?= $this->element('Trivias/team_avatar',['team'=>$trivia->visit_team])?>
                  </div>
                  
            </div>
            <?php endif;?>
            <div class="text-center mt-3">
              
              <h2>
                La trivia comenzará en
              </h2>

              <h3 id='countdown' data-date=<?= $trivia->start_datetime->format('c')?>>
              </h3>
              <p>Fecha de la trivia: <strong>
              <?= $this->Time->i18nFormat( $trivia->start_datetime) ;?>
              </strong>
              </p>

              <?= $this->Form->postLink('Comenzar trivia manualmente',['action'=>'startTrivia',$trivia->id],['class'=>'btn btn-primary','confirm'=>__('¿Está seguro de hacer esto?')])?>
            </div>

    
        
    <?php else:?>
        <p class="alert alert-warning">
            No hay ninguna trivia en este momento
        </p>
    <?php endif;?>

  </div>
</div>
