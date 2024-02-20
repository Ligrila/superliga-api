<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Challenges Model
 *
 * @property \App\Model\Table\Championship1sTable|\Cake\ORM\Association\BelongsTo $Championship1s
 * @property \App\Model\Table\Championship2sTable|\Cake\ORM\Association\BelongsTo $Championship2s
 * @property \App\Model\Table\User1sTable|\Cake\ORM\Association\BelongsTo $User1s
 * @property \App\Model\Table\User2sTable|\Cake\ORM\Association\BelongsTo $User2s
 *
 * @method \App\Model\Entity\Challenge get($primaryKey, $options = [])
 * @method \App\Model\Entity\Challenge newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Challenge[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Challenge|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Challenge|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Challenge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Challenge[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Challenge findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChallengesTable extends Table
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

        $this->setTable('challenges');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Championship1s', [
            'foreignKey' => 'championship1_id',
            'className' => 'Championships'
        ]);
        $this->belongsTo('Championship2s', [
            'foreignKey' => 'championship2_id',
            'className' => 'Championships'
        ]);
        $this->belongsTo('User1s', [
            'foreignKey' => 'user1_id',
            'className' => 'Users'
        ]);
        $this->belongsTo('User2s', [
            'foreignKey' => 'user2_id',
            'className' => 'Users'
        ]);

        $this->hasMany('ChallengeRequests');
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
        $rules->add($rules->existsIn(['championship1_id'], 'Championship1s'));
        $rules->add($rules->existsIn(['championship2_id'], 'Championship2s'));
        $rules->add($rules->existsIn(['user1_id'], 'User1s'));
        $rules->add($rules->existsIn(['user2_id'], 'User2s'));

        return $rules;
    }
}
