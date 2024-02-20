<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

class SendPushNotificationCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addArgument('title', [
            'help' => 'Title',
            'required'=> true
        ]);
        $parser->addArgument('body', [
            'help' => 'Body',
            'required'=> true
        ]);
        $parser->addArgument('data', [
            'help' => 'Data',
            'required'=> false
        ]);
        $parser->addArgument('expire', [
            'help' => 'Data',
            'required'=> false
        ]);
        $parser->addArgument('ttl', [
            'help' => 'Data',
            'required'=> false
        ]);

        return $parser;
    }
    public function execute(Arguments $args, ConsoleIo $io)
    {
         $this->loadModel('PushNotifications');
        // $pushNotifications = $this->getTableLocator()->get('PushNotifications');
        
        $title = $args->getArgument('title');
        $body = $args->getArgument('body');
        $data = [];
        if(!empty($args->getArgument('data'))){
            $data = json_decode($args->getArgument('data'),true);
        }
        $ttl = $expire = null;
        if(!empty($args->getArgument('expire'))){
            $expire = $args->getArgument('expire');
        }
        if(!empty($args->getArgument('ttl'))){
            $ttl = $args->getArgument('ttl');
        }
        $this->PushNotifications->send($title,$body,$data,null,null,$expire,$ttl);



    }
}