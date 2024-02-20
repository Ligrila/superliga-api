<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChampionshipsFixture
 *
 */
class ChampionshipsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'fixed' => true, 'length' => 36, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'end_date' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
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
                'id' => '697bdf2e-a9ff-49ee-96f6-83235344abd8',
                'name' => 'Lorem ipsum dolor sit amet',
                'user_id' => '8a5b33cc-bd35-4c34-b38d-daee4a9114a2',
                'start_date' => '2019-01-31',
                'end_date' => '2019-01-31',
                'created' => 1548962560,
                'modified' => 1548962560
            ],
        ];
        parent::init();
    }
}
