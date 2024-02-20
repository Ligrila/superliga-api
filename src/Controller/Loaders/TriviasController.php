<?php
namespace App\Controller\Loaders;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Trivias Controller
 *
 * @property \App\Model\Table\TriviasTable $Trivias
 *
 * @method \App\Model\Entity\Trivia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TriviasController extends LoadersAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public $paginate = [
        'order' => [
            'Trivias.start_datetime' => 'asc'
        ]
    ];
    public function index($type='normal')
    {
        $this->paginate = [
            'contain' => ['LocalTeams', 'VisitTeams','Dates'],
            'order' => [
                'Trivias.start_datetime' => 'asc'
            ]
        ];
        $query = $this->Trivias->find();
        if($type){
            $query->where(['type'=>$type]);
        }
        $trivias = $this->paginate($query);


        $this->set(compact('trivias','type'));
    }

    /**
     * View method
     *
     * @param string|null $id Trivia id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function winners($id = null)
    {
        $trivia = $this->Trivias->get($id, [
            'contain' => ['LocalTeams', 'VisitTeams', 'Dates']
        ]);

        $triviaPoints =
            \Cake\ORM\TableRegistry::get('TriviaPoints')
                ->find()
                ->where(['trivia_id'=>$id])
                ->contain(['Users'])
                ->order(['position'=>'ASC'])
                ->limit(10);

        $this->set('trivia', $trivia);
        $this->set('triviaPoints', $triviaPoints);

    }
    public function startTrivia($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->start($id);

        if ($saved) {
            $this->Flash->success(__('La trivia fue guardada correctamente.'));
        } else{
            $this->Flash->error(__('La trivia no pudo ser guardada. Por favor, intente nuevamente.'));
        }
        $this->redirect($this->referer());
    }

    public function finishHalfTime($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->finishHalfTime($id);

        if ($saved) {
            $this->Flash->success(__('El primer tiempo fue finalizado correctamente.'));
        } else{
            $this->Flash->error(__('El primer tiempo no pudo ser finalizado. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }

    public function startHalfTime($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->startHalfTime($id);

        if ($saved) {
            $this->Flash->success(__('El segundo tiempo fue iniciado correctamente.'));
        } else{
            $this->Flash->error(__('El segundo tiempo no pudo ser iniciado. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }
    public function startHalfTimePlay($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->startHalfTimePlay($id);

        if ($saved) {
            $this->Flash->success(__('La jugada de entretiempo fue enviada correctamenta.'));
        } else{
            $this->Flash->error(__('La jugada de entretiempo no pudo ser enviada. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }

    public function startExtraPlay($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->startExtraPlay($id);

        if ($saved) {
            $this->Flash->success(__('La jugada extra fue enviada correctamenta.'));
        } else{
            $this->Flash->error(__('La jugada extra no pudo ser enviada. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }

    public function finishGame($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->finishGame($id);

        if ($saved) {
            $this->Flash->success(__('El segundo tiempo fue finalizado correctamente.'));
        } else{
            $this->Flash->error(__('El segundo tiempo no pudo ser finalizado. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }

    public function finishTrivia($id){
        $this->request->allowMethod(['post','put']);
        $saved = $this->Trivias->finish($id);

        if ($saved) {
            $this->Flash->success(__('La trivia fue finalizada correctamente.'));
        } else{
            $this->Flash->error(__('La trivia no pudo ser finalizada. Por favor, intente nuevamente. Compruebe que no haya una pregunta sin finalizar'));
        }
        $this->redirect($this->referer());
    }

    public function nextTrivia(){
        $trivia = $this->Trivias->find()
            ->where(['Trivias.in_progress'=> false])
            ->where(['Trivias.finished'=> false])
            ->where(['Trivias.start_datetime >='=> \Cake\I18n\Time::now() ])
            ->contain(['LocalTeams','VisitTeams'])
            ->order(['Trivias.start_datetime'=>'ASC'])
            ->first();


            $this->set(compact('trivia'));
    }
    public function current()
    {
        $trivia = $this->Trivias->find()
            ->where(['Trivias.in_progress'=> true])
            ->where(['Trivias.finished'=> false])
            ->contain(['LocalTeams','VisitTeams'])
            ->first();

        if(empty($trivia)){
            $this->nextTrivia();
            $this->render('nextTrivia');
            return;
        }
        $genericQuestion = $question = null;
         if(!empty($trivia)){
            $question = $this->Trivias->Questions->find()
            ->where(['finished'=>false])
            ->where(['trivia_id'=>$trivia->id])
            ->contain(['Teams'])
            ->first();
            if($question&&$question->model=='GenericQuestions'){
                $genericQuestion = \Cake\ORM\TableRegistry::get('GenericQuestions')->get($question->foreign_key);
            }
        }




        $this->set(compact('trivia','question','genericQuestion'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addTrivia()
    {
        $trivia = $this->Trivias->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $trivia = $this->Trivias->patchEntity($trivia, $data);

            //$data['date_id'] = $this->Trivias->assignDate($trivia);
            //$trivia = $this->Trivias->patchEntity($trivia, $data);

            if ($this->Trivias->save($trivia)) {
                $this->Flash->success(__('La trivia fue guardada correctamente'));

                return $this->redirect(['action' => 'index','trivia']);
            }
            $this->Flash->error(__('La trivia no pudo ser guardada. Por favor, intenta nuevamente.'));
        }
        $dates = $this->Trivias->Dates->find('list');
        $this->set(compact('trivia', 'localTeams', 'visitTeams','dates'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trivia = $this->Trivias->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $trivia = $this->Trivias->patchEntity($trivia, $data);
            //$data['date_id'] = $this->Trivias->assignDate($trivia);
            //$trivia = $this->Trivias->patchEntity($trivia, $data);

            if ($this->Trivias->save($trivia)) {
                $this->Flash->success(__('La trivia fue guardada correctamente'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La trivia no pudo ser guardada. Por favor, intenta nuevamente.'));
        }
        $localTeams = $this->Trivias->LocalTeams->find('list');
        $visitTeams = $this->Trivias->VisitTeams->find('list');
        $dates = $this->Trivias->Dates->find('list');
        $this->set(compact('trivia', 'localTeams', 'visitTeams','dates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Trivia id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trivia = $this->Trivias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trivia = $this->Trivias->patchEntity($trivia, $this->request->getData());
            //$trivia = $this->Trivias->assignDate($trivia);
            if ($this->Trivias->save($trivia)) {
                $this->Flash->success(__('La trivia fue guardada correctamente'));

                return $this->redirect(['action' => 'index',$trivia->type]);
            }
            $this->Flash->error(__('La trivia no pudo ser guardada. Por favor, intenta nuevamente.'));
        }
        $localTeams = $this->Trivias->LocalTeams->find('list');
        $visitTeams = $this->Trivias->VisitTeams->find('list');
        $dates = $this->Trivias->Dates->find('list');
        $this->set(compact('trivia', 'localTeams', 'visitTeams','dates'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Trivia id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trivia = $this->Trivias->get($id);
        if ($this->Trivias->delete($trivia)) {
            $this->Flash->success(__('The trivia has been deleted.'));
        } else {
            $this->Flash->error(__('The trivia could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function currentGameStatus(){

    }

    public function refreshCacheTable(){

        $connection = ConnectionManager::get('default');
        try{
            $connection->query("REFRESH MATERIALIZED VIEW trivia_points;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW played_games;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW trivia_statistics")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW trivia_user_statistics")->execute();

        } catch(\Exception $e){
            debug($e);
        }

        $this->redirect($this->referer());
    }
}
