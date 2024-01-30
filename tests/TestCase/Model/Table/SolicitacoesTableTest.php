<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitacoesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitacoesTable Test Case
 */
class SolicitacoesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitacoesTable
     */
    protected $Solicitacoes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Solicitacoes',
        'app.Diarios',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Solicitacoes') ? [] : ['className' => SolicitacoesTable::class];
        $this->Solicitacoes = $this->getTableLocator()->get('Solicitacoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Solicitacoes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SolicitacoesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SolicitacoesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
