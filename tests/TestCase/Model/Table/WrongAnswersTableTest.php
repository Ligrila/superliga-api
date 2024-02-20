<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WrongAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WrongAnswersTable Test Case
 */
class WrongAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WrongAnswersTable
     */
    public $WrongAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.wrong_answers',
        'app.users',
        'app.questions',
        'app.trivias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WrongAnswers') ? [] : ['className' => WrongAnswersTable::class];
        $this->WrongAnswers = TableRegistry::getTableLocator()->get('WrongAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WrongAnswers);

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
