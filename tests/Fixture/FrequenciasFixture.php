<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FrequenciasFixture
 */
class FrequenciasFixture extends TestFixture
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
                'dia' => 'Lorem ipsum dolor sit amet',
                'horas' => 1.5,
                'created' => '2024-04-02 20:31:14',
                'modified' => '2024-04-02 20:31:14',
                'status' => 1,
                'saida' => '2024-04-02 20:31:14',
                'semanas_id' => 1,
            ],
        ];
        parent::init();
    }
}
