<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CardsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CardsTable Test Case
 */
class CardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CardsTable
     */
    protected $Cards;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Cards',
        'app.Lanes',
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
        $config = $this->getTableLocator()->exists('Cards') ? [] : ['className' => CardsTable::class];
        $this->Cards = $this->getTableLocator()->get('Cards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Cards);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CardsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CardsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
