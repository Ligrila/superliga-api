<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactTopics Model
 *
 * @property \App\Model\Table\ContactsTable|\Cake\ORM\Association\HasMany $Contacts
 *
 * @method \App\Model\Entity\ContactTopic get($primaryKey, $options = [])
 * @method \App\Model\Entity\ContactTopic newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ContactTopic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactTopic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactTopic|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ContactTopic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ContactTopic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactTopic findOrCreate($search, callable $callback = null, $options = [])
 */
class ContactTopicsTable extends Table
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

        $this->setTable('contact_topics');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Contacts', [
            'foreignKey' => 'contact_topic_id'
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
            ->scalar('name')
            ->allowEmptyString('name');

        return $validator;
    }
}
