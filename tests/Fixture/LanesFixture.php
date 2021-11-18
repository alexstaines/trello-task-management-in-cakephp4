<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanesFixture
 */
class LanesFixture extends TestFixture
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
                'created' => 1637247767,
                'modified' => 1637247767,
            ],
        ];
        parent::init();
    }
}
