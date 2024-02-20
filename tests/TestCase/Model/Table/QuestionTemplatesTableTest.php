<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionTemplatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionTemplatesTable Test Case
 */
class QuestionTemplatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionTemplatesTable
     */
    public $QuestionTemplates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.question_templates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('QuestionTemplates') ? [] : ['className' => QuestionTemplatesTable::class];
        $this->QuestionTemplates = TableRegistry::getTableLocator()->get('QuestionTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionTemplates);

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
