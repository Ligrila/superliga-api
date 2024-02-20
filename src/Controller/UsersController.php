<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Http\Exception\UnauthorizedException;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;






/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
  public $publicActions = ['confirm', 'forgotPassword','reset'];
  public function confirm($hash){
    if(empty($hash)){
      throw new UnauthorizedException(__('Validación inválida'));
    }
    $user = $this->Users->findByValidationHash($hash)->first();
    if(empty($user)){
      throw new UnauthorizedException(__('Validación inválida'));
    }
    $user->email_verified = true;
    $user->enabled = true;
    $user->validation_hash = null;

    $this->Users->save($user);
    $this->Flash->success('Hemos validado tu email. Ya puedes ingresar a Jugada Superliga');
    $this->redirect('/');


}

  public function forgotPassword(){
    $this->set('noFooter',true);


    if($this->request->is('post')){
        $data = $this->request->getData();
        if($data['email']){
            $hash = \Cake\Utility\Security::randomString();
            $user = $this->Users->findByEmail($data['email'])->first();
            $user->reset_hash = $hash;
            $this->Users->save($user);
            $email = new Email('default');
            $email->from(['no-reply@jugadasuperliga.com' => 'Jugada SuperLiga'])
                ->to($data['email'])
                ->emailFormat('html')
                ->subject('Recuperar contraseña')
                ->send("Hola, este correo se ha enviado con el fin de recuperar la contraseña para volver a acceder a Jugada SuperLiga.\n\r Si tú has hecho la solicitud, por favor haz click en el siguiente enlance:\n\r <a href=\"" . \Cake\Routing\Router::url('/users/reset/'.$hash,true) . "\"> Recuperar contraseña</a>");
            $this->Flash->success('Hemos enviado un email a tu dirección de correo para que recuperes tu contraseña');
        }
    }

    }

    public function reset($hash){
        $this->set('noFooter',true);
        $user = $this->Users->findByResetHash($hash)->first();
        if(empty($user)){
            throw new UnauthorizedException('Pedido inválido');
        }
        if($this->request->is('post')){
            $hasher = new DefaultPasswordHasher();

            $user = $this->Users->patchEntity($user,$this->request->getData());
            $user->password = $hasher->hash($user->password);
            $saved = $this->Users->save($user);
            if($saved){
                $user->reset_hash = null;
                $this->Users->save($user);
                $this->Flash->success('Contraseña reestablecida');
                $this->redirect('/');

            } else{
                $this->Flash->error("Error. Por favor, intente nuevamente");
            }
        }


    }

}
