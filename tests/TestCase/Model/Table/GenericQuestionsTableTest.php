<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GenericQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GenericQuestionsTable Test Case
 */
class GenericQuestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GenericQuestionsTable
     */
    public $GenericQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.generic_questions',
        'app.trivias',
        'app.teams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GenericQuestions') ? [] : ['className' => GenericQuestionsTable::class];
        $this->GenericQuestions = TableRegistry::getTableLocator()->get('GenericQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GenericQuestions);

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
