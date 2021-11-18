<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChecklistItemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChecklistItemsTable Test Case
 */
class ChecklistItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChecklistItemsTable
     */
    protected $ChecklistItems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ChecklistItems',
        'app.Checklists',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ChecklistItems') ? [] : ['className' => ChecklistItemsTable::class];
        $this->ChecklistItems = $this->getTableLocator()->get('ChecklistItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ChecklistItems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ChecklistItemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ChecklistItemsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
