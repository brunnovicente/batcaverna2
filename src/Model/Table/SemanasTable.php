<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Semanas Model
 *
 * @property \App\Model\Table\MonitoriasTable&\Cake\ORM\Association\BelongsTo $Monitorias
 *
 * @method \App\Model\Entity\Semana newEmptyEntity()
 * @method \App\Model\Entity\Semana newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Semana[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Semana get($primaryKey, $options = [])
 * @method \App\Model\Entity\Semana findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Semana patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Semana[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Semana|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Semana saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Semana[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Semana[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Semana[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Semana[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SemanasTable extends Table
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

        $this->setTable('semanas');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Monitorias', [
            'foreignKey' => 'monitorias_id',
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
            ->scalar('descricao')
            ->maxLength('descricao', 50)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->decimal('carga')
            ->requirePresence('carga', 'create')
            ->notEmptyString('carga');

        $validator
            ->date('inicio')
            ->requirePresence('inicio', 'create')
            ->notEmptyDate('inicio');

        $validator
            ->date('fim')
            ->requirePresence('fim', 'create')
            ->notEmptyDate('fim');

        $validator
            ->integer('monitorias_id')
            ->notEmptyString('monitorias_id');

        $validator
            ->decimal('cumprido')
            ->allowEmptyString('cumprido');

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
        $rules->add($rules->existsIn('monitorias_id', 'Monitorias'), ['errorField' => 'monitorias_id']);

        return $rules;
    }
}
