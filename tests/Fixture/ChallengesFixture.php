<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChallengesFixture
 *
 */
class ChallengesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'championship1_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'championship2_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'user1_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'user2_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'until' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'id' => '0568538e-6184-4aa9-ba75-bb9140b244f8',
                'championship1_id' => 'bbaf858f-6dfd-4d3a-b2e3-5d124847d253',
                'championship2_id' => 'baef3a0e-e76e-4176-b87c-ecf639d88f86',
                'user1_id' => '191a062c-1ee5-481c-a334-aaf2e6d3d85b',
                'user2_id' => '7bc03dbe-eb88-4d73-a132-2f9ceff8d50c',
                'until' => '2019-03-06',
                'created' => 1551903910,
                'modified' => 1551903910
            ],
        ];
        parent::init();
    }
}
