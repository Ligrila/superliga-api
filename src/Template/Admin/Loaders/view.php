<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $loader->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="loaders view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">L</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($loader->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Email') ?></span></div>
            <div class="col p-l-2"><?= h($loader->email) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Role') ?></span></div>
            <div class="col p-l-2"><?= h($loader->role) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Password') ?></span></div>
            <div class="col p-l-2"><?= h($loader->password) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('First Name') ?></span></div>
            <div class="col p-l-2"><?= h($loader->first_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Name') ?></span></div>
            <div class="col p-l-2"><?= h($loader->last_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Hash') ?></span></div>
            <div class="col p-l-2"><?= h($loader->hash) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Enabled') ?></span></div>
            <div class="col p-l-2"><?= h($loader->enabled) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Document') ?></span></div>
            <div class="col p-l-2"><?= h($loader->document) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Address') ?></span></div>
            <div class="col p-l-2"><?= h($loader->address) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Postal Code') ?></span></div>
            <div class="col p-l-2"><?= h($loader->postal_code) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Phone') ?></span></div>
            <div class="col p-l-2"><?= h($loader->phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Mobile Phone') ?></span></div>
            <div class="col p-l-2"><?= h($loader->mobile_phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Fax') ?></span></div>
            <div class="col p-l-2"><?= h($loader->fax) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Dir') ?></span></div>
            <div class="col p-l-2"><?= h($loader->dir) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Image') ?></span></div>
            <div class="col p-l-2"><?= h($loader->image) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('City') ?></span></div>
            <div class="col p-l-2"><?= h($loader->city) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Province') ?></span></div>
            <div class="col p-l-2"><?= h($loader->province) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Nationality') ?></span></div>
            <div class="col p-l-2"><?= h($loader->nationality) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Deleted') ?></span></div>
            <div class="col p-l-2"><?= h($loader->deleted) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($loader->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Login Count') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($loader->login_count) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($loader->created_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($loader->modified_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Login') ?></span></div>
            <div class="col p-l-2"><?= h($loader->last_login) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Birth Date') ?></span></div>
            <div class="col p-l-2"><?= h($loader->birth_date) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($loader->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($loader->modified) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Receive Emails') ?></span></div>
            <div class="col p-l-2"><?= $loader->receive_emails ? __('Yes') : __('No'); ?></div>
        </div>

    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph(h($loader->about)); ?>
    </div>
</div>
