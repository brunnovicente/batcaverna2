<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MonitoriasFixture
 */
class MonitoriasFixture extends TestFixture
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
                'periodo' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2024-03-30 09:32:28',
                'modified' => '2024-03-30 09:32:28',
                'alunos_id' => 1,
                'professores_id' => 1,
            ],
        ];
        parent::init();
    }
}
