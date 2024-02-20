<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * PublicityCampaigns Controller
 *
 * @property \App\Model\Table\PublicityCampaignsTable $PublicityCampaigns
 *
 * @method \App\Model\Entity\PublicityCampaign[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicityCampaignsController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trivias', 'Banners']
        ];
        $publicityCampaigns = $this->paginate($this->PublicityCampaigns);

        $this->set(compact('publicityCampaigns'));
    }

    /**
     * View method
     *
     * @param string|null $id Publicity Campaign id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $publicityCampaign = $this->PublicityCampaigns->get($id, [
            'contain' => ['Trivias', 'Banners']
        ]);

        $this->redirect(['controller'=>'banners','action'=>'view',$publicityCampaign->banner_id]);
        return;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $publicityCampaign = $this->PublicityCampaigns->newEmptyEntity();
        if ($this->request->is('post')) {
            $publicityCampaign = $this->PublicityCampaigns->patchEntity($publicityCampaign, $this->request->getData());
            if ($this->PublicityCampaigns->save($publicityCampaign)) {
                $this->Flash->success(__('The publicity campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The publicity campaign could not be saved. Please, try again.'));
        }
        $trivias = $this->PublicityCampaigns->Trivias->find('list', ['limit' => 200])->order(['start_datetime'=>'DESC']);;
        $banners = $this->PublicityCampaigns->Banners->find('list', ['limit' => 200]);
        $this->set(compact('publicityCampaign', 'trivias', 'banners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Publicity Campaign id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $publicityCampaign = $this->PublicityCampaigns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $publicityCampaign = $this->PublicityCampaigns->patchEntity($publicityCampaign, $this->request->getData());
            if ($this->PublicityCampaigns->save($publicityCampaign)) {
                $this->Flash->success(__('The publicity campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The publicity campaign could not be saved. Please, try again.'));
        }
        $trivias = $this->PublicityCampaigns->Trivias->find('list', ['limit' => 200])->order(['start_datetime'=>'DESC']);
        $banners = $this->PublicityCampaigns->Banners->find('list', ['limit' => 200]);
        $this->set(compact('publicityCampaign', 'trivias', 'banners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Publicity Campaign id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $publicityCampaign = $this->PublicityCampaigns->get($id);
        if ($this->PublicityCampaigns->delete($publicityCampaign)) {
            $this->Flash->success(__('The publicity campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The publicity campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
