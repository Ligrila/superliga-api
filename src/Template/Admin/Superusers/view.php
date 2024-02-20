<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $superuser->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="superusers view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">S</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($superuser->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Email') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->email) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Role') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->role) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Password') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->password) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('First Name') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->first_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Name') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->last_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Hash') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->hash) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Document') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->document) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Address') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->address) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Postal Code') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->postal_code) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Phone') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Mobile Phone') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->mobile_phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Fax') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->fax) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Dir') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->dir) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Image') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->image) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('City') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->city) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Province') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->province) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Nationality') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->nationality) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($superuser->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Login Count') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($superuser->login_count) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($superuser->created_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($superuser->modified_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Login') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->last_login) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Birth Date') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->birth_date) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($superuser->modified) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Enabled') ?></span></div>
            <div class="col p-l-2"><?= $superuser->enabled ? __('Yes') : __('No'); ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Deleted') ?></span></div>
            <div class="col p-l-2"><?= $superuser->deleted ? __('Yes') : __('No'); ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Receive Emails') ?></span></div>
            <div class="col p-l-2"><?= $superuser->receive_emails ? __('Yes') : __('No'); ?></div>
        </div>

    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph(h($superuser->about)); ?>
    </div>
</div>
