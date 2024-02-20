<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use MP;




/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends ApiAppController
{

    public $publicActions = [/*'buy',*/'notification','backUrl'];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        if($this->request->getParam('action')=='backUrl'){
            return;
        }
        parent::beforeRender($event);

    }

    public function backUrl(){
        $isSuscription = !empty($_GET['preapproval_id']);
        $success = isset($_GET['collection_status'])&&$_GET['collection_status']=='approved';
        $this->set(compact('success'));
        $this->viewBuilder()->layout('ajax');
    }
    public function buy($live_pack_id)
    {
        $user_id = $this->Auth->user('sub');
        $user = TableRegistry::get('Users')->get($user_id);
        $livePacks = TableRegistry::get('LivePacks');
        $livePacksData = $livePacks->get($live_pack_id);
        $mp = new MP(Configure::read('mercadopago.clientID'), Configure::read('mercadopago.clientSecret'));
        $notificationUrl = Configure::read('mercadopago.notificationUrl');
        //$mp->sandbox_mode(true);
        $order = \Cake\ORM\TableRegistry::get('UnfinishedOrders')->start([
            'user_id' => $this->Auth->user('sub'),
            'points' => 0,
            'model' => 'LivePacks',
            'foreign_key' => $live_pack_id,
            'comments' => $livePacksData->infinite ? 'Mercado Pago suscripción mensual' : 'Mercado Pago'
        ]);

        if(!$order){
            $this->apiResult(false,[]);
            return;
        }

        if($livePacksData->infinite){
            $startDate = date('Y-m-d\TH:i:s.000P', strtotime('+10 second'));
            $preapproval_data = array(
                "payer_email" => $user->email,
                //'payer_email' => 'test_user_91264001@testuser.com',
                "back_url" => \Cake\Routing\Router::url('/api/payments/back_url',true),
                "reason" => "Suscripción mensual a vidas ilimitadas",
                "external_reference" => $order->id,
                "notification_url" => $notificationUrl,
                "auto_recurring" => array(
                    "frequency" => 1,
                    "frequency_type" => "months",
                    "transaction_amount" => $livePacksData->price,
                    "currency_id" => "ARS",
                    "start_date" => $startDate,
                    ///"end_date" => "2019-06-18T14:58:11.778-03:00"
                    //"end_date" => date('c',strtotime("+100years"))
                )
            );

            $preapproval = $mp->create_preapproval_payment($preapproval_data);
            $purchaseUrl = $preapproval['response']['init_point'];

            $this->apiResult(true,compact('purchaseUrl'));
            return;

        }
        //throw new \Cake\Http\Exception\BadRequestException(\Cake\Routing\Router::url('/payments/back_url/success',true));

        $preference_data = array (
            "items" => array (
                array (
                    'id'=>$live_pack_id,
                    "title" => $livePacksData->name,
                    "quantity" => 1,
                    "currency_id" => "ARS",
                    "unit_price" => $livePacksData->price
                )
            ),
            "payer" => [
                /*    "username" => $this->Auth->user('id'),
                    "email" => $this->Auth->user('email')
                */
                "email" => $user->email
                //"email" => 'test_user_82285676@testuser.com',

            ],
            "auto_return"=> "approved",


            "back_urls"=> [
                "success" =>  \Cake\Routing\Router::url('/api/payments/back_url/success',true),
                "failure" => \Cake\Routing\Router::url('/api/payments/back_url/failure',true),
                "pending" => \Cake\Routing\Router::url('/api/payments/back_url/pending',true)
                /**
                 * Para pruebas en local conviene crear hosts, ml rechaza si se hace por ip
                 * cualquier nombre de host va a ser valido.
                 * es decir configurar en Enviroments del app movil
                 * un nombre de host para comunicación con api para que las url sea por ej.
                 * http://php/superliga/payments/back_url/success
                 * 
                 * 
                 */
                /*"success" => 'https://lopezlean.ddns.net/superliga/payments/back_url/success',
                "failure" => 'https://lopezlean.ddns.net/superliga/payments/back_url/failure',
                "pending" => 'https://lopezlean.ddns.net/superliga/payments/back_url/pending'*/
            ],
            "notification_url" => $notificationUrl,
            "external_reference" => $order->id,



        );

        $preference = $mp->create_preference($preference_data);
        $purchaseUrl = $preference['response']['init_point'];

        $this->apiResult(true,compact('purchaseUrl'));

        //$this->redirect($r);

    }

    public function notification(){
         $data = [
            'get' => $_GET,
            'post' => $_POST,
            'server' => $_SERVER
        ];

        file_put_contents( '/tmp/mp/mp_'. uniqid() . '.json', json_encode($data) );

        if (empty($_GET["topic"])|| empty($_GET['id'])) {
            //ignore no topics call

            $this->apiResult(false,[]);
            return;
        }


        $mp = new MP(Configure::read('mercadopago.clientID'), Configure::read('mercadopago.clientSecret'));
        //$mp->sandbox_mode(true);



        $topic = $_GET["topic"];
        $merchant_order_info = null;
        $payment_info = null;
        if($topic == 'merchant_order'){
            $this->apiResult(true,[]);
            return;
        }

        switch ($topic) {
            case 'payment':
                $payment_info = $mp->get("/v1/payments/".$_GET["id"]);
                file_put_contents( '/tmp/mp/payment_'. uniqid() . '.json', json_encode($payment_info) );
                break;
            /*case 'authorized_payment':
                $payment_info = $mp->get("/authorized_payments/".$_GET["id"]);
                break;
            case 'merchant_order':
                $merchant_order_info = $mp->get("/merchant_orders/".$_GET["id"]);
                break;*/
            default:
                $payment_info = null;
        }

        if($payment_info == null) {
            $this->apiResult(true,['error'=>'Error obtaining the merchant_order']);
            return;
        }

        if ($payment_info["status"] == 200) {
          	// If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items 
        	    $paid_amount = $payment_info['response']['transaction_details']['total_paid_amount'];
                if($paid_amount >= $payment_info['response']['transaction_amount']){
                    $entity = \Cake\ORM\TableRegistry::get('UnfinishedOrders')->get($payment_info['response']['external_reference']);
                    $saved = \Cake\ORM\TableRegistry::get('UnfinishedOrders')->end(
                        $entity,
                        $paid_amount,
                        $payment_info['response']['id']
                    );
                    $this->apiResult($saved,$entity);
                } else{
                    $this->apiResult(false,[]);
                    return;
                }

        }


        
        $this->apiResult(true,[]);
    }
    public function test(){
        $entity = \Cake\ORM\TableRegistry::get('UnfinishedOrders')->get('1f033f92-0978-4a0a-b2df-07748ba45987');
        $saved = \Cake\ORM\TableRegistry::get('UnfinishedOrders')->end(
        $entity,
        10
        );

        $this->apiResult($saved,$entity);
    }

}
