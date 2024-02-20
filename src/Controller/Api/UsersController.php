<?php

namespace App\Controller\Api;

use App\Controller\Api\ApiController;

use Cake\Http\Exception\UnauthorizedException;
use Cake\Http\Client;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\ConnectionManager;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use QuanKim\PhpJwt\JWT;



/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends ApiAppController
{
    public $publicActions = ['token', 'add', 'tokenRefresh', 'facebookLogin', 'googleLogin', 'login', 'forgotPassword', 'avatar'];
    public function initialize(): void
    {
        parent::initialize();
        //    $this->Auth->allow(['add','token']);
    }

    public function login()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
        }
        $user = $this->Users->find()->where(['Users.id' => $user['id']])->first();

        //TODO: test refresh token
        //$expire = time() + 604800;
        //$expire = time() + 1;
        $expire =  time() + ((!is_null(Configure::read('AuthToken.expire'))) ? Configure::read('AuthToken.expire') : 604800 * 365);
        $refresh_token = JWT::encode([
            'sub' => $user['id'],
            'ref' => time()
        ], Security::getSalt());

        $access_token = JWT::encode([
            'sub' => $user['id'],
            'exp' =>  $expire
        ], Security::getSalt());

        $table = TableRegistry::get('AuthToken');
        $authToken = $table->newEmptyEntity();
        $authToken->user_id = $user['id'];
        $authToken->access_token = $access_token;
        $authToken->refresh_token = $refresh_token;
        $table->save($authToken);

        $this->set([
            'success' => true,
            'data' => [
                'access_token' => $access_token,
                'refresh_token' => $refresh_token,
                'user' => $user,
                'expire' => $expire * 1000
            ],
            '_serialize' => ['success', 'data']
        ]);
    }

    public function token()
    {
        if ($this->request->is('post')) {
            $table = TableRegistry::get('AuthToken');
            $refresh_token = $this->request->getData('refresh_token');
            $authToken = $table->find('all')->where(['refresh_token' => $refresh_token])->first();
            if ($authToken) {
                $expire =  time() + ((!is_null(Configure::read('AuthToken.expire'))) ? Configure::read('AuthToken.expire') : 2147483);
                $access_token = JWT::encode([
                    'sub' => $authToken['user_id'],
                    'exp' => $expire
                ], Security::getSalt());
                $refresh_token = JWT::encode([
                    'sub' => $authToken['user_id'],
                    'ref' => time()
                ], Security::getSalt());
                $authToken->access_token = $access_token;
                $authToken->refresh_token = $refresh_token;
                $table->save($authToken);
                $this->set([
                    'success' => true,
                    'data' => [
                        'access_token' => $access_token,
                        'refresh_token' => $refresh_token,
                        'expire' => $expire * 1000
                    ],
                    '_serialize' => ['success', 'data']
                ]);
            } else {
                $this->set([
                    'success' => false,
                    'data' => [
                        'refresh_token_expired' => true,
                    ],
                    '_serialize' => ['success', 'data']
                ]);
            }
        }
    }

    public function googleLogin()
    {
        if (empty($this->request->data['access_token'])) {
            throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
        }
        $token = $this->request->data['access_token'];

        $url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=$token";
        $http = new Client();
        $response = $http->get($url);
        $guser = $response->json;
        if (isset($guser['error'])) {
            throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
        }


        $id = $email = $first_name = $last_name = $picture = null;
        if (!empty($guser['email'])) {
            $email = $guser['email'];
        }
        if (!empty($guser['family_name'])) {
            $last_name = $guser['family_name'];
        }
        if (!empty($guser['given_name'])) {
            $first_name = $guser['given_name'];
        }


        if (!empty($guser['picture'])) {
            $picture = $guser['picture'];
        }
        $id = $guser['id'];


        if (empty($email)) {
            $email = "$id@google.com";
        }

        $exists = $this->Users->findByEmail($email);

        $hasher = new DefaultPasswordHasher();

        if ($exists->isEmpty()) {
            $tmpPassword = 'SuperS4cret_' . time();
            $user = $this->Users->newEmptyEntity();
            $user->email = $email;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->enabled = true;
            $user->email_verified = true;
            $user->password = $hasher->hash($tmpPassword);


            if (!$user = $this->Users->save($user)) {
                throw new UnauthorizedException(__('Se produjo un error creando el usuario'));
            }
            $this->request->data['email'] = $email;
            $this->request->data['password'] = $tmpPassword;
            $this->login();
        } else {
            //re build password
            $tmpPassword = 'SuperS4cret_' . time();
            $user = $exists->first();
            $user->password = $hasher->hash($tmpPassword);
            if (!$user = $this->Users->save($user)) {
                throw new UnauthorizedException(__('Se produjo un error creando el usuario'));
            }
            $this->request->data['email'] = $user->email;
            $this->request->data['password'] = $tmpPassword;
            $this->login();
        }
    }

    public function facebookLogin()
    {
        if (empty($this->request->data['access_token'])) {
            throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
        }
        $token = $this->request->data['access_token'];

        $url = "https://graph.facebook.com/me?access_token=$token&fields=name,email,first_name,last_name";
        $http = new Client();
        $response = $http->get($url);
        $fuser = $response->json;
        if (isset($fuser['error'])) {
            throw new UnauthorizedException(__('Nombre de usuario o contraseñas incorrectas'));
        }


        $id = $email = $first_name = $last_name = null;
        extract($fuser);

        $picture = "https://graph.facebook.com/$id/picture?access_token=$token&type=large";

        if (empty($email)) {
            $email = "$id@facebook.com";
        }

        $exists = $this->Users->findByEmail($email);

        $hasher = new DefaultPasswordHasher();

        if ($exists->isEmpty()) {
            $tmpPassword = 'SuperS4cret_' . time();
            $user = $this->Users->newEmptyEntity();
            $user->email = $email;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->enabled = true;
            $user->email_verified = true;
            $user->password = $hasher->hash($tmpPassword);


            if (!$user = $this->Users->save($user)) {
                throw new UnauthorizedException(__('Se produjo un error creando el usuario'));
            }
            $this->request->data['email'] = $email;
            $this->request->data['password'] = $tmpPassword;
            $this->login();
        } else {
            //re build password
            $tmpPassword = 'SuperS4cret_' . time();
            $user = $exists->first();
            $user->password = $hasher->hash($tmpPassword);
            if (!$user = $this->Users->save($user)) {
                throw new UnauthorizedException(__('Se produjo un error creando el usuario'));
            }
            $this->request->data['email'] = $user->email;
            $this->request->data['password'] = $tmpPassword;
            $this->login();
        }
    }


    public function avatar($id)
    {
        $user = $this->Users->get($id);
        $this->redirect($user->avatar);
    }

    public function add()
    {

        $user = $this->Users->newEmptyEntity();
        $success = false;
        if ($this->request->is('post')) {
            $hasher = new DefaultPasswordHasher();

            $data = $this->request->getData();
            //var_dump($data);
            if (!empty($data['referral_username'])) {
                $referralUsername = $data['referral_username'];
                $referralUser = $this->Users->find('slugged', ['slug' => $referralUsername])->first();
                if ($referralUser) {
                    $data['referral_id'] = $referralUser->id;
                }
            }

            $user = $this->Users->patchEntity($user, $data);
            $email = $user->email;
            $hash = sha1('wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA' . strtoupper($user->email) . 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA');

            if (!empty($data['hash']) && $hash == $data['hash']) {
                $user->password = $hasher->hash($user->password);
                $user->enabled = true;
                $user->validation_hash = sha1(uniqid());
                $user->email_verified = false;
                $success = $this->Users->save($user);
                if (!$success) {
                    $user = $user->getErrors();
                } else {
                    //@TODO Doesn't work in docker!
                    $emailSender = new Mailer('default');
                    $emailSender->setFrom('info@jugadaafa.com');
                    $emailSender->setTo($email);
                    $emailSender->setEmailFormat('both');
                    $emailSender->viewBuilder()
                        ->setTemplate('welcome')
                        ->setLayout('Ligrila.default')
                        ->setHelpers(['Ligrila.Email', 'Form']);
                    $emailSender->viewBuilder()->setHelpers(['Ligrila.Email', 'Form']);
                    $emailSender->setSubject('Jugada AFA - Confirmación de email');
                    $emailSender->setViewVars(compact('user'));
                    $emailSender->send();
                }
            } else {
            }
        }
        $this->apiResult($success, compact('user'));
    }

    private function fast_me()
    {
        $user =  $this->Users->get(
            $this->Auth->user('sub'),
            ['contain' => ['Points']]
        );
        $user->life = [
            'lives' => 1000
        ];
        $user->infinite_lives = [
            [
                'id' => 1
            ]
        ];
        $success = true;
        $this->apiResult($success, compact('user'));
        return;
        $user =  $this->Users->get(
            $this->Auth->user('id'),
            ['contain' => ['Life', 'Points', 'PlayedGames', 'InfiniteLives']]
        );
        $success = true;
        $this->apiResult($success, compact('user'));
    }

    public function status(){
        $user_id = $this->Auth->user('sub');
        $points = $this->Users->getPoints($user_id);
        $life = $this->Users->getLife($user_id);
        $this->apiResult(true,compact('points','life'));
    }

    public function me()
    {

        $user =  $this->Users->get(
            $this->Auth->user('sub'),
            ['contain' => ['Life', 'Points', 'PlayedGames', 'InfiniteLives']]
        );
        $success = true;
        $this->apiResult($success, compact('user'));
    }

    public function edit()
    {
        $user =  $this->Users->get(
            $this->Auth->user('sub')
        );
        $success = false;
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $success = $this->Users->save($user);
            if (!$success) {
                $user = $user->getErrors();
            }
        }

        $this->apiResult($success, compact('user'));
    }

    public function ranking()
    {
    }

    public function triviaStatistics($trivia_id)
    {
        $this->loadModel('TriviaUserStatistics');

        $user_id = $this->Auth->user('sub');

        $statistics = $this->TriviaUserStatistics->find()
            ->where(['user_id' => $user_id, 'trivia_id' => $trivia_id])->first();
        $mediaHits = $triviaHits = $correctAnswers = $wrongAnswers = $usedLives = $ranking = $generalRanking = $generalPoints = $points = 0;
        if (!empty($statistics)) {
            $allCorrectAnswersCount =  $statistics->correct_answers_count;
            $allWrongAnswersCount =  $statistics->wrong_answers_count;

            $totalAnswers = $allCorrectAnswersCount + $allWrongAnswersCount;
            $totalPercent = 0;
            if ($totalAnswers > 0) {
                $totalPercent = round(($allCorrectAnswersCount * 100) / $totalAnswers);
            }

            $correctAnswers =  $statistics->correct_answers_user_count;
            $wrongAnswers =  $statistics->wrong_answers_user_count;
            $usedLives =  $wrongAnswers;
            $totalUserAnswers = $correctAnswers + $wrongAnswers;
            $totalUserPercent = 0;
            if ($totalUserAnswers > 0) {
                $totalUserPercent = round(($correctAnswers * 100) / $totalUserAnswers);
            }
            $mediaHits = 0;
            if ($totalPercent > 0) {
                $mediaHits = round(($totalUserPercent * 100) / $totalPercent);
            }
            $triviaHits = $totalUserPercent;

            $points = $statistics->points;
            $ranking = $statistics->position;
            $generalRanking = $statistics->general_position;
            $generalPoints = $statistics->general_points;
        }


        $data =
            compact(
                'mediaHits',
                'triviaHits',
                'correctAnswers',
                'wrongAnswers',
                'usedLives',
                'ranking',
                'generalRanking',
                'generalPoints',
                'points'
            );
        $this->apiResult(true, $data);
    }

    public function statistics()
    {
        $user_id = $this->Auth->user('sub');
        $this->loadModel('CorrectAnswers');
        $this->loadModel('WrongAnswers');
        $this->loadModel('Points');

        $allCorrectAnswersCount =  $this->CorrectAnswers->find()->count();
        $allWrongAnswersCount =  $this->WrongAnswers->find()->count();

        $totalAnswers = $allCorrectAnswersCount + $allWrongAnswersCount;

        if ($totalAnswers === 0) {
            $mediaHits = $triviaHits = $correctAnswers = $wrongAnswers = $usedLives = $ranking = $points = 0;
            $data =
                compact(
                    'mediaHits',
                    'triviaHits',
                    'correctAnswers',
                    'wrongAnswers',
                    'usedLives',
                    'ranking',
                    'points'
                );
            $this->apiResult(true, $data);
            return;
        }
        $totalPercent = round(($allCorrectAnswersCount * 100) / $totalAnswers);

        $correctAnswers =  $this->CorrectAnswers->find()->where(['user_id' => $user_id])->count();
        $wrongAnswers =  $this->WrongAnswers->find()->where(['user_id' => $user_id])->count();
        $usedLives =  $this->WrongAnswers->find()->where(['user_id' => $user_id])->where(['lives >' => 0])->count();
        $totalUserAnswers = $correctAnswers + $wrongAnswers;

        $totalUserPercent = round(($correctAnswers * 100) / $totalUserAnswers);

        $mediaHits = round(($totalUserPercent * 100) / $totalPercent);
        $triviaHits = $totalUserPercent;

        $rankingFind = $this->Points->find()->where(['user_id' => $user_id])->first();
        $ranking = 0;
        $points = 0;
        if ($rankingFind) {
            $ranking = $rankingFind->position;
            $points = $rankingFind->points;
        }


        $data =
            compact(
                'mediaHits',
                'triviaHits',
                'correctAnswers',
                'wrongAnswers',
                'usedLives',
                'ranking',
                'points'
            );
        $this->apiResult(true, $data);
    }
}
