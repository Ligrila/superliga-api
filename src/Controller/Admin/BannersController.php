<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Banners Controller
 *
 * @property \App\Model\Table\BannersTable $Banners
 *
 * @method \App\Model\Entity\HomeBanner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BannersController extends AdminAppController
{


    public function sendToApp($trivia_id){
        if($this->request->is('ajax')){
            $this->viewBuilder()->setLayout('ajax');
        }
        $banners = $this->Banners->find();
        $this->set(compact('banners','trivia_id'));
    }
    public function sendBannerToApp($id,$trivia_id){
        $data = $this->Banners->get($id);
        $this->loadModel('Trivias');
        $bannerUri = $data->banner;
        $bannerType = 'image';

        $saved = $this->Trivias->showBanner(compact('trivia_id','bannerUri','bannerType','data'));
        if ($saved) {
            $this->Flash->success(__('El banner fue mostrado correctamaente'));
        } else{
            $this->Flash->error(__('La banner no pudo ser enviado. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());

    }
    public function sendAdmobBannerToApp($trivia_id){
        $this->loadModel('Trivias');
        $saved = $this->Trivias->showBanner(['trivia_id'=>$trivia_id,'bannerType'=>'admob']);
        if ($saved) {
            $this->Flash->success(__('El banner fue mostrado correctamaente'));
        } else{
            $this->Flash->error(__('La banner no pudo ser enviado. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $banners = $this->paginate($this->Banners);

        $this->set(compact('banners'));
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
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);

        $this->redirect($banner->banner);
        return;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banner = $this->Banners->newEmptyEntity();
        if ($this->request->is('post')) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $actions = $this->Banners->actions();
        $actionTargets = $this->Banners->actionsTargets();
        $this->set(compact('banner','actions','actionTargets'));
    }


    public function changePicture($id = null)
    {
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('banner'));
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
        $banner = $this->Banners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banners->patchEntity($banner, $this->request->getData());
            if ($this->Banners->save($banner)) {
                $this->Flash->success(__('El banner fue guardado correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El banner no pudo ser guardado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('banner'));
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
        $banner = $this->Banners->get($id);
        if ($this->Banners->delete($banner)) {
            $this->Flash->success(__('The home banner has been deleted.'));
        } else {
            $this->Flash->error(__('The home banner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
