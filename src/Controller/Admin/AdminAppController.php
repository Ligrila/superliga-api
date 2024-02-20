<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Controller\Controller;
use Cake\Event\Event;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AdminAppController extends Controller
{

    public $publicActions = [];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        //$this->loadComponent('Cookie');

        //$this->Cookie->config('path', '/admin');
        $this->loadComponent('Auth');
        $this->loadComponent('Recaptcha.Recaptcha', [
            'enable' => true,     // true/false
            'sitekey' => '6LdLQXkUAAAAAGswxEFPUU14ZCz5yzxbdnV8wxoD', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
            'secret' => '6LdLQXkUAAAAAP2Oa1wbzaBG9wzpBHOQNfvy6Sc8',
            'type' => 'image',  // image/audio
            'theme' => 'light', // light/dark
            'lang' => 'es',      // default en
            'size' => 'normal'  // normal/compact
        ]);
        $this->Auth->sessionKey = 'Auth.Admin';
        $config =  [

           'authorize'=>['Controller'],
           'authError' => 'La página a la que deseas ingresar está protegida o no tienes acceso a ella.',
           'authenticate' => [
               'Form' => [
                  'userModel' => 'Superusers',
                   'fields' => [
                       'username' => 'email',
                       'password' => 'password'
                   ]
               ]
           ],
           'loginAction' => [
               'prefix'=>'Admin',
               'controller' => 'Superusers',
               'action' => 'login'
           ],
           'loginRedirect' => [
               'controller' => 'Users',
               'prefix'=>'Admin',
               'action' => 'index'
           ],
           'logoutRedirect' => [
                'prefix'=>'Admin',
               'controller' => 'Superusers',
               'action' => 'login',
               'home'
           ]
       ];
       $this->Auth->setConfig($config);
       $this->viewBuilder()->setLayout('admin');
       $this->Auth->allow($this->publicActions);


       parent::initialize();

    }

    public function isAuthorized($user)
    {
      if(empty($user['role'])){
        return false;
      }
      return $user['role'] = 'admin';
    }

    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        $this->request->getSession()->write('user_timezone','America/Argentina/Buenos_Aires');
    }

}
