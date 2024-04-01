<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Monitorias Model
 *
 * @property \App\Model\Table\AlunosTable&\Cake\ORM\Association\BelongsTo $Alunos
 * @property \App\Model\Table\ProfessoresTable&\Cake\ORM\Association\BelongsTo $Professores
 *
 * @method \App\Model\Entity\Monitoria newEmptyEntity()
 * @method \App\Model\Entity\Monitoria newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Monitoria[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Monitoria get($primaryKey, $options = [])
 * @method \App\Model\Entity\Monitoria findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Monitoria patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Monitoria[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Monitoria|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Monitoria saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Monitoria[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Monitoria[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Monitoria[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Monitoria[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MonitoriasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('monitorias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Alunos', [
            'foreignKey' => 'alunos_id',
        ]);
        $this->belongsTo('Professores', [
            'foreignKey' => 'professores_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->allowEmptyString('descricao');

        $validator
            ->scalar('periodo')
            ->maxLength('periodo', 50)
            ->allowEmptyString('periodo');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->integer('alunos_id')
            ->allowEmptyString('alunos_id');

        $validator
            ->integer('professores_id')
            ->allowEmptyString('professores_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('alunos_id', 'Alunos'), ['errorField' => 'alunos_id']);
        $rules->add($rules->existsIn('professores_id', 'Professores'), ['errorField' => 'professores_id']);

        return $rules;
    }
}
