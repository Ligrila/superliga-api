<?php
namespace App\Controller;


use Cake\Core\Configure;

use App\Controller\AppController;

class ChampionshipsController extends AppController
{
    public $publicActions = ['index'];
    public function index($id=null){
        if (preg_match('#android#i', $_SERVER ['HTTP_USER_AGENT'])) {
            $this->redirect('market://details?id=com.balltoball.jugadasuperliga');
            return;
        }
        // ios
        if (preg_match('#(iPad|iPhone|iPod)#i', $_SERVER ['HTTP_USER_AGENT'])) {
            $this->redirect('itms://itunes.apple.com//us/app/jugada-superliga/id1435620888?mt=8');
            return;
        }
        
        $this->redirect('https://play.google.com/store/apps/details?id=com.balltoball.jugadasuperliga');
        return;
    
    }
    
}
