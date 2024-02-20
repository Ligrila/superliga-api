<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;


/**
 * Lives Controller
 *
 * @property \App\Model\Table\LivesTable $Lives
 *
 * @method \App\Model\Entity\Life[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LivesController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $lives = $this->paginate($this->Lives);

        $this->set(compact('lives'));
    }

    /**
     * View method
     *
     * @param string|null $id Life id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $life = $this->Lives->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('life', $life);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id)
    {
        $life = $this->Lives->newEmptyEntity();
        $user = $this->Lives->Users->get($user_id);
        $life->user_id = $user_id;

        if ($this->request->is('post')) {
            $life = $this->Lives->patchEntity($life, $this->request->getData());
            if ($this->Lives->save($life)) {
                $connection = ConnectionManager::get('default');
                $connection->query("REFRESH MATERIALIZED VIEW life;")->execute();
                $this->Flash->success(__('La vida fue guardada correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La vida no pudo ser guardada. Por favor, intente nuevamente.'));
        }

        $this->set(compact('life', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Life id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $life = $this->Lives->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $life = $this->Lives->patchEntity($life, $this->request->getData());
            if ($this->Lives->save($life)) {
                $connection = ConnectionManager::get('default');
                $connection->query("REFRESH MATERIALIZED VIEW life;")->execute();
                $this->Flash->success(__('La vida fue guardada correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La vida no pudo ser guardada. Por favor, intente nuevamente.'));
        }

        $this->set(compact('life'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Life id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $life = $this->Lives->get($id);
        if ($this->Lives->delete($life)) {
            $this->Flash->success(__('The life has been deleted.'));
        } else {
            $this->Flash->error(__('The life could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
