<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Turma Entity
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $descricao
 * @property int|null $ano
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $cursos_id
 *
 * @property \App\Model\Entity\Curso $curso
 */
class Turma extends Entity
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
        'descricao' => true,
        'ano' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'cursos_id' => true,
        'curso' => true,
    ];
}
