<div class="card">
  <div class="card-header">
    <?= __('Loaders') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="loaders index no-more-tables">
        <table class="table table-striped">
            <thead>
                <tr>
                        <th scope="col"><?= $this->Paginator->sort('id','#') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email','Email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('role','Role') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('password','Password') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('first_name','First_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_name','Last_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('hash','Hash') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('enabled','Enabled') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('document','Document') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('address','Address') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('postal_code','Postal_code') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('phone','Phone') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('mobile_phone','Mobile_phone') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('fax','Fax') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('dir','Dir') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('image','Image') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_login','Last_login') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('login_count','Login_count') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('birth_date','Birth_date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('city','City') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('province','Province') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('nationality','Nationality') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('deleted','Deleted') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('receive_emails','Receive_emails') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created','Creado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modificado') ?></th>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loaders as $loader): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($loader->id) ?></td>
                        <td data-title="email"><?= h($loader->email) ?></td>
                        <td data-title="role"><?= h($loader->role) ?></td>
                        <td data-title="password"><?= h($loader->password) ?></td>
                        <td data-title="first_name"><?= h($loader->first_name) ?></td>
                        <td data-title="last_name"><?= h($loader->last_name) ?></td>
                        <td data-title="hash"><?= h($loader->hash) ?></td>
                        <td data-title="enabled"><?= h($loader->enabled) ?></td>
                        <td data-title="document"><?= h($loader->document) ?></td>
                        <td data-title="address"><?= h($loader->address) ?></td>
                        <td data-title="postal_code"><?= h($loader->postal_code) ?></td>
                        <td data-title="phone"><?= h($loader->phone) ?></td>
                        <td data-title="mobile_phone"><?= h($loader->mobile_phone) ?></td>
                        <td data-title="fax"><?= h($loader->fax) ?></td>
                        <td data-title="dir"><?= h($loader->dir) ?></td>
                        <td data-title="image"><?= h($loader->image) ?></td>
                        <td data-title="last_login"><?= h($loader->last_login) ?></td>
                        <td data-title="login_count"><?= $this->Number->format($loader->login_count) ?></td>
                        <td data-title="birth_date"><?= h($loader->birth_date) ?></td>
                        <td data-title="city"><?= h($loader->city) ?></td>
                        <td data-title="province"><?= h($loader->province) ?></td>
                        <td data-title="nationality"><?= h($loader->nationality) ?></td>
                        <td data-title="deleted"><?= h($loader->deleted) ?></td>
                        <td data-title="receive_emails"><?= h($loader->receive_emails) ?></td>
                        <td data-title="created"><?= h($loader->created) ?></td>
                        <td data-title="modified"><?= h($loader->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $loader->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $loader->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $loader->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $loader->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
