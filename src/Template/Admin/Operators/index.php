<div class="card">
  <div class="card-header">
    <?= __('Operators') ?>
  </div>
  <div class="card-block">
    <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'],['class'=>'btn btn-primary btn-float shadow','escape'=>false]) ?>

    <div class="operators index no-more-tables">
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
                <?php foreach ($operators as $operator): ?>
                <tr>
                        <td data-title="id"><?= $this->Number->format($operator->id) ?></td>
                        <td data-title="email"><?= h($operator->email) ?></td>
                        <td data-title="role"><?= h($operator->role) ?></td>
                        <td data-title="password"><?= h($operator->password) ?></td>
                        <td data-title="first_name"><?= h($operator->first_name) ?></td>
                        <td data-title="last_name"><?= h($operator->last_name) ?></td>
                        <td data-title="hash"><?= h($operator->hash) ?></td>
                        <td data-title="enabled"><?= h($operator->enabled) ?></td>
                        <td data-title="document"><?= h($operator->document) ?></td>
                        <td data-title="address"><?= h($operator->address) ?></td>
                        <td data-title="postal_code"><?= h($operator->postal_code) ?></td>
                        <td data-title="phone"><?= h($operator->phone) ?></td>
                        <td data-title="mobile_phone"><?= h($operator->mobile_phone) ?></td>
                        <td data-title="fax"><?= h($operator->fax) ?></td>
                        <td data-title="dir"><?= h($operator->dir) ?></td>
                        <td data-title="image"><?= h($operator->image) ?></td>
                        <td data-title="last_login"><?= h($operator->last_login) ?></td>
                        <td data-title="login_count"><?= $this->Number->format($operator->login_count) ?></td>
                        <td data-title="birth_date"><?= h($operator->birth_date) ?></td>
                        <td data-title="city"><?= h($operator->city) ?></td>
                        <td data-title="province"><?= h($operator->province) ?></td>
                        <td data-title="nationality"><?= h($operator->nationality) ?></td>
                        <td data-title="deleted"><?= h($operator->deleted) ?></td>
                        <td data-title="receive_emails"><?= h($operator->receive_emails) ?></td>
                        <td data-title="created"><?= h($operator->created) ?></td>
                        <td data-title="modified"><?= h($operator->modified) ?></td>
                        <td class="actions" data-title="<?= __('Acciones')?>">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $operator->id],['class'=>'btn btn-sm btn-primary']) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $operator->id],['class'=>'btn btn-sm btn-default']) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $operator->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $operator->id),'class'=>'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $this-> element('Ligrila.pagination')?>
    </div>

  </div>
</div>
