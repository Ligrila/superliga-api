<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PushNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PushNotificationsTable Test Case
 */
class PushNotificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PushNotificationsTable
     */
    public $PushNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.push_notifications',
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
        $config = TableRegistry::getTableLocator()->exists('PushNotifications') ? [] : ['className' => PushNotificationsTable::class];
        $this->PushNotifications = TableRegistry::getTableLocator()->get('PushNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PushNotifications);

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
