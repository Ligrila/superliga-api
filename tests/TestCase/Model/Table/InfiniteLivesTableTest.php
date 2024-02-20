<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InfiniteLivesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InfiniteLivesTable Test Case
 */
class InfiniteLivesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InfiniteLivesTable
     */
    public $InfiniteLives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.infinite_lives',
        'app.users',
        'app.orders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InfiniteLives') ? [] : ['className' => InfiniteLivesTable::class];
        $this->InfiniteLives = TableRegistry::getTableLocator()->get('InfiniteLives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InfiniteLives);

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
