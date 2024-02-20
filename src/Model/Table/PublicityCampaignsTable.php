<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PublicityCampaigns Model
 *
 * @property \App\Model\Table\TriviasTable|\Cake\ORM\Association\BelongsTo $Trivias
 * @property \App\Model\Table\BannersTable|\Cake\ORM\Association\BelongsTo $Banners
 *
 * @method \App\Model\Entity\PublicityCampaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\PublicityCampaign newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PublicityCampaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PublicityCampaign|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PublicityCampaign|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PublicityCampaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PublicityCampaign[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PublicityCampaign findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PublicityCampaignsTable extends Table
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

        $this->setTable('publicity_campaigns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id'
        ]);
        $this->belongsTo('Banners', [
            'foreignKey' => 'banner_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('model')
            ->maxLength('model', 50)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        $validator
            ->integer('model_value')
            ->allowEmptyString('model_value');

        $validator
            ->scalar('model_used_value')
            ->allowEmptyString('model_used_value');

        $validator
            ->boolean('enabled')
            ->allowEmptyString('enabled');

        return $validator;
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
        $rules->add($rules->existsIn(['trivia_id'], 'Trivias'));
        $rules->add($rules->existsIn(['banner_id'], 'Banners'));

        return $rules;
    }


    public function getOne($trivia_id){
        //TODO trivia_id se usa tambien para ver si en la ultima pregunta se uso banner
        // para tener control cada cuantas preguntas se envia uno.
        // si es cada dos se hace query de la ultima, si la ultima tuvo, no se envia, si no tuvo se envia.
        //
        //   questions {
        //       1 { publicity_campaing : id }
        //       2 { publicity_campaing : null }
        //       3 { publicity_campaing : id }
        // }
        //
        // id puede usarse para alternar
        //  where(id not 1->id ) para la 3
        // TODO crear field publicity_campaing en QuestionsTable o crear tabla
        // publicity_campaing_histories {publicity_campaing_id,trivia_id,question_id}
        // donde publicity_campaing_id puede ser NULL

        $lastQuestions = \Cake\ORM\TableRegistry::get('Questions')
            ->find()
            ->where(['trivia_id'=>$trivia_id])
            ->order(['created'=>'DESC'])
            ->limit(2)->toArray();
        if(empty($lastQuestions[1])){
            return false;
        }
        $lastQuestion = $lastQuestions[1];

        $mustShow = empty($lastQuestion) ? true : !((bool) $lastQuestion->publicity_campaign_id);

        if(!$mustShow){
            return false;
        }

        $conditions = [
            'model' => 'questions',
            'model_value > model_used_value'
        ];
        $conditions2 = [
            'model' => 'trivias',
            'trivia_id' => $trivia_id,
            'model_value > model_used_value'
        ];

        $data = $this->find()
            ->where($conditions,['OR'=> $conditions2 ])
            ->contain(['Banners'])
            ->order('random()')
            ->first();
        if(empty($data)){
            return false;
        }
        $data->model_used_value++;

        $this->save($data);

        return $data;
    }
}
