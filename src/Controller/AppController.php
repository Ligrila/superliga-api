<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Websocket\Lib\Websocket;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $publicActions = ['index'];

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
        parent::initialize();


        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'storage' => 'Session',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ],
            ],
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize'
        ]);

        if(in_array($this->request->getParam('action'),$this->publicActions)){
            $this->Auth->allow();
          }

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

    }
    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);
    }

    protected function deleteItem($table,$id){
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->{$table}->get($id);
        $response = ['message'=>'','saved'=>false];
        if ($this->{$table}->delete($item)) {
            $response['message']='Item borrado correctamente';
            $response['saved']=true;
        } else {
            $response['message']='Item borrado correctamente';
            $response['saved']=false;
        }

        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
  }
  
}
