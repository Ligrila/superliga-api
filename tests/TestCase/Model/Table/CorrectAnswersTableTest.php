<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CorrectAnswersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CorrectAnswersTable Test Case
 */
class CorrectAnswersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CorrectAnswersTable
     */
    public $CorrectAnswers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.correct_answers',
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
        $config = TableRegistry::getTableLocator()->exists('CorrectAnswers') ? [] : ['className' => CorrectAnswersTable::class];
        $this->CorrectAnswers = TableRegistry::getTableLocator()->get('CorrectAnswers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CorrectAnswers);

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
