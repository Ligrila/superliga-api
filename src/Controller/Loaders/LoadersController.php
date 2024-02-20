<?php
namespace App\Controller\Loaders;

use App\Controller\AppController;

use Cake\Network\Exception\UnauthorizedException;


/**
 * Superusers Controller
 *
 * @property \App\Model\Table\SuperusersTable $Superusers
 *
 * @method \App\Model\Entity\Superuser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoadersController extends LoadersAppController
{


    public $publicActions = ['login'];
    public function login()
    {
      $this->viewBuilder()->layout('admin_login');
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



}
