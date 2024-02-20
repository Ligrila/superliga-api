<?php $templates = \Cake\ORM\TableRegistry::get('QuestionTemplates')->find()?>
<div class="message-header">
                      <h6><?= $this->Html->image($team->avatar,['class'=>'avatar avatar-sm img-rounded'])?><?= $team->name?></h6>
</div>
                    <div class="flex-xs scroll-y">
                        <div class="row message-list">
                              <?php foreach($templates as $template):?>
                                  <?= $this->element('Trivias/question_template',compact('team','template'))?>
                              <?php endforeach;?>
                        </div>
                    </div>