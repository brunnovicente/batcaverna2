<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Turmas Model
 *
 * @property \App\Model\Table\CursosTable&\Cake\ORM\Association\BelongsTo $Cursos
 *
 * @method \App\Model\Entity\Turma newEmptyEntity()
 * @method \App\Model\Entity\Turma newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Turma[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Turma get($primaryKey, $options = [])
 * @method \App\Model\Entity\Turma findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Turma patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Turma[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Turma|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Turma saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Turma[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Turma[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Turma[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Turma[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TurmasTable extends Table
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

        $this->setTable('turmas');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cursos', [
            'foreignKey' => 'cursos_id',
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
            ->scalar('nome')
            ->maxLength('nome', 50)
            ->allowEmptyString('nome');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->allowEmptyString('descricao');

        $validator
            ->integer('ano')
            ->allowEmptyString('ano');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->integer('cursos_id')
            ->allowEmptyString('cursos_id');

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
        $rules->add($rules->existsIn('cursos_id', 'Cursos'), ['errorField' => 'cursos_id']);

        return $rules;
    }
}
