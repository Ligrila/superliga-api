<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LifeFixture
 *
 */
class LifeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'life';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'lives' => ['type' => 'decimal', 'length' => 33, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
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
                'user_id' => 'e7ad6f88-37c4-48da-ad00-541009bd6e24',
                'lives' => 1.5
            ],
        ];
        parent::init();
    }
}
