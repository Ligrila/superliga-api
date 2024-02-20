<?php

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\AnswersTable|\Cake\ORM\Association\HasMany $Answers
 * @property |\Cake\ORM\Association\HasMany $AuthToken
 * @property |\Cake\ORM\Association\HasMany $CorrectAnswers
 * @property \App\Model\Table\LifeTable|\Cake\ORM\Association\HasMany $Life
 * @property |\Cake\ORM\Association\HasMany $Lives
 * @property \App\Model\Table\PointsTable|\Cake\ORM\Association\HasMany $Points
 * @property \App\Model\Table\ProcessedAnswersTable|\Cake\ORM\Association\HasMany $ProcessedAnswers
 * @property |\Cake\ORM\Association\HasMany $WrongAnswers
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Answers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('AuthToken', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('CorrectAnswers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('InfiniteLives', [
            'foreignKey' => 'user_id',
            'conditions' => ['DATE(InfiniteLives.until) >=' => \Cake\I18n\Time::now()->format('Y-m-d')]
        ]);
        $this->hasOne('Life', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Lives', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('Points', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('PlayedGames', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('ProcessedAnswers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('WrongAnswers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'user_id'
        ]);

        $this->addBehavior('S3',[
            'fields'=> ['picture']
        ]);

        $this->addBehavior('Muffin/Slug.Slug', [
            // Optionally define your custom options here (see Configuration)
            'field' => 'username',
            'displayField' => ['first_name', 'last_name'],
            'unique' => true,
        ]);
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->select(['id', 'email', 'username', 'password'])
            ->where(['Users.enabled' => 1])
            ->where(['Users.email_verified' => 1]);

        return $query;
    }

    public function points($user_id)
    {
        $connection = ConnectionManager::get('default');

        return $connection->query("
            SELECT
                t.user_id,
                t.points
                FROM ( SELECT sum(u.points) AS points,
                            u.user_id
                        FROM ( SELECT correct_answers.user_id,
                                    correct_answers.points
                                FROM correct_answers
                                UNION ALL
                                SELECT orders.user_id,
                                    orders.points
                                FROM orders) u
                        GROUP BY u.user_id) t
                WHERE user_id= '$user_id'
        ")->fetch('assoc');
    }

    public function life($user_id)
    {
        $connection = ConnectionManager::get('default');

        return $connection->query("
            SELECT
                lives.user_id, (SUM(lives.lives) - COALESCE(losed_lives.lives,0)) as lives
                    FROM lives
                    LEFT JOIN
                    (
                        SELECT SUM(wrong_answers.lives) as lives, wrong_answers.user_id
                        from wrong_answers
                        GROUP BY wrong_answers.user_id
                    ) as losed_lives ON losed_lives.user_id = lives.user_id
                    where lives.user_id= '$user_id'
                    GROUP BY lives.user_id, losed_lives.lives ;
        ")->fetch('assoc');
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->scalar('first_name')
            ->requirePresence('first_name', 'create')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        /*$validator
            ->numeric('document')
            ->requirePresence('document', 'create')
            ->minLength('document', 8)
            ->notEmptyString('document');*/

        $validator
            ->scalar('mobile_number')
            ->requirePresence('mobile_number', 'create')
            ->maxLength('mobile_number', 255)
            ->notEmptyString('mobile_number');

        $validator
            ->scalar('last_name')
            ->requirePresence('last_name', 'create')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->allowEmptyString('picture');

        $validator
            ->allowEmptyString('picture_dir');

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
        $rules->add($rules->isUnique(['email']));
        //$rules->add($rules->isUnique(['document']));


        return $rules;
    }

    public function afterSave(\Cake\Event\EventInterface $event, $entity, $options)
    {
        if ($entity->isNew()) {
            //
            $live = $this->Lives->newEmptyEntity();
            $live->user_id = $entity->id;
            $live->comments = 'INIT';
            $live->lives = 70; // vidas iniciales
            $this->Lives->save($live);

            //crear vidas infinitas desde que se recibe el pago a un mes
            $infiniteLivesModel = \Cake\ORM\TableRegistry::get('InfiniteLives');
            $infiniteLivesEntity = $infiniteLivesModel->newEmptyEntity();
            $infiniteLivesEntity->user_id = $entity->id;
            $infiniteLivesEntity->payment_id = null;
            $infiniteLivesEntity->until = new \Cake\I18n\Time("+1 month");
            $infiniteLivesModel->save($infiniteLivesEntity);
        }
    }
}
