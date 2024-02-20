<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

use App\Controller\AppController;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 *
 * @method \App\Model\Entity\Team[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeamsController extends ApiAppController
{

    public $publicActions = ['index','avatar'];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $teams = $this->Teams->find();
        $this->apiResult(true,$teams);
    }


    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $team = $this->Teams->get($id, [
            'contain' => []
        ]);

        $this->set('team', $team);
    }


}
