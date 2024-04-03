<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Frequencias Model
 *
 * @property \App\Model\Table\SemanasTable&\Cake\ORM\Association\BelongsTo $Semanas
 *
 * @method \App\Model\Entity\Frequencia newEmptyEntity()
 * @method \App\Model\Entity\Frequencia newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Frequencia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Frequencia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Frequencia findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Frequencia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Frequencia[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Frequencia|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Frequencia saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Frequencia[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Frequencia[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Frequencia[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Frequencia[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FrequenciasTable extends Table
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

        $this->setTable('frequencias');
        $this->setDisplayField('dia');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Semanas', [
            'foreignKey' => 'semanas_id',
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
            ->scalar('dia')
            ->maxLength('dia', 50)
            ->requirePresence('dia', 'create')
            ->notEmptyString('dia');

        $validator
            ->decimal('horas')
            ->requirePresence('horas', 'create')
            ->notEmptyString('horas');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('saida')
            ->allowEmptyDateTime('saida');

        $validator
            ->integer('semanas_id')
            ->allowEmptyString('semanas_id');

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
        $rules->add($rules->existsIn('semanas_id', 'Semanas'), ['errorField' => 'semanas_id']);

        return $rules;
    }
}
