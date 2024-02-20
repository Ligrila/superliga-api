<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlayedGamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlayedGamesTable Test Case
 */
class PlayedGamesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlayedGamesTable
     */
    public $PlayedGames;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.played_games',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlayedGames') ? [] : ['className' => PlayedGamesTable::class];
        $this->PlayedGames = TableRegistry::getTableLocator()->get('PlayedGames', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlayedGames);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
