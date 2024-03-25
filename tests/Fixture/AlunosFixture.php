<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlunosFixture
 */
class AlunosFixture extends TestFixture
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
                'matricula' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'situacao' => 'Lorem ipsum dolor sit amet',
                'cursos_id' => 1,
                'created' => '2024-03-24 17:54:33',
                'modified' => '2024-03-24 17:54:33',
                'users_id' => 1,
            ],
        ];
        parent::init();
    }
}
