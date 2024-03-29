<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChallengesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChallengesTable Test Case
 */
class ChallengesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChallengesTable
     */
    public $Challenges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.challenges',
        'app.championship1s',
        'app.championship2s',
        'app.user1s',
        'app.user2s'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Challenges') ? [] : ['className' => ChallengesTable::class];
        $this->Challenges = TableRegistry::getTableLocator()->get('Challenges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Challenges);

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
