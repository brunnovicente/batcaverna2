<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SemanasFixture
 */
class SemanasFixture extends TestFixture
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
                'descricao' => 'Lorem ipsum dolor sit amet',
                'carga' => 1.5,
                'inicio' => '2024-03-30',
                'fim' => '2024-03-30',
                'created' => '2024-03-30 09:39:18',
                'modified' => '2024-03-30 09:39:18',
                'monitorias_id' => 1,
                'cumprido' => 1.5,
            ],
        ];
        parent::init();
    }
}
