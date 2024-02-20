<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * HomeBanners Controller
 *
 * @property \App\Model\Table\HomeBannersTable $HomeBanners
 *
 * @method \App\Model\Entity\HomeBanner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeBannersController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $homeBanners = $this->paginate($this->HomeBanners);

        $this->set(compact('homeBanners'));
    }

    /**
     * View method
     *
     * @param string|null $id Home Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homeBanner = $this->HomeBanners->get($id, [
            'contain' => []
        ]);

        $this->set('homeBanner', $homeBanner);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homeBanner = $this->HomeBanners->newEmptyEntity();
        if ($this->request->is('post')) {
            $homeBanner = $this->HomeBanners->patchEntity($homeBanner, $this->request->getData());
            if ($this->HomeBanners->save($homeBanner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $actions = $this->HomeBanners->actions();
        $actionTargets = $this->HomeBanners->actionsTargets();
        $this->set(compact('homeBanner','actions','actionTargets'));
    }


    public function changePicture($id = null)
    {
        $homeBanner = $this->HomeBanners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeBanner = $this->HomeBanners->patchEntity($homeBanner, $this->request->getData());
            if ($this->HomeBanners->save($homeBanner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('homeBanner'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Home Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homeBanner = $this->HomeBanners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeBanner = $this->HomeBanners->patchEntity($homeBanner, $this->request->getData());
            if ($this->HomeBanners->save($homeBanner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('homeBanner'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Home Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homeBanner = $this->HomeBanners->get($id);
        if ($this->HomeBanners->delete($homeBanner)) {
            $this->Flash->success(__('The home banner has been deleted.'));
        } else {
            $this->Flash->error(__('The home banner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
