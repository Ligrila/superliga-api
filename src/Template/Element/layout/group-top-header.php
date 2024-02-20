<!-- top header -->
<nav class="header navbar">
  <div class="header-inner">
    <div class="navbar-item navbar-spacer-right brand hidden-lg-up">
      <!-- toggle offscreen menu -->
      <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen">
        <i class="material-icons">menu</i>
      </a>
      <!-- /toggle offscreen menu -->
      <!-- logo -->
      <a class="brand-logo hidden-xs-down">
        <?= $this->Html->image('logo_white.png')?>
      </a>
      <!-- /logo -->
    </div>
    <a class="navbar-item navbar-spacer-right navbar-heading hidden-md-down" href="#">
      <span><?= translateControllers($this->fetch('title'))?></span>
    </a>
    <?php if(!empty($searchBar)):?>
    <div class="navbar-search navbar-item">
        <?= $this->Form->create(null,['url'=>$searchBar['url'],'class'=>'search-form','type'=>'GET'])?>
        <i class="material-icons">search</i>
        <input class="form-control" name="q" value="<?= empty($_GET['q']) ? NULL :  $_GET['q'] ?>" type="text" placeholder="<?= $searchBar['placeholder']?>" />
        <?= $this->Form->end();?>
    </div>
    <?php endif;?>
    <div class="navbar-item nav navbar-nav">
  </div>
</nav>
<!-- /top header -->
