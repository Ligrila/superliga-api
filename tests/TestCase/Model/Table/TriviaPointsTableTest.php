<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TriviaPointsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TriviaPointsTable Test Case
 */
class TriviaPointsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TriviaPointsTable
     */
    public $TriviaPoints;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trivia_points',
        'app.trivias',
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
        $config = TableRegistry::getTableLocator()->exists('TriviaPoints') ? [] : ['className' => TriviaPointsTable::class];
        $this->TriviaPoints = TableRegistry::getTableLocator()->get('TriviaPoints', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TriviaPoints);

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
