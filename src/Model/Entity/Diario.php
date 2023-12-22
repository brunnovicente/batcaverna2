<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diario Entity
 *
 * @property int $id
 * @property int|null $codigo
 * @property string|null $descricao
 * @property string|null $link
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int $turmas_id
 * @property int $professores_id
 *
 * @property \App\Model\Entity\Turma $turma
 * @property \App\Model\Entity\Professore $professore
 */
class Diario extends Entity
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
        'codigo' => true,
        'descricao' => true,
        'link' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'turmas_id' => true,
        'professores_id' => true,
        'turma' => true,
        'professore' => true,
    ];
}
