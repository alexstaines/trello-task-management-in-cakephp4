<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChecklistsFixture
 */
class ChecklistsFixture extends TestFixture
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
                'card_id' => 1,
                'created' => 1637247777,
            ],
        ];
        parent::init();
    }
}
