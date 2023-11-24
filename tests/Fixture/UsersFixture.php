<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'categoria' => 'Lorem ipsum dolor ',
                'created' => '2023-11-23 01:55:57',
                'modified' => '2023-11-23 01:55:57',
                'status' => 1,
            ],
        ];
        parent::init();
    }
}
