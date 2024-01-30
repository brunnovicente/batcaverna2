<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Solicitacoes Model
 *
 * @property \App\Model\Table\DiariosTable&\Cake\ORM\Association\BelongsTo $Diarios
 *
 * @method \App\Model\Entity\Solicitaco newEmptyEntity()
 * @method \App\Model\Entity\Solicitaco newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Solicitaco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Solicitaco get($primaryKey, $options = [])
 * @method \App\Model\Entity\Solicitaco findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Solicitaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitaco[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitaco|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitaco saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitaco[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Solicitaco[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Solicitaco[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Solicitaco[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SolicitacoesTable extends Table
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

        $this->setTable('solicitacoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Diarios', [
            'foreignKey' => 'diarios_id',
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
            ->date('data')
            ->allowEmptyDate('data');

        $validator
            ->scalar('dia')
            ->maxLength('dia', 45)
            ->allowEmptyString('dia');

        $validator
            ->scalar('horarios')
            ->maxLength('horarios', 45)
            ->allowEmptyString('horarios');

        $validator
            ->scalar('justificativa')
            ->maxLength('justificativa', 250)
            ->allowEmptyString('justificativa');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->allowEmptyString('tipo');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->integer('registro')
            ->allowEmptyString('registro');

        $validator
            ->integer('diarios_id')
            ->notEmptyString('diarios_id');

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
        $rules->add($rules->existsIn('diarios_id', 'Diarios'), ['errorField' => 'diarios_id']);

        return $rules;
    }
}
