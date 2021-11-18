<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChecklistsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChecklistsTable Test Case
 */
class ChecklistsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ChecklistsTable
     */
    protected $Checklists;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Checklists',
        'app.Cards',
        'app.ChecklistItems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Checklists') ? [] : ['className' => ChecklistsTable::class];
        $this->Checklists = $this->getTableLocator()->get('Checklists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Checklists);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ChecklistsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ChecklistsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
