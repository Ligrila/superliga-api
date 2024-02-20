<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlayedGames Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PlayedGame get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlayedGame newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlayedGame[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlayedGame|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlayedGame|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlayedGame patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlayedGame[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlayedGame findOrCreate($search, callable $callback = null, $options = [])
 */
class PlayedGamesTable extends Table
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

        $schema = new \Cake\Database\Schema\TableSchema('played_games');
        $schema
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('count', ['type' => 'integer']);
        $this->setSchema($schema);

        $this->setTable('played_games');

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
            ->requirePresence('count', 'create')
            ->notEmptyString('count');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
