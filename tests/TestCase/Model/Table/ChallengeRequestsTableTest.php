<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChallengeRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChallengeRequestsTable Test Case
 */
class ChallengeRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChallengeRequestsTable
     */
    public $ChallengeRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.challenge_requests',
        'app.championships',
        'app.users',
        'app.challenge_championships'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChallengeRequests') ? [] : ['className' => ChallengeRequestsTable::class];
        $this->ChallengeRequests = TableRegistry::getTableLocator()->get('ChallengeRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChallengeRequests);

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
