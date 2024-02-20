<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

//use App\Application;
//use Cake\Console\CommandRunner;
use Cake\Http\Client;


/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 *
 * @method \App\Model\Entity\Answer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnswersController extends ApiAppController
{

    public function needToBeFixedAdd(){
        $endpoint = \Cake\Core\Configure::read('Microservices.Answers.add');
        $http = new Client();

        $success = false;
        $answer = [];
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user_id = $this->Auth->user('sub');
            $data['user_id'] = $user_id;
            $responseObject = $http->post($endpoint,$data);
            $response =  json_decode($responseObject->body);
            $success = $response->success;
            $answer = $response->data;
            $answer->error = $response->error;
            //$answer = $response;
        }

        $this->apiResult($success,$answer);

    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $success = false;
        $answer = $this->Answers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $question = $this->Answers->Questions->get($data['question_id']);
            $user_id = $this->Auth->user('sub');
            $data['user_id'] = $user_id;
            $data['created'] = \Cake\I18n\Time::now();
            $diff = abs(strtotime($data['created']->format('d-m-Y H:i:s.u'))-strtotime($question['created']->format('d-m-Y H:i:s.u')));
            //Creates variables for the microseconds of date1 and date2
            $micro1 = $data['created']->format("u");
            $micro2 = $question['created']->format("u");
            unset($question);
            //Absolute difference between these micro seconds:
            $micro = abs($micro1 - $micro2);
            $data['response_seconds'] = $diff.".".$micro;
            $user = $this->Answers->Users->get($user_id,[
                'contain'=>['InfiniteLives']
            ]);
            $data['lives'] = 1;
            if(!empty($user->infinite_lives)){
                $data['lives'] = 0;
            }
            // $data['lives'] = 0;
            $answer = $this->Answers->patchEntity($answer, $data);

            $success = $this->Answers->save($answer);
            if(!$success){
                $answer->errors = $answer->getErrors();
            }
        }
        $r = $answer->toArray();
        $this->apiResult($success,$r);
    }

/*
    private function backgroundAdd(){
        $success = false;
        $answer = $this->Answers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user_id = $this->Auth->user('id');
            $data['user_id'] = $user_id;

            $answer = $this->Answers->patchEntity($answer, $data);
            $success = true;
            $command = dirname(dirname(dirname(__DIR__))) . "/bin/cake save_answer {$data['question_id']} {$data['selected_option']} {$data['user_id']} > /dev/null &";

            exec($command);



        }

        $this->apiResult($success,$answer);

    }

*/

}
