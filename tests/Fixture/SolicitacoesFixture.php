<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SolicitacoesFixture
 */
class SolicitacoesFixture extends TestFixture
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
                'data' => '2024-03-20',
                'dia' => 'Lorem ipsum dolor sit amet',
                'horarios' => 'Lorem ipsum dolor sit amet',
                'justificativa' => 'Lorem ipsum dolor sit amet',
                'tipo' => 'Lorem ipsum dolor ',
                'status' => 1,
                'registro' => 1,
                'diarios_id' => 1,
                'created' => '2024-03-20 20:21:19',
                'modified' => '2024-03-20 20:21:19',
            ],
        ];
        parent::init();
    }
}
