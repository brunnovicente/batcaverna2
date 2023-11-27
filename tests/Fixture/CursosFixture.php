<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CursosFixture
 */
class CursosFixture extends TestFixture
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
                'sigla' => 'Lorem ip',
                'created' => '2023-11-25 18:11:53',
                'modified' => '2023-11-25 18:11:53',
                'professores_id' => 1,
            ],
        ];
        parent::init();
    }
}
