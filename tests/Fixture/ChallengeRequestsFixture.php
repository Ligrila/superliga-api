<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChallengeRequestsFixture
 *
 */
class ChallengeRequestsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'championship_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'challenge_championship_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'notified' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => true, 'comment' => null, 'precision' => null],
        'message' => ['type' => 'text', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'acepted' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => true, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modifed' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'challenge_requests_championship_id_callenge_championship_id_idx' => ['type' => 'unique', 'columns' => ['championship_id', 'challenge_championship_id'], 'length' => []],
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
                'id' => '83b14070-eb1c-41cd-b3a8-375b34dd05ec',
                'championship_id' => '6dba3aaf-393a-4294-a09a-7bf330ba07c7',
                'user_id' => '1d0bd46e-5bd0-4d3b-a1af-6da93c4abed5',
                'challenge_championship_id' => '52e98cd4-a73b-4573-8955-4d34356c98ac',
                'notified' => 1,
                'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'acepted' => 1,
                'created' => 1551903868,
                'modifed' => 1551903868
            ],
        ];
        parent::init();
    }
}
