<div class="message-body flex-xs scroll-y">
                        <div class="p-1">
                            <div class="pull-left mr-1">
                            <?= $this->Html->image($question->team->avatar,['class'=>'avatar avatar-md img-rounded'])?>
                            </div>
                            <div class="overflow-hidden">
                            <div class="date">
                                <?= $question->created?>
                            </div>
                            <h4 class="lead mt-0">
                                <?= $question->question?>
                            </h4>
                            <div class="message-sender">
                                <p>
                                <?= $question->points ?> puntos
                                </p>
                            </div>
                            </div>
                            <div class="p-1">
                                <p>Opciones:</p>
                                <ol class="dd-list">
                                    <?php for($i=1;$i<=3;$i++):?>
                                        <li class="dd-item dd3-item">
                                            <div class="dd-handle dd3-handle">
                                                &nbsp; <!-- Opción <?= $i?> -->
                                            </div>
                                            <div class="dd3-content">
                                                <strong><?= $i ?></strong> - <?= $question->{"option_$i"}?>
                                                <?php if(empty($genericQuestion)):?>
                                                    <span class="pull-right">
                                                        <?= $this->Html->link(__('<i class="fa fa-check"></i>'),
                                                            ['controller'=>'questions','action'=>'finish',$question->id,"option_".$i]
                                                            ,['escape'=>false,'class'=>'btn btn-round btn-primary btn-sm btn-correct-option'])
                                                        ?>
                                                    </span>
                                                <?php endif;?>
                                            </div>
                                        </li>
                                    <?php endfor;?>
                                </ol>
                            </div>
                        </div>
                                <div class="m-a-1">
                                        <div class="bg-default rounded p-1">
                                            <?php if(empty($genericQuestion)):?>
                                                <?= $this->Html->link(__('Opcion 1 correcta'),['controller'=>'questions','action'=>'finish',$question->id,'option_1'],['class'=>'m-t-1 btn btn-round btn-success btn-correct-option']) ?>
                                                <?= $this->Html->link(__('Opcion 2 correcta'),['controller'=>'questions','action'=>'finish',$question->id,'option_2'],['class'=>'m-t-1 btn btn-round btn-info btn-correct-option']) ?>
                                                <?= $this->Html->link(__('Opcion 3 correcta'),['controller'=>'questions','action'=>'finish',$question->id,'option_3'],['class'=>'m-t-1 btn btn-round btn-warning btn-correct-option']) ?>
                                                <?= $this->Html->link(__('Cancelar'),['controller'=>'questions','action'=>'cancel',$question->id],['class'=>'m-t-1 btn btn-round btn-danger']) ?>
                                            <?php else:?>
                                                <?= $this->Html->link(__('Finalizar'),['controller'=>'questions','action'=>'finish',$question->id,$genericQuestion->correct_option],['class'=>'m-t-1 btn btn-round btn-success btn-correct-option','id'=>'finish-question-button']) ?>
                                                <p class="pull-right text-dark" id='countdown-generic-question' data-date=<?= $question->created->addSeconds(15)->format('c')?>></p>
                                                <?= $this->Html->link(__('Cancelar'),['controller'=>'questions','action'=>'cancel',$question->id],['class'=>'m-t-1 btn btn-round btn-danger']) ?>

                                            <?php endif;?>
                                        </div>
                                </div>

                                                                <!-- Modal -->
<div id="set-correct-option-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cerrando pregunta</h4>
            </div>
            <div class="modal-body">
                <p>
                <i class="fa fa-circle-o-notch fa-spin"></i>
                <span id="modal-current-status">Notificando a usuarios.</span>
                </p>
            </div>

        </div>

    </div>
</div>
