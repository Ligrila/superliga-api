<?php
namespace App\Controller;


use Cake\Core\Configure;

use App\Controller\AppController;

/**
 * Dates Controller
 *
 * @property \App\Model\Table\DatesTable $Dates
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    public $publicActions = ['view','latest'];
    public function view($slug){
            $post = $this->Posts->findBySlug($slug)->first();
            $this->set(compact('post'));
    }
    public function latest(){

        $post = $this->Posts->find()
        ->where(['created <='=> \Cake\I18n\Time::now()])
        ->order(['created'=>'DESC'])
        ->first();
        $this->set(compact('post'));
        $this->render('view');
    }
}
