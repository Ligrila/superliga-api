<!--Message list item-->
<div class="col-md-3 col-xs-12 message-list-item">
                    <a class="btn btn-primary btn-add-question" href="<?= \Cake\Routing\Router::url(['controller'=>'questions','action'=>'add',$trivia->id,$team->id,$template->id])?>">
                            <div class="message-list-item-header">
                              <div class="time">
                                <?= $template->points ?> puntos
                              </div>
                              <span class="bold text-white">
                                <?= __($template->short_question,$team->name) ?>
                              </span>
                            </div>
                            <?php /*
                            <p class="overflow-hidden">
                                <?= $template->option_1?> | <?= $template->option_2?> | <?= $template->option_3?><br/>
                                <strong>
                                Puntos  = <?= $template->points ?>
                                <?= __($trivia->points_multiplier > 1 ? ' X ' . $trivia->points_multiplier  : NULL ) ?>
                                </strong>
                            </p>
                            */ ?>

                </a>

</div>