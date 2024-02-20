<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Network\Exception\UnauthorizedException;


/**
 * Superusers Controller
 *
 * @property \App\Model\Table\SuperusersTable $Superusers
 *
 * @method \App\Model\Entity\Superuser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuperusersController extends AdminAppController
{


    public $publicActions = ['login'];
    public function login()
    {
      $this->viewBuilder()->setLayout('admin_login');
      if ($this->request->is('post')) {
            if (!$this->Recaptcha->verify()) { // if configure enable = false, always return true
                throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
            }
          $user = $this->Auth->identify();
          if ($user) {
              $this->_setCookie();
              $this->Auth->setUser($user);
              return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Flash->error(__('Tu nombre de usuario o contraseña no son correctos.'));
      }
    }

    protected function _setCookie() {
        if (empty($this->request->getData('remember_me'))||!$this->request->getData('remember_me')) {
            return false;
        }
        $data = [
            'username' => $this->request->getData('username'),
            'password' => $this->request->getData('password')
        ];

        $this->Cookie->write('RememberMe', $data, true, '+1 month');

        return true;
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');

        return $this->redirect($this->Auth->logout());
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $superusers = $this->paginate($this->Superusers);

        $this->set(compact('superusers'));
    }

    /**
     * View method
     *
     * @param string|null $id Superuser id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $superuser = $this->Superusers->get($id, [
            'contain' => []
        ]);

        $this->set('superuser', $superuser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $superuser = $this->Superusers->newEmptyEntity();
        if ($this->request->is('post')) {
            $superuser = $this->Superusers->patchEntity($superuser, $this->request->getData());
            if ($this->Superusers->save($superuser)) {
                $this->Flash->success(__('The superuser has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The superuser could not be saved. Please, try again.'));
        }
        $this->set(compact('superuser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Superuser id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $superuser = $this->Superusers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $superuser = $this->Superusers->patchEntity($superuser, $this->request->getData());
            if ($this->Superusers->save($superuser)) {
                $this->Flash->success(__('The superuser has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The superuser could not be saved. Please, try again.'));
        }
        $this->set(compact('superuser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Superuser id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $superuser = $this->Superusers->get($id);
        if ($this->Superusers->delete($superuser)) {
            $this->Flash->success(__('The superuser has been deleted.'));
        } else {
            $this->Flash->error(__('The superuser could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
