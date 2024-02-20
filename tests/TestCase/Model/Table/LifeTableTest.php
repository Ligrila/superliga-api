<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LifeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LifeTable Test Case
 */
class LifeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LifeTable
     */
    public $Life;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.life',
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
        $config = TableRegistry::getTableLocator()->exists('Life') ? [] : ['className' => LifeTable::class];
        $this->Life = TableRegistry::getTableLocator()->get('Life', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Life);

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
