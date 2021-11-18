<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChecklistItemsFixture
 */
class ChecklistItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'position' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'checklist_id' => 1,
                'state' => 1,
                'created' => 1637247780,
            ],
        ];
        parent::init();
    }
}
