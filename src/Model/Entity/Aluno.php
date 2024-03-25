<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Aluno Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $matricula
 * @property string $email
 * @property string $situacao
 * @property int $cursos_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $users_id
 *
 * @property \App\Model\Entity\Curso $curso
 * @property \App\Model\Entity\User $user
 */
class Aluno extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'nome' => true,
        'matricula' => true,
        'email' => true,
        'situacao' => true,
        'cursos_id' => true,
        'created' => true,
        'modified' => true,
        'users_id' => true,
        'curso' => true,
        'user' => true,
    ];
}
