<nav class="nav nav-pills">
    <?= $this->Html->link(__('Listado').'<i class="material-icons">list</i>', ['action' => 'index'],['class'=>'btn btn-primary btn-icon','escape'=>false]) ?>
    <?= $this->Html->link(
            __('Editar') . '<i class="material-icons">edit</i>' ,
            ['action' => 'edit', $operator->id],
            ['class'=>'btn btn-info btn-icon','escape'=>false]
        )
    ?>
</nav>




<div class="operators view flex-xs scroll-y p-a-3">
  <div class="column-equal m-b-2">
                    <div class="col">
                      <div class="circle-icon circle-icon-large bg-info">O</div>
                    </div>
                    <div class="col v-align-middle p-l-2">
                      <h1>
                        <?= h($operator->id) ?>
                      </h1>
                    </div>
    </div>

        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Email') ?></span></div>
            <div class="col p-l-2"><?= h($operator->email) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Role') ?></span></div>
            <div class="col p-l-2"><?= h($operator->role) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Password') ?></span></div>
            <div class="col p-l-2"><?= h($operator->password) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('First Name') ?></span></div>
            <div class="col p-l-2"><?= h($operator->first_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Name') ?></span></div>
            <div class="col p-l-2"><?= h($operator->last_name) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Hash') ?></span></div>
            <div class="col p-l-2"><?= h($operator->hash) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Enabled') ?></span></div>
            <div class="col p-l-2"><?= h($operator->enabled) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Document') ?></span></div>
            <div class="col p-l-2"><?= h($operator->document) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Address') ?></span></div>
            <div class="col p-l-2"><?= h($operator->address) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Postal Code') ?></span></div>
            <div class="col p-l-2"><?= h($operator->postal_code) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Phone') ?></span></div>
            <div class="col p-l-2"><?= h($operator->phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Mobile Phone') ?></span></div>
            <div class="col p-l-2"><?= h($operator->mobile_phone) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Fax') ?></span></div>
            <div class="col p-l-2"><?= h($operator->fax) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Dir') ?></span></div>
            <div class="col p-l-2"><?= h($operator->dir) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Image') ?></span></div>
            <div class="col p-l-2"><?= h($operator->image) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('City') ?></span></div>
            <div class="col p-l-2"><?= h($operator->city) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Province') ?></span></div>
            <div class="col p-l-2"><?= h($operator->province) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Nationality') ?></span></div>
            <div class="col p-l-2"><?= h($operator->nationality) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Deleted') ?></span></div>
            <div class="col p-l-2"><?= h($operator->deleted) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Id') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($operator->id) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Login Count') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($operator->login_count) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($operator->created_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified By') ?></span></div>
            <div class="col p-l-2"><?= $this->Number->format($operator->modified_by) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Last Login') ?></span></div>
            <div class="col p-l-2"><?= h($operator->last_login) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Birth Date') ?></span></div>
            <div class="col p-l-2"><?= h($operator->birth_date) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Created') ?></span></div>
            <div class="col p-l-2"><?= h($operator->created) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Modified') ?></span></div>
            <div class="col p-l-2"><?= h($operator->modified) ?></div>
        </div>
        <div class="column-equal m-b-2">
            <div class="col p-l-2 text-xs-right"><span class="text-muted"><?= __('Receive Emails') ?></span></div>
            <div class="col p-l-2"><?= $operator->receive_emails ? __('Yes') : __('No'); ?></div>
        </div>

    <div class="row">
        <h4><?= __('About') ?></h4>
        <?= $this->Text->autoParagraph(h($operator->about)); ?>
    </div>
</div>
