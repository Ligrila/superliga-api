<?php
namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * HomeBanners Controller
 *
 * @property \App\Model\Table\HomeBannersTable $HomeBanners
 *
 * @method \App\Model\Entity\HomeBanner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeBannersController extends ApiAppController
{

    public $publicActions = ['index'];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $homeBanners = $this->HomeBanners->find()
        ->where(['start_date <='=> date('Y-m-d')])
        ->where(['end_date >='=> date('Y-m-d')]);

        
        $this->apiResult(true,$homeBanners);
    }

}
