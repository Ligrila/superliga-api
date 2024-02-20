<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactTopicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactTopicsTable Test Case
 */
class ContactTopicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactTopicsTable
     */
    public $ContactTopics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contact_topics',
        'app.contacts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactTopics') ? [] : ['className' => ContactTopicsTable::class];
        $this->ContactTopics = TableRegistry::getTableLocator()->get('ContactTopics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactTopics);

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
