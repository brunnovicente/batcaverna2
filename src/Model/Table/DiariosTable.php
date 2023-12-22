<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diarios Model
 *
 * @property \App\Model\Table\TurmasTable&\Cake\ORM\Association\BelongsTo $Turmas
 * @property \App\Model\Table\ProfessoresTable&\Cake\ORM\Association\BelongsTo $Professores
 *
 * @method \App\Model\Entity\Diario newEmptyEntity()
 * @method \App\Model\Entity\Diario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Diario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Diario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Diario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Diario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Diario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Diario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DiariosTable extends Table
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

        $this->setTable('diarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Turmas', [
            'foreignKey' => 'turmas_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Professores', [
            'foreignKey' => 'professores_id',
            'joinType' => 'INNER',
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
            ->integer('codigo')
            ->allowEmptyString('codigo');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->allowEmptyString('descricao');

        $validator
            ->scalar('link')
            ->maxLength('link', 250)
            ->allowEmptyString('link');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->integer('turmas_id')
            ->notEmptyString('turmas_id');

        $validator
            ->integer('professores_id')
            ->notEmptyString('professores_id');

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
        $rules->add($rules->existsIn('turmas_id', 'Turmas'), ['errorField' => 'turmas_id']);
        $rules->add($rules->existsIn('professores_id', 'Professores'), ['errorField' => 'professores_id']);

        return $rules;
    }
}
