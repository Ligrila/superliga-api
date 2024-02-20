<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChampionshipUsersFixture
 *
 */
class ChampionshipUsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'championship_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'championship_index' => ['type' => 'index', 'columns' => ['championship_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'championship_users_championship_id_user_id_key' => ['type' => 'unique', 'columns' => ['championship_id', 'user_id'], 'length' => []],
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
                'id' => '7c18f38c-9328-487d-8583-baf3334183ab',
                'championship_id' => 'ff1d4873-fa21-48fd-b461-642fdf50cd17',
                'user_id' => 'd97b6f2e-bb57-40c5-9183-c3831572ef74',
                'created' => 1548962577,
                'modified' => 1548962577
            ],
        ];
        parent::init();
    }
}
