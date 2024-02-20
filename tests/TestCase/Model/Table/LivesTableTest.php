<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LivesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LivesTable Test Case
 */
class LivesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LivesTable
     */
    public $Lives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lives',
        'app.users',
        'app.payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Lives') ? [] : ['className' => LivesTable::class];
        $this->Lives = TableRegistry::getTableLocator()->get('Lives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lives);

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
