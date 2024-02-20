<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PublicityCampaignsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PublicityCampaignsTable Test Case
 */
class PublicityCampaignsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PublicityCampaignsTable
     */
    public $PublicityCampaigns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.publicity_campaigns',
        'app.trivias',
        'app.banners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PublicityCampaigns') ? [] : ['className' => PublicityCampaignsTable::class];
        $this->PublicityCampaigns = TableRegistry::getTableLocator()->get('PublicityCampaigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PublicityCampaigns);

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
