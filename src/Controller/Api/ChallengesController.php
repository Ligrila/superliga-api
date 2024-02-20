<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

/**
 * Challenges Controller
 *
 * @property \App\Model\Table\ChallengesTable $Challenges
 *
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChallengesController extends ApiAppController
{
    public $publicActions = array('all');
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   


        $challenges = $this->Challenges
            ->find()
            ->where([
                'OR' => [
                   ['Challenges.user1_id'=>$this->Auth->user('sub')],
                   ['Challenges.user2_id'=>$this->Auth->user('sub')]
                ],
            ])
            // ->orWhere(['Challenges.user1_id'=>$this->Auth->user('sub')])
            // ->orWhere(['Challenges.user2_id'=>$this->Auth->user('sub')])
            ->contain(['Championship1s'=>['ChampionshipsUsersPointsSums'],'Championship2s'=>['ChampionshipsUsersPointsSums']]);


        $this->apiResult(true,$challenges);
    }
    private function getLastQuery()
    {
        $dbo = \Cake\Datasource\ConnectionManager::get('default');
        $logs = $dbo->getLogger();
        var_dump($logs);

    }
    /*
    *
    * @param championship_id a desafiar
    * @param challenge_championship_id quien desafia, sub debe ser owner de este
    */
    public function addRequest(){
        $saved = false;
        $challengeRequest = $this->Challenges->ChallengeRequests->newEmptyEntity();
        if($this->request->is('post')){
            $data = $this->request->getData();

            $c1 = $this->Challenges->Championship1s->get($data['championship_id']);
            $c2 = $this->Challenges->Championship2s->get($data['challenge_championship_id']);
            // challenge_championship_id tiene que ser propiedad de user_id
            if($c2->user_id == $this->Auth->user('sub') ){


                $saved = $this->Challenges->ChallengeRequests->saveAndNotify($challengeRequest,$c1,$c2);
            }


        }

        $this->apiResult($saved,$challengeRequest);

    }

    public function responseRequest(){
        $saved = false;
        $challengeRequest = $this->Challenges->ChallengeRequests->newEmptyEntity();
        if($this->request->is('post')){
            $data = $this->request->getData();

            $challengeRequest = $this->Challenges->ChallengeRequests->get($data['id']);
            // challenge_championship_id tiene que ser propiedad de user_id
            if(!$challengeRequest->done && $challengeRequest->user_id == $this->Auth->user('sub') ){
                $challengeRequest->accepted = boolval($data['accepted']);
                $challengeRequest->done = true;
                $saved = $this->Challenges->ChallengeRequests->responseAndNotify($challengeRequest);
            }


        }

        $this->apiResult($saved,$challengeRequest);

    }

    public function ranking($id=null){
        $challenge = $this->Challenges->get($id,['contain'=>['Championship1s','Championship2s']]);
        $type = empty($_REQUEST['type']) ? 'all' : $_REQUEST['type'];
        $items1 = $this->Challenges->Championship1s->ranking($challenge->championship1_id,$type);
        $items2 = $this->Challenges->Championship2s->ranking($challenge->championship2_id,$type);

        $points1 = $points2 = 0;
        foreach($items1 as $item){
            $points1 += $item->points;
        }
        foreach($items2 as $item){
            $points1 += $item->points;
        }

        $challenge->championship1->items = $items1;
        $challenge->championship1->points  = $points1;
        $challenge->championship2->items = $items2;
        $challenge->championship2->points = $points2;
        //$this->getLastQuery();
        $this->apiResult(true,$challenge);
    }
}
