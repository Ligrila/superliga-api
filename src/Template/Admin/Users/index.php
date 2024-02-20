<div class="card">
    <div class="card-header">
        <?= __('Users') ?>
    </div>
    <div class="card-block">
        <?= $this->Html->link('<i class="material-icons">create</i>', ['action' => 'add'], ['class' => 'btn btn-primary btn-float shadow', 'escape' => false]) ?>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <?= $this->Form->create($user, ['class' => 'card card-sm', 'type' => 'GET']) ?>
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <h3><i class="material-icons">search</i></h3>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" type="search" name="q" placeholder="Buscar usuarios" value="<?= $user->q ?>">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-primary" type="submit">Buscar</button>
                    </div>
                    <!--end of col-->
                </div>
                <?= $this->Form->end() ?>
            </div>
            <!--end of col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="users index no-more-tables">
            <div class="table-responsive">
                        <!-- data-fixed-columns="true"
                    data-fixed-right-number="1"
                    data-fixed-number="1"
                    data-sortable="false" -->
                <table 
                    class="table table-striped "
            
                    >
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('email', 'Email') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('first_name', 'Nombre') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('last_name', 'Apellido') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('document', 'Documento') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('phone', 'Telefono') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Points.points', 'Puntos') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Life.lives', 'Vida') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('created', 'Creado') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                            <th scope="col" 
                                class="actions"><?= __('Acciones') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td data-title="email"><?= h($user->email) ?></td>
                                <td data-title="Nombre"><?= h($user->first_name) ?></td>
                                <td data-title="Apellido"><?= h($user->last_name) ?></td>
                                <td data-title="Documento"><?= h($user->document) ?></td>
                                <td data-title="Telefono"><?= h($user->mobile_number) ?></td>
                                <td data-title="Puntos"><?= $user->has('point') ? @$user->point->points : 0 ?></td>
                                <td data-title="Vidas"><?= $user->has('life') ? @$user->life->lives : 0 ?></td>
                                <td data-title="created"><?= h($user->created) ?></td>
                                <td data-title="modified"><?= h($user->modified) ?></td>
                                <td class="actions" data-title="<?= __('Acciones') ?>">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink-<?= $user->id ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id], ['class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id], ['class' => 'dropdown-item']) ?>
                                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $user->id], ['confirm' => __('¿Estas seguro de borrar el item # {0}?', $user->id), 'class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Enviar push'), ['controller' => 'PushNotifications', 'action' => 'for_user', $user->id, '?' => ['return' => \Cake\Routing\Router::url(null, true)]], ['class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Agregar vidas'), ['controller' => 'lives', 'action' => 'add', $user->id, '?' => ['return' => \Cake\Routing\Router::url(null, true)]], ['escape' => false, 'class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Ver vidas'), ['controller' => 'lives', 'action' => 'index', $user->id, '?' => ['return' => \Cake\Routing\Router::url(null, true)]], ['escape' => false, 'class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Agregar vidas infinitas'), ['controller' => 'infinite-lives', 'action' => 'add', $user->id, '?' => ['return' => \Cake\Routing\Router::url(null, true)]], ['escape' => false, 'class' => 'dropdown-item']) ?>
                                        <?= $this->Html->link(__('Ver vidas infinitas'), ['controller' => 'infinite-lives', 'action' => 'index', $user->id, '?' => ['return' => \Cake\Routing\Router::url(null, true)]], ['escape' => false, 'class' => 'dropdown-item']) ?>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?= $this->element('Ligrila.pagination') ?>
        </div>
            </div>
        </div>
 

    </div>
</div>