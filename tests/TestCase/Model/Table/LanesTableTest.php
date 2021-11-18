<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LanesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LanesTable Test Case
 */
class LanesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LanesTable
     */
    protected $Lanes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Lanes',
        'app.Cards',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lanes') ? [] : ['className' => LanesTable::class];
        $this->Lanes = $this->getTableLocator()->get('Lanes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Lanes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LanesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
