<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UnfinishedOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnfinishedOrdersTable Test Case
 */
class UnfinishedOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UnfinishedOrdersTable
     */
    public $UnfinishedOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.unfinished_orders',
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
        $config = TableRegistry::getTableLocator()->exists('UnfinishedOrders') ? [] : ['className' => UnfinishedOrdersTable::class];
        $this->UnfinishedOrders = TableRegistry::getTableLocator()->get('UnfinishedOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UnfinishedOrders);

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
