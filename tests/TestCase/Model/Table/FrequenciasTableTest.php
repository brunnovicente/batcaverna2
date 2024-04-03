<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FrequenciasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FrequenciasTable Test Case
 */
class FrequenciasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FrequenciasTable
     */
    protected $Frequencias;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Frequencias',
        'app.Semanas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Frequencias') ? [] : ['className' => FrequenciasTable::class];
        $this->Frequencias = $this->getTableLocator()->get('Frequencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Frequencias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FrequenciasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FrequenciasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
