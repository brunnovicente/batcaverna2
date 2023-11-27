<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TurmasFixture
 */
class TurmasFixture extends TestFixture
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
                'nome' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'ano' => 1,
                'status' => 1,
                'created' => '2023-11-26 18:55:16',
                'modified' => '2023-11-26 18:55:16',
                'cursos_id' => 1,
            ],
        ];
        parent::init();
    }
}
