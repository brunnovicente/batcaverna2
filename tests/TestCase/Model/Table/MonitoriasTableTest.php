<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonitoriasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonitoriasTable Test Case
 */
class MonitoriasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MonitoriasTable
     */
    protected $Monitorias;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Monitorias',
        'app.Alunos',
        'app.Professores',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Monitorias') ? [] : ['className' => MonitoriasTable::class];
        $this->Monitorias = $this->getTableLocator()->get('Monitorias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Monitorias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MonitoriasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\MonitoriasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
