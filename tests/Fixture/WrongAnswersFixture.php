<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WrongAnswersFixture
 *
 */
class WrongAnswersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'question_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'trivia_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_options' => [
            'engine' => null,
            'collation' => null
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => '227d62e3-e7a0-4f2a-bbaf-9966a0701bcb',
                'user_id' => '3aa323a3-3103-4699-b5e9-1ef33b98197a',
                'question_id' => 'c2d38c96-7dea-45ea-8594-306529ca8e0b',
                'trivia_id' => '01464921-a20e-47e0-8ff9-9a49ee3baefc'
            ],
        ];
        parent::init();
    }
}
