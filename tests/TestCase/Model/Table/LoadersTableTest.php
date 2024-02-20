<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LoadersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LoadersTable Test Case
 */
class LoadersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LoadersTable
     */
    public $Loaders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.loaders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Loaders') ? [] : ['className' => LoadersTable::class];
        $this->Loaders = TableRegistry::getTableLocator()->get('Loaders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Loaders);

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
