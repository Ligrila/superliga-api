<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CorrectAnswersFixture
 *
 */
class CorrectAnswersFixture extends TestFixture
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
        'points' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '10', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
                'id' => '17ae540f-bbb8-4f95-bc16-c9c46d619a92',
                'user_id' => '08a3e3ed-86ba-4863-a2f1-b4ca13e7968e',
                'question_id' => '7424a4c1-e863-411d-8f7e-83f712316a15',
                'trivia_id' => 'f56dce3e-1697-4c14-90a2-6a008b2cedd0',
                'points' => 1
            ],
        ];
        parent::init();
    }
}
