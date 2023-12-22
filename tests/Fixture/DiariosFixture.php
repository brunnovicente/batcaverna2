<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DiariosFixture
 */
class DiariosFixture extends TestFixture
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
                'codigo' => 1,
                'descricao' => 'Lorem ipsum dolor sit amet',
                'link' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2023-12-04 00:34:01',
                'modified' => '2023-12-04 00:34:01',
                'turmas_id' => 1,
                'professores_id' => 1,
            ],
        ];
        parent::init();
    }
}
