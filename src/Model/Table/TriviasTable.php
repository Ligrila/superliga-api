<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

// use Websocket\Lib\Websocket;
use Cake\Datasource\ConnectionManager;

use Ligrila\Lib\Websocket;


/**
 * Trivias Model
 *
 * @property \App\Model\Table\LocalClubsTable|\Cake\ORM\Association\BelongsTo $LocalClubs
 * @property \App\Model\Table\VisitClubsTable|\Cake\ORM\Association\BelongsTo $VisitClubs
 * @property \App\Model\Table\ProcessedAnswersTable|\Cake\ORM\Association\HasMany $ProcessedAnswers
 * @property \App\Model\Table\QuestionsTable|\Cake\ORM\Association\HasMany $Questions
 *
 * @method \App\Model\Entity\Trivia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Trivia newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Trivia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Trivia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Trivia|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Trivia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Trivia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Trivia findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TriviasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('trivias');
        $this->setDisplayField('fullTitle');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('LocalTeams', [
            'foreignKey' => 'local_team_id',
            'className' => 'Teams',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('VisitTeams', [
            'foreignKey' => 'visit_team_id',
            'className' => 'Teams',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Dates', [
            'foreignKey' => 'date_id',
            'className' => 'Dates',
            'joinType' => 'LEFT'
        ]);


        $this->hasMany('ProcessedAnswers', [
            'foreignKey' => 'trivia_id'
        ]);
        $this->hasMany('Questions', [
            'foreignKey' => 'trivia_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->dateTime('start_datetime')
            ->requirePresence('start_datetime', 'create')
            ->notEmptyString('start_datetime');

        $validator
            ->requirePresence('date_id','create')
            ->allowEmptyString('date_id');

            $validator
            ->add('in_progress', 'avoidMultipleTriviaStarted', [
                'rule' => 'avoidMultipleTriviaStarted',
                'message' => __('No puede haber dos trivias al mismo tiempo'),
                'last' => true,
                'provider' => 'table'
            ]);


        return $validator;
    }


    public function avoidMultipleTriviaStarted($value, array $context){
        if($value){
            // quiere empezar una trivia
            //  in_progress => true
            $trivia = $this->
                find()
                    ->where(['in_progress'=>true])
                    ->where(['finished'=>false])
                    ->first();
            return empty($trivia);
        }
        return true;
    }


    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): \Cake\ORM\RulesChecker
    {
        $rules->add($rules->existsIn(['date_id'], 'Dates'));
        $rules->add($rules->existsIn(['local_team_id'], 'LocalTeams'));
        $rules->add($rules->existsIn(['visit_team_id'], 'VisitTeams'));

        return $rules;
    }

    public function assignDate($trivia){

        $query = $this->Dates
            ->find()
            ->where(['from_date <='=>$trivia->start_datetime])
            ->where(['to_date >='=>$trivia->start_datetime])
            ->first();

        if(empty($query)){
            return false;
        }

        return $query->id;


    }
    public function afterSave(\Cake\Event\EventInterface $event,  $entity, $options){
        if($entity->isNew()){
            //Websocket::publishEvent('newTrivia', [$entity]);
        }
    }

    public function startTimedOutTrivia($type='normal'){
        $trivia = $this
        ->find()
        ->where(function($exp) {
            // le damos un periodo desde ahora hasta 15 minutos pasada la fecha de comienzo
            return $exp->between('start_datetime', new \DateTime('-15 minutes'),new \DateTime('now') , 'datetime');
        })
        ->where(['Trivias.finished'=>false])
        ->where(['Trivias.enabled'=>true])
        ->where(['Trivias.in_progress'=>false])
        ->where(['Trivias.type'=>$type])
        ->contain(['LocalTeams','VisitTeams'])
        ->first();

        $saved = false;
        if(!$trivia){
            return compact('saved','trivia');
        }
        $saved = $this->start($trivia);
        return compact('saved','trivia');
    }

    public function getNextSoonTrivia(){
        $trivia = $this
        ->find()
        ->where(function($exp) {
            // le damos un periodo desde -5 minutos a ahora, ya que en ahora ya empezo
            return $exp->between('start_datetime',  new \DateTime('now'),new \DateTime('+1 hour'), 'datetime');
        })
        ->where(['Trivias.finished'=>false])
        ->where(['Trivias.enabled'=>true])
        ->where(['Trivias.notified'=>false])
        ->where(['Trivias.in_progress'=>false])
        ->contain(['LocalTeams','VisitTeams'])
        ->first();

        return $trivia;
    }

    public function getAboutToStartTrivia(){
        $trivia = $this
        ->find()
        ->where(function($exp) {
            // le damos un periodo desde -5 minutos a ahora, ya que en ahora ya empezo
            return $exp->between('start_datetime',  new \DateTime('now'),new \DateTime('+15 minutes'), 'datetime');
        })
        ->where(['Trivias.finished'=>false])
        ->where(['Trivias.enabled'=>true])
        ->where(['Trivias.notified'=>true])
        ->where(['Trivias.notified2'=>false])
        ->where(['Trivias.in_progress'=>false])
        ->contain(['LocalTeams','VisitTeams'])
        ->first();

        return $trivia;
    }

    public function start($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id,
                ['contain' => ['LocalTeams','VisitTeams']]
            );
        }
        if(!$trivia->enabled){
            return false;
        }
        // usamos patch entity porque tenemos que validar que
        // no haya una trivia en curso
        $this->patchEntity($trivia,[
            'in_progress' => true,
            'finished' => false,
        ]);

        $saved = $this->save($trivia);
        if($saved){
            Websocket::publishEvent('startTrivia', $trivia->toArray());
        }
        return $saved;
    }

    public function finish($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }

        $hasQuestion = $this->Questions->find()
            ->where(['Questions.trivia_id'=>$id,'Questions.finished'=>false])
            ->first();
        if($hasQuestion){
            return false;
        }



        $connection = ConnectionManager::get('default');
        try{
            // check one by one what is necesary here for statistics at the end of the game.
            $connection->query("REFRESH MATERIALIZED VIEW trivia_points;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW played_games;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW trivia_statistics")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW trivia_user_statistics")->execute();

        } catch(\Exception $e){
            debug($e);
        }

        // usamos patch entity porque tenemos que validar

        $this->patchEntity($trivia,[
            'in_progress' => false,
            'finished' => true,
        ]);

        $saved = $this->save($trivia);

        if($saved){
            Websocket::publishEvent('finishTrivia', $trivia->toArray());
        }
        return $saved;
    }

    public function finishHalfTime($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }

        $hasQuestion = $this->Questions->find()
            ->where(['Questions.trivia_id'=>$id,'Questions.finished'=>false])
            ->first();
        if($hasQuestion){
            return false;
        }

        // usamos patch entity porque tenemos que validar

        $this->patchEntity($trivia,[
            'half_time_finished' => true,
        ]);

        $saved = $this->save($trivia);

        if($saved){
            Websocket::publishEvent('finishHalfTime', $trivia->toArray());
        }
        return $saved;
    }

    public function startHalfTime($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }
        // usamos patch entity porque tenemos que validar

        $this->patchEntity($trivia,[
            'half_time_finished' => true,
            'half_time_started' => true,
        ]);

        $saved = $this->save($trivia);

        if($saved){
            Websocket::publishEvent('startHalfTime', $trivia->toArray());
        }
        return $saved;
    }

    public function startHalfTimePlay($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }
        // usamos patch entity porque tenemos que validar

        Websocket::publishEvent('startHalfTimePlay', $trivia->toArray());

        return true;
    }

    public function startExtraPlay($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }
        // usamos patch entity porque tenemos que validar

        Websocket::publishEvent('startExtraPlay', $trivia->toArray());

        return true;
    }

    public function showBanner($payload){


        Websocket::publishEvent('showBanner', $payload);

        return true;
    }

    public function finishGame($id){
        if(is_object($id)){
            $trivia = $id;
        } else{
            $trivia = $this->get($id);
        }
        // usamos patch entity porque tenemos que validar

        $this->patchEntity($trivia,[
            'half_time_finished' => true,
            'half_time_started' => true,
            'game_finished' => true,
        ]);

        $saved = $this->save($trivia);

        if($saved){
            Websocket::publishEvent('finishGame', $trivia->toArray());
        }
        return $saved;
    }

}
