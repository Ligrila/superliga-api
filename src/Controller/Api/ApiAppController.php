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
namespace App\Controller\Api;

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
class ApiAppController extends Controller
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
        parent::initialize();


        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'storage' => 'Memory',
            'authenticate' => [
                'Form' => [
                    //'finder' => 'auth',
                    'fields' => ['username' => 'email', 'password' => 'password']
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'userModel' => 'Users',
                    'fields' => [
                        'username' => 'id'
                    ],

                    'parameter' => 'token',

                    // Boolean indicating whether the "sub" claim of JWT payload
                    // should be used to query the Users model and get user info.
                    // If set to `false` JWT's payload is directly returned.
                    'queryDatasource' => false,
                ]
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
        $this->RequestHandler->prefers('json');
    }

    protected function apiResult($success,$data){
        $success = boolval($success);
        $this->set(compact('success','data'));
        //$this->set('_serialize', ['success','data']);
        $this->viewBuilder()->setOption('serialize', ['success','data']);
    }

     /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(\Cake\Event\EventInterface $event)
    {

        $this->RequestHandler->respondAs('json');
        $this->RequestHandler->renderAs($this,'json');

        /*if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }*/
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
