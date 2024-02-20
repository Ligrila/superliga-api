<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TriviasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TriviasTable Test Case
 */
class TriviasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TriviasTable
     */
    public $Trivias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trivias',
        'app.local_clubs',
        'app.visit_clubs',
        'app.processed_answers',
        'app.questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Trivias') ? [] : ['className' => TriviasTable::class];
        $this->Trivias = TableRegistry::getTableLocator()->get('Trivias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Trivias);

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
