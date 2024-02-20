<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * LivePacks Controller
 *
 * @property \App\Model\Table\LivePacksTable $LivePacks
 *
 * @method \App\Model\Entity\LivePack[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LivePacksController extends ApiAppController
{

 //   public $publicActions = ['index'];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $livePacks = $this->LivePacks->find();

        $this->apiResult(true,$livePacks);
    }

}
