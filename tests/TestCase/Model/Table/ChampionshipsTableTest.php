<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampionshipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChampionshipsTable Test Case
 */
class ChampionshipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampionshipsTable
     */
    public $Championships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.championships',
        'app.users',
        'app.championship_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Championships') ? [] : ['className' => ChampionshipsTable::class];
        $this->Championships = TableRegistry::getTableLocator()->get('Championships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Championships);

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
