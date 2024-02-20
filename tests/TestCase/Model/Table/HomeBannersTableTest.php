<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HomeBannersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HomeBannersTable Test Case
 */
class HomeBannersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HomeBannersTable
     */
    public $HomeBanners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.home_banners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HomeBanners') ? [] : ['className' => HomeBannersTable::class];
        $this->HomeBanners = TableRegistry::getTableLocator()->get('HomeBanners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HomeBanners);

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
