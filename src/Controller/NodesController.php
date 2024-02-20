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
class NodesController extends AppController
{
    public $publicActions = ['view'];
    public function view($slug){
            $node = $this->Nodes->findBySlug($slug)->first();
            $this->set(compact('node'));
    }
}
