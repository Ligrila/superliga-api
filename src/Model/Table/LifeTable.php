<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Life Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Life get($primaryKey, $options = [])
 * @method \App\Model\Entity\Life newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Life[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Life|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Life|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Life patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Life[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Life findOrCreate($search, callable $callback = null, $options = [])
 */
class LifeTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {

        parent::initialize($config );

        $schema = new \Cake\Database\Schema\TableSchema('life');
        $schema
            ->addColumn('user_id', ['type' => 'uuid'])
            ->addColumn('lives', ['type' => 'integer' ]);
        $this->setSchema($schema);


        $this->setTable('life');

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

        return $rules;
    }


}
