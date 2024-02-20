<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * Awards Controller
 *
 * @property \App\Model\Table\AwardsTable $Awards
 *
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends ApiAppController
{

    public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        $saved = false;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('sub');
            $contact = $this->Contacts->patchEntity($contact, $data);

            $saved = $this->Contacts->save($contact);

            if(!$saved){
                $contact = $contact->errors();
            }


        }

        $this->apiResult($saved,$contact);
    }

    function topics(){
        $topics = $this->Contacts->ContactTopics->find();

        $this->apiResult(true,$topics);

    }




}
