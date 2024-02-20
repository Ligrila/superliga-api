<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DatesTable Test Case
 */
class DatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DatesTable
     */
    public $Dates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Dates') ? [] : ['className' => DatesTable::class];
        $this->Dates = TableRegistry::getTableLocator()->get('Dates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dates);

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
}
