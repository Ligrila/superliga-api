<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChampionshipUsers Model
 *
 * @property \App\Model\Table\ChampionshipsTable|\Cake\ORM\Association\BelongsTo $Championships
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ChampionshipUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChampionshipUser newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChampionshipUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChampionshipUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChampionshipUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChampionshipUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChampionshipUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChampionshipUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChampionshipUsersTable extends Table
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

        $this->setTable('championship_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Championships', [
            'foreignKey' => 'championship_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('CounterCache', [
            'Championships' => [
                'users_count' => [
                    'conditions' => ['ChampionshipUsers.enabled' => true]

                ]
            ]
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
        $rules->add($rules->existsIn(['championship_id'], 'Championships'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }


}

