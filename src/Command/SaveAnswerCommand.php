<?php

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;


class SaveAnswerCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {

        $parser->addArgument('question_id', [
            'help' => 'Question id',
            'required' => true
        ]);
        $parser->addArgument('selected_option', [
            'help' => 'Selected Option id',
            'required' => true
        ]);
        $parser->addArgument('user_id', [
            'help' => 'User id',
            'required' => true
        ]);
        return $parser;
    }
    public function execute(Arguments $args, ConsoleIo $io)
    {
        //sleep(10000); // para pruebas

        $user_id = $args->getArgument('user_id');
        $question_id = $args->getArgument('question_id');
        $selected_option = $args->getArgument('selected_option');
        $created = \Cake\I18n\Time::now();

        // $this->loadModel('Answers');
        $this->loadModel('Answers');
        // $answers = $this->getTableLocator()->get('Answers');
        $answer = $this->Answers->newEmptyEntity();

        $data = compact('user_id', 'question_id', 'selected_option', 'created');

        $user = $this->Answers->Users->get($user_id, [
            'contain' => ['InfiniteLives']
        ]);
        $data['lives'] = 1;
        if (!empty($user->infinite_lives)) {
            $data['lives'] = 0;
        }

        $answer = $this->Answers->patchEntity($answer, $data);

        $success = $this->Answers->save($answer);

        if (!$success) {
            debug("error saving");
            debug($answer->getErrors());
        }
    }
}
