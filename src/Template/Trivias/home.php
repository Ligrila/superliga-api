<div class="hero">
    <div class="hero-content-wrapper">
        <div class="hero-content">
            <div class="container">
                <div class="promo col-10 col-md-12 mx-auto">
                    <?= $this->Html->image('live.png',['class'=>'img-fluid'])?>
                </div>

                <div class="promo  col-10 col-md-12 mx-auto">
                    <?= $this->Html->image('promo.png',['class'=>'img-fluid'])?>
                </div>
                <div class="download mt-4 mb-4">
                    <?= $this->Html->link('Descarga la app',['controller'=>'get','action'=>'index'],['class'=>'btn btn-primary'])?>
                </div>
            </div>
        </div>

    </div>

</div>


<?php
$isMobile = $this->request->is('mobile');
$calendarBreak = $isMobile ? 1 : 5;
?>


<div class="calendar mb-5 mt-5">
    <div class="container">
        <div class="title">
            <h2>FIXTURE LIGA ARGENTINA 2021</h2>
            <div class="separator"></div>
        </div>

            <div class="d-flex flex-row align-items-end justify-content-end">
                <?= $this->Form->create($trivia,['type'=>'GET']);?>
                <?= $this->Form->control('date_id',['options'=>$dates,'label'=>false,'class'=>'form-control'])?>
            </div>

        <?php if (!empty($currentDate)):?>
        <div id="calendar-carousel" class="carousel slide mt-3 col-10 col-md-12 mx-auto">
                                <div class="carousel-inner row w-100 mx-auto align-items-center">
                                        <div class="carousel-item active">
                                            <div class="row justify-content-center align-items-center">
                                                <?php foreach($currentDate->trivias as $i => $trivia):
                                                        if($i>0&&$i% $calendarBreak == 0){
                                                            echo '</div></div><div class="carousel-item"><div class="row justify-content-center align-items-center">';
                                                        }
                                                    ?>
                                                    <div class="trivia-widget col-md-2 col-xs-12 d-inline-block">
                                                        <div class="row">
                                                            <div class="col-6 d-flex align-items-center justify-content-center">
                                                                <?= $this->Html->image($trivia->local_team->avatar,['class'=>'img-fluid'])?>
                                                            </div>
                                                            <div class="col-6 d-flex align-items-center justify-content-center">
                                                                <?= $this->Html->image($trivia->visit_team->avatar,['class'=>'img-fluid'])?>
                                                            </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="trivia-title d-flex align-items-center justify-content-center col-12">
                                                                <h3>
                                                                    <?= $trivia->local_team->name?><br/>
                                                                    VS<br/>
                                                                    <?= $trivia->visit_team->name?><br/>
                                                                </h3>
                                                            </div>

                                                            <div class="trivia-date d-flex align-items-center justify-content-center col-12">
                                                                <h4>
                                                                    <span><?= $this->Time->i18nFormat($trivia->start_datetime,'EEEE dd/MM');?></span><br/>
                                                                    <?= $this->Time->i18nFormat($trivia->start_datetime,'HH:mm');?> HS.<br/>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php endforeach;?>
                                        </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#calendar-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#calendar-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
            </div>
        <?php endif;?>
    </div>
</div>


<div class="download-section mt-5 d-none d-md-block">
    <div class="container">
        <div class="text-center">
            <?= $this->Html->link($this->Html->image('appstore-transparent.png',['class'=>'mb-3 mb-sm-0']),'https://itunes.apple.com/us/app/jugada-superliga/id1435620888?ls=1&mt=8',['escape'=>false])?>
            <?= $this->Html->link($this->Html->image('playstore-transparent.png',['class'=>'mb-3 mb-sm-0']),'https://play.google.com/store/apps/details?id=com.balltoball.jugadasuperliga',['escape'=>false])?>
        </div>
    </div>
</div>
