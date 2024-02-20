<?php

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

class NotificationsCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        // $io->out('Hello world.');
        $this->loadModel('Notifications');
        $notifications = $this->Notifications
                            ->find()
                            ->where(['notified' => false]);
        if (!empty($notifications)) {
            foreach ($notifications as $notification) {
                $this->Notifications->notify($notification);
            }
        }
    }
}
