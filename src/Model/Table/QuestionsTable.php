<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ligrila\Lib\Websocket;
use Cake\Datasource\ConnectionManager;


/**
 * Questions Model
 *
 * @property \App\Model\Table\TriviasTable|\Cake\ORM\Association\BelongsTo $Trivias
 * @property \App\Model\Table\AnswersTable|\Cake\ORM\Association\HasMany $Answers
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionsTable extends Table
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

        $this->setTable('questions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Trivias', [
            'foreignKey' => 'trivia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Answers', [
            'foreignKey' => 'question_id'
        ]);
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'position', // Field to use to store integer sequence. Default "position".
            'scope' => ['trivia_id'], // Array of field names to use for grouping records. Default [].
            'start' => 1, // Initial value for sequence. Default 1.
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
            ->scalar('question')
            ->maxLength('question', 500)
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('option_1')
            ->maxLength('option_1', 255)
            ->requirePresence('option_1', 'create')
            ->notEmptyString('option_1');

        $validator
            ->scalar('option_2')
            ->maxLength('option_2', 255)
            ->requirePresence('option_2', 'create')
            ->notEmptyString('option_2');

        $validator
            ->scalar('option_3')
            ->maxLength('option_3', 255)
            ->requirePresence('option_3', 'create')
            ->notEmptyString('option_3');

        $validator
            ->scalar('correct_option')
            ->allowEmptyString('correct_option');

        $validator
            ->boolean('finished')
            ->requirePresence('finished', 'create')
            ->notEmptyString('finished');

        $validator
            ->dateTime('finished_datetime')
            ->allowEmptyString('finished_datetime');

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
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        // Add a rule for create.
        $rules->addCreate(function ($entity, $options) {
            // Return a boolean to indicate pass/failure
            $trivia_id = $entity->trivia_id;
            $currentQuestion = $this->find()
                ->where(['trivia_id' => $trivia_id])
                ->where(['finished' => false])
                ->first();
            return empty($currentQuestion);
        }, 'notFinished');


        return $rules;
    }


    //
    public function add($trivia_id, $team_id, $question_template_id)
    {
        $template = \Cake\ORM\TableRegistry::get('QuestionTemplates')->get($question_template_id);
        $team = \Cake\ORM\TableRegistry::get('Teams')->get($team_id);
        $trivia = \Cake\ORM\TableRegistry::get('Trivias')->get($trivia_id);

        $question = $this->newEmptyEntity();
        $question->trivia_id = $trivia_id;
        $question->team_id = $team_id;
        $question->question = __($template->question, $team->name);
        $question->option_1 = $template->option_1;
        $question->option_2 = $template->option_2;
        $question->option_3 = $template->option_3;
        $question->model = 'QuestionTemplates';
        $question->foreign_key = $question_template_id;
        $question->points = $template->points * $trivia->points_multiplier;

        $saved =  $this->save($question);
        if ($saved) {
            Websocket::publishEvent('newQuestion', $question->toArray());
        }
        return $saved;
    }

    public function addGeneric($trivia_id, $team_id, $generic_question_id)
    {
        $template = \Cake\ORM\TableRegistry::get('GenericQuestions')->get($generic_question_id);
        $team = \Cake\ORM\TableRegistry::get('Teams')->get($team_id);
        $trivia = \Cake\ORM\TableRegistry::get('Trivias')->get($trivia_id);

        $question = $this->newEmptyEntity();
        $question->trivia_id = $trivia_id;
        $question->team_id = $team_id;
        $question->question = __($template->question, $team->name);
        $question->option_1 = $template->option_1;
        $question->option_2 = $template->option_2;
        $question->option_3 = $template->option_3;
        $question->model = 'GenericQuestions';
        $question->foreign_key = $generic_question_id;
        $question->points = $template->points * $trivia->points_multiplier;

        $saved =  $this->save($question);
        if ($saved) {
            $template->used = true;
            \Cake\ORM\TableRegistry::get('GenericQuestions')->save($template);
            Websocket::publishEvent('newQuestion', $question->toArray());
        }
        return $saved;
    }

    public function setCorrectOption($id, $option, &$ref = null)
    {
        $question = $this->get($id);
        $question->correct_option = $option;
        $question->finished = true;
        $question->finished_datetime = \Cake\I18n\Time::now();

        $publicity =  \Cake\ORM\TableRegistry::get('PublicityCampaigns')->getOne($question->trivia_id);
        if ($publicity) {
            $question->publicity_campaign_id = $publicity->id;
        }

        $saved = $this->save($question);
        $ref = $question;

        $question->publicity_campaign = $publicity;

        $connection = ConnectionManager::get('default');



        try {
            //$start = microtime(true);
            $this->updateAnwersTable($question->finished_datetime,'correct_answers');
            $this->updateAnwersTable($question->finished_datetime,'wrong_answers');

            //$connection->query("REFRESH MATERIALIZED VIEW  correct_answers;")->execute(); // take 23 seconds
            //debug(microtime(true) - $start);
            //$start = microtime(true);
            //$connection->query("REFRESH MATERIALIZED VIEW  wrong_answers;")->execute(); // take 15.4 seconds
            //debug(microtime(true) - $start);
            //$start = microtime(true);

            // Moved to UsersController->status()
            ///$connection->query("REFRESH MATERIALIZED VIEW  points;")->execute(); // take 1.6 seconds
            //debug(microtime(true) - $start);
            //$start = microtime(true);

            // Moved to UsersController->status()
            //$connection->query("REFRESH MATERIALIZED VIEW  life;")->execute(); // take 1.2 seconds
            //debug(microtime(true) - $start);

            //$command = dirname(dirname(dirname(__DIR__))) . "/bin/cake question_tasks  > /dev/null &";
            //exec($command);


        } catch (\Exception $e) {
            debug($e);
        }

        //REFRESH MATERIALIZED VIEW CONCURRENTLY correct_answers;
        //REFRESH MATERIALIZED VIEW CONCURRENTLY wrong_answers;
        //REFRESH MATERIALIZED VIEW CONCURRENTLY points;
        //REFRESH MATERIALIZED VIEW CONCURRENTLY life;

        /*if(!$saved){
            throw new \Cake\Http\Exception\ServiceUnavailableException("Por favor intente guardar la respuesta nuevamente");
        }*/

        // una vez guardada enviar al socket el aviso de que no se puede responder mas
        // ejecutar quesadilla para procesar las respuestas en ¿dos pasos, 1 enseguida, 2 a pocos segundos?
        // TODO: read finishedQuestion from node to update : life and points materialized views
        Websocket::publishEvent('finishedQuestion', $question->toArray());

        //Websocket::publishEvent('updateUserData', []);
        // sleep(4);
        // Websocket::publishEvent('finishedQuestion', $question->toArray());

        return $saved;
    }

    private function updateCorrectAnswers($datetime)
    {
        $connection = ConnectionManager::get('default');
        $connection->transactional(function ($connection) use ($datetime) {



            $dateString = $datetime->format('Y-m-d h:i:s');

            $tsQuery = $connection->query("SELECT ts from updated_indexes where table_name='correct_answers';")->fetch('assoc');
            $ts = empty($tsQuery['ts']) ? '-infinity' : $tsQuery['ts'];


            $connection->query(
            "
            INSERT INTO correct_answers
            SELECT answers.*
            FROM answers
            INNER JOIN questions ON questions.id = answers.question_id AND answers.selected_option = questions.correct_option
            WHERE questions.finished = true AND questions.canceled = false
            AND answers.created >= '$ts'
            ON CONFLICT ON CONSTRAINT correct_answers_pkey
            DO NOTHING;
            "
        )->execute();

            $connection->execute("
            INSERT INTO updated_indexes (table_name, ts)
            VALUES('correct_answers','{$dateString}')
            ON CONFLICT (table_name)
            DO
            UPDATE SET ts = '{$dateString}';
        ");

            $connection->execute("DROP INDEX IF EXISTS correct_answers_latest_updated_index");
            $connection->execute("CREATE INDEX correct_answers_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '{$dateString}';");
        });
    }

    private function updateAnwersTable($datetime,$tableName)
    {
        $connection = ConnectionManager::get('default');
        $connection->transactional(function ($connection) use ($datetime,$tableName) {



            $dateString = $datetime->format('Y-m-d h:i:s');

            $tsQuery = $connection->query("SELECT ts from updated_indexes where table_name='$tableName';")->fetch('assoc');
            $ts = empty($tsQuery['ts']) ? '-infinity' : $tsQuery['ts'];


            $connection->query(
            "
            INSERT INTO $tableName
            SELECT answers.id as id, answers.user_id as user_id, answers.question_id as question_id, questions.trivia_id as trivia_id, questions.points as points, answers.selected_option as selected_option, answers.lives as lives, answers.created as created, answers.response_seconds as response_seconds
            FROM answers
            INNER JOIN questions ON questions.id = answers.question_id AND answers.selected_option = questions.correct_option
            WHERE questions.finished = true AND questions.canceled = false
            AND answers.created >= '$ts'
            ON CONFLICT ON CONSTRAINT {$tableName}_pkey
            DO NOTHING;
            "
        )->execute();

            $connection->execute("
            INSERT INTO updated_indexes (table_name, ts)
            VALUES('$tableName','{$dateString}')
            ON CONFLICT (table_name)
            DO
            UPDATE SET ts = '{$dateString}';
        ");

            $connection->execute("DROP INDEX IF EXISTS {$tableName}_latest_updated_index");
            $connection->execute("CREATE INDEX {$tableName}_latest_updated_index ON answers (id, user_id, question_id, selected_option, lives, created, response_seconds) WHERE  created >= '{$dateString}';");
        });
    }

    public function cancel($id)
    {
        $question = $this->get($id);
        $question->canceled = true;
        $question->finished = true;
        $question->finished_datetime = \Cake\I18n\Time::now();
        $saved = $this->save($question);
        /*if(!$saved){
            throw new \Cake\Http\Exception\ServiceUnavailableException("Por favor intente guardar la respuesta nuevamente");
        }*/

        // una vez guardada enviar al socket el aviso de que no se puede responder mas
        // ejecutar quesadilla para procesar las respuestas en ¿dos pasos, 1 enseguida, 2 a pocos segundos?
        Websocket::publishEvent('finishedQuestion', $question->toArray());
        //        sleep(4);
        //      Websocket::publishEvent('finishedQuestion', $question->toArray());
        /*Queue::push(['\App\Shell\WorkerShell','processAnswers'], [
            'question' => $question
        ], ['queue' => 'worker']);*/

        return $saved;
    }
}
