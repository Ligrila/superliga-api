<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampionshipUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChampionshipUsersTable Test Case
 */
class ChampionshipUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampionshipUsersTable
     */
    public $ChampionshipUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.championship_users',
        'app.championships',
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
        $config = TableRegistry::getTableLocator()->exists('ChampionshipUsers') ? [] : ['className' => ChampionshipUsersTable::class];
        $this->ChampionshipUsers = TableRegistry::getTableLocator()->get('ChampionshipUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChampionshipUsers);

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
